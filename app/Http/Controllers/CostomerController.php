<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Costomer;
use App\Models\Nota;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CostomerController extends Controller
{
  function index()
  {
    $data['costomer'] = Costomer::join('metode', 'costomer.id_metode', '=', 'metode.id_metode')
      ->select('costomer.*', 'metode.nama_metode')
      ->orderBy('id_costomer', 'desc')
      ->get();
    $data['metode'] = MetodePembayaran::all();
    $data['nota'] = Nota::all();
    return view('costomer', $data);
  }

  function index2()
  {
    $data['costomer'] = Costomer::where('selesaikan', 'belum')->join('metode', 'costomer.id_metode', '=', 'metode.id_metode')->select('costomer.*', 'metode.nama_metode')->get();
    $data['metode'] = MetodePembayaran::all();
    return view('costomer_belum', $data);
  }

  function jadwal()
  {
    $data['costomer'] = Costomer::join('metode', 'costomer.id_metode', '=', 'metode.id_metode')
      ->select('costomer.*', 'metode.nama_metode')
      ->orderBy('id_costomer', 'desc')
      ->get();
    $data['metode'] = MetodePembayaran::all();
    return view('jadwal', $data);
  }

  function tambah()
  {
    $data['costomer'] = MetodePembayaran::all();
    return view('costomer_tambah', $data);
  }

  function store(Request $request): RedirectResponse
  {
    $hasLabelColumn = Schema::hasColumn('costomer', 'label_custom');

    $validatedData = $request->validate([
      'nama_costomer' => ['required'],
      'metode' => ['required'],
      'label_custom' => $hasLabelColumn ? ['nullable', 'string', 'max:50'] : ['nullable'],
      'tanggal_costomer' => ['nullable', 'date'],
      'waktu_costomer' => ['nullable', 'date_format:H:i'],
    ]);

    $masuk['nama'] = $request->nama_costomer;
    // Jika input jadwal diisi maka pakai jadwal itu, jika tidak pakai waktu saat ini
    $masuk['waktu'] = $request->waktu_costomer ?? date('H:i');
    $masuk['tanggal'] = $request->tanggal_costomer ?? date('Y-m-d');

    // Default total 0, nanti ditambah lewat nota
    $masuk['total'] = 0;
    $masuk['selesaikan'] = 'belum'; // Default status
    if ($hasLabelColumn) {
      $masuk['label_custom'] = $request->label_custom;
    }
    $masuk['id_metode'] = $request->metode;

    Costomer::create($masuk);
    $redirectTo = $request->input('redirect_to') === 'jadwal' ? 'dashboard/jadwal' : 'dashboard/costomer';
    return redirect($redirectTo)->with('pesan_berhasil', 'Data Customer Berhasil Ditambahkan');
    ;
  }

  function edit($id_costomer)
  {
    $data['costomer'] = Costomer::find($id_costomer);
    $data['nota'] = Nota::where('id_costomer', $id_costomer)->get();
    return view('costomer_edit', $data);

  }

  function updatedata(Request $request, $id_costomer): RedirectResponse
  {
    $hasLabelColumn = Schema::hasColumn('costomer', 'label_custom');

    $validatedData = $request->validate([
      'nama_costomer' => ['required'],
      'waktu_costomer' => ['required'],
      'tanggal_costomer' => ['required'],
      'metode' => ['required'],
      'selesaikan' => ['required', 'in:sudah,pembayaran,proses,belum'],
      'label_custom' => $hasLabelColumn ? ['nullable', 'string', 'max:50'] : ['nullable'],
    ]);

    $masuk['nama'] = $request->nama_costomer;
    $masuk['waktu'] = $request->waktu_costomer;
    $masuk['tanggal'] = $request->tanggal_costomer;
    $masuk['id_metode'] = $request->metode;
    $masuk['selesaikan'] = $request->selesaikan;
    if ($hasLabelColumn) {
      $masuk['label_custom'] = $request->label_custom;
    }


    Costomer::find($id_costomer)->update($masuk);
    return redirect('dashboard/costomer')->with('pesan_berhasil', 'berhasil diperbaharui');
    ;

  }


  function delete($id_costomer)
  {
    Costomer::find($id_costomer)->delete();
    return redirect('dashboard/costomer')->with('pesan_berhasil', 'berhasil dihapus');
  }
  function update(Request $request, $id_costomer)
  {
    $request->validate([
      'selesaikan' => ['required', 'in:sudah,pembayaran,proses,belum'],
      'metode' => ['required'],
    ]);

    $masuk['selesaikan'] = $request->selesaikan;
    $masuk['id_metode'] = $request->metode;

    Costomer::where('id_costomer', $id_costomer)->update($masuk);

    return redirect('dashboard/costomer')->with('pesan_berhasil', 'Status pesanan berhasil diperbarui!');
  }

  function nota($id_costomer)
  {
    $data['costomer'] = Costomer::find($id_costomer);
    $data['nota'] = nota::where('id_costomer', $id_costomer)->get();
    return view('costomer_nota', $data);
  }

  function tambah_nota(Request $request, $id_costomer): RedirectResponse
  {
    $validatedData = $request->validate([
      'nama_produk' => ['required'],
      'jumlah' => ['required'],
      'harga' => ['required'],
    ]);

    $harga = $request->harga;
    $jumlah = $request->jumlah;
    $nama_produk = $request->nama_produk;
    $total_harga = $harga * $jumlah;

    $total_sebelum = nota::where('id_costomer', $id_costomer)->sum('total_harga');

    $masuk['nama_produk'] = $nama_produk;
    $masuk['harga'] = $harga;
    $masuk['jumlah'] = $jumlah;
    $masuk['total_harga'] = $total_harga;
    $masuk['id_costomer'] = $id_costomer;
    $masukan['total'] = $total_sebelum + $total_harga;

    Nota::create($masuk);
    Costomer::find($id_costomer)->update($masukan);
    return redirect('/costomer/' . $id_costomer . '/nota')->with('pesan_berhasil', 'Nota berhasil ditambahkan');
  }

  function hapus_harga($id_costomer, $id_nota)
  {

    $nota = Nota::find($id_nota);
    $total_harga = $nota->total_harga;

    $total_sebelum = Costomer::where('id_costomer', $id_costomer)->value('total');
    $masukan['total'] = $total_sebelum - $total_harga;

    Costomer::find($id_costomer)->update($masukan);
    Nota::find($id_nota)->delete();
    return redirect('/costomer/' . $id_costomer . '/nota')->with('pesan_berhasil', 'Nota berhasil dihapus');
    ;
  }
  function update_diskon(Request $request, $id_costomer)
  {
    $request->validate([
      'diskon' => ['required', 'numeric', 'min:0', 'max:100'],
    ]);

    $costomer = Costomer::find($id_costomer);
    $costomer->diskon = $request->diskon;
    $costomer->save();

    return redirect('/costomer/' . $id_costomer . '/nota')->with('pesan_berhasil', 'Diskon berhasil diperbarui');
  }

  function bulkUpdateStatus(Request $request): RedirectResponse
  {
    $request->validate([
      'ids' => ['required', 'array'],
      'status' => ['required', 'in:sudah,pembayaran,proses,belum'],
    ]);

    Costomer::whereIn('id_costomer', $request->ids)->update([
      'selesaikan' => $request->status
    ]);

    return redirect('dashboard/costomer')->with('pesan_berhasil', 'Status multiple customer berhasil diperbarui!');
  }

  function updateBoard(Request $request, $id_costomer)
  {
    $hasLabelColumn = Schema::hasColumn('costomer', 'label_custom');

    $validated = $request->validate([
      'selesaikan' => ['nullable', 'in:sudah,pembayaran,proses,belum'],
      'label_custom' => $hasLabelColumn ? ['nullable', 'string', 'max:50'] : ['nullable'],
      'nama_costomer' => ['nullable', 'string', 'max:100'],
      'tanggal_costomer' => ['nullable', 'date'],
      'waktu_costomer' => ['nullable', 'date_format:H:i'],
    ]);

    $costomer = Costomer::findOrFail($id_costomer);

    if ($request->has('selesaikan')) {
      $costomer->selesaikan = $validated['selesaikan'];
    }
    if ($hasLabelColumn && $request->has('label_custom')) {
      $costomer->label_custom = $validated['label_custom'];
    }
    if ($request->has('nama_costomer')) {
      $costomer->nama = $validated['nama_costomer'];
    }
    if ($request->has('tanggal_costomer')) {
      $costomer->tanggal = $validated['tanggal_costomer'];
    }
    if ($request->has('waktu_costomer')) {
      $costomer->waktu = $validated['waktu_costomer'];
    }

    $costomer->save();

    return response()->json([
      'message' => 'Board customer berhasil diupdate',
      'data' => [
        'id_costomer' => $costomer->id_costomer,
        'selesaikan' => $costomer->selesaikan,
        'label_custom' => $costomer->label_custom,
        'updated_at' => optional($costomer->updated_at)->format('Y-m-d H:i:s')
      ]
    ]);
  }
}

