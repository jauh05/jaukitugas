<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Costomer;
use App\Models\Nota;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\DB;


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

  function tambah()
  {
    $data['costomer'] = MetodePembayaran::all();
    return view('costomer_tambah', $data);
  }

  function store(Request $request): RedirectResponse
  {
    $validatedData = $request->validate([
      'nama_costomer' => ['required'],
      'metode' => ['required'],
    ]);

    $masuk['nama'] = $request->nama_costomer;
    // Otomatis set waktu dan tanggal saat ini
    $masuk['waktu'] = date('H:i');
    $masuk['tanggal'] = date('Y-m-d');

    // Default total 0, nanti ditambah lewat nota
    $masuk['total'] = 0;
    $masuk['selesaikan'] = 'belum'; // Default status
    $masuk['id_metode'] = $request->metode;

    Costomer::create($masuk);
    return redirect('dashboard/costomer')->with('pesan_berhasil', 'Data Customer Berhasil Ditambahkan');
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
    $validatedData = $request->validate([
      'nama_costomer' => ['required'],
      'waktu_costomer' => ['required'],
      'tanggal_costomer' => ['required'],
    ]);

    $masuk['nama'] = $request->nama_costomer;
    $masuk['waktu'] = $request->waktu_costomer;
    $masuk['tanggal'] = $request->tanggal_costomer;


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
    return redirect('costomer/' . $id_costomer . '/nota')->with('pesan_berhasil', 'Nota berhasil ditambahkan');
  }

  function hapus_harga($id_costomer, $id_nota)
  {

    $nota = Nota::find($id_nota);
    $total_harga = $nota->total_harga;

    $total_sebelum = Costomer::where('id_costomer', $id_costomer)->value('total');
    $masukan['total'] = $total_sebelum - $total_harga;

    Costomer::find($id_costomer)->update($masukan);
    Nota::find($id_nota)->delete();
    return redirect('costomer/' . $id_costomer . '/nota')->with('pesan_berhasil', 'Nota berhasil dihapus');
    ;
  }
  function update_diskon(Request $request, $id_costomer)
  {
    $request->validate([
      'diskon' => ['required', 'numeric', 'min:0', 'max:100'],
    ]);

    Costomer::where('id_costomer', $id_costomer)->update([
      'diskon' => $request->diskon
    ]);

    return redirect('costomer/' . $id_costomer . '/nota')->with('pesan_berhasil', 'Diskon berhasil diperbarui');
  }
}

