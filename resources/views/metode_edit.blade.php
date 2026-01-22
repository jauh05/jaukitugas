@extends('dashboard')
@section('tabel')
<div class="row">
    <div class="col-md-5">
        <div class="card mb-4 mt-5">
            <div class="card-header">
                <h4>Form Edit Metode</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('metode/edit/'.$metode['id_metode']) }}" method="post">
                    @method('put')
                    @csrf
                    <label for="">Metode</label>
                    <input type="text" name="metode" id="" class="form-control" value="{{ $metode['nama_metode'] }}">
                </form>
            </div>
            <div class="p-3">
                <a href="{{ url('metodepembayaran') }}" class="btn btn-danger"><i class="bi bi-backspace-fill"></i></a>
                <button class="btn btn-success"><i>Submit</i></button>
            </div>
        </div>
    </div>
</div>

@endsection