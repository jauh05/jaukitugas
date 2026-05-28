<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data['pengeluaran'] = Pengeluaran::orderBy('tanggal', 'desc')
            ->orderBy('id_pengeluaran', 'desc')
            ->get();
        return view('pengeluaran', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'keterangan' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'numeric', 'min:0'],
            'tanggal' => ['nullable', 'date'],
        ]);

        Pengeluaran::create([
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal ?: now()->toDateString(),
        ]);

        return redirect('dashboard/pengeluaran')->with('pesan_berhasil', 'Pengeluaran berhasil ditambahkan');
    }

    public function update(Request $request, $id_pengeluaran): RedirectResponse
    {
        $request->validate([
            'keterangan' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'numeric', 'min:0'],
            'tanggal' => ['required', 'date'],
        ]);

        Pengeluaran::findOrFail($id_pengeluaran)->update([
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('dashboard/pengeluaran')->with('pesan_berhasil', 'Pengeluaran berhasil diubah');
    }

    public function delete($id_pengeluaran): RedirectResponse
    {
        Pengeluaran::findOrFail($id_pengeluaran)->delete();
        return redirect('dashboard/pengeluaran')->with('pesan_berhasil', 'Pengeluaran berhasil dihapus');
    }
}

