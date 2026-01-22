<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\MetodePembayaran;

class MetodepembayaranController extends Controller
{
    function index(){
        $data['metode'] = MetodePembayaran::all();
        return view('metode',$data);
    }

    function tambah(){
        return view('metode_tambah');
    }

    function delete($id_metode){
        MetodePembayaran::find($id_metode)->delete();
        return redirect('metodepembayaran')->with('pesan_berhasil','metode berhasil di hapus');
    }

    function store(Request $request) {
 
        $masuk['nama_metode'] = $request->metode;

        MetodePembayaran::create($masuk);
        return redirect('metodepembayaran')->with('pesan_berhasil','metode berhasil di tambahkan');
    }

    function edit($id_metode) {
        $data['metode'] = MetodePembayaran::find($id_metode);
        return view('metode_edit',$data);
    }

    function update(Request $request, $id_metode){
        $masuk['nama_metode'] = $request->metode;

        MetodePembayaran::find($id_metode)->update($masuk);
        return redirect('metodepembayaran')->with('pesan_berhasil','metode berhasil di edit');
    }
}

