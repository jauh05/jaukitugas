@extends('dashboard')
@section('edit')

<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('dashboard/'.$komentar['id_komentar']) }}">
                    @method('put')
                    @csrf
                    <h3>Edit Komentar</h3>
                    <p> id komentar : <b> {{ $komentar['id_komentar'] }} </b></p>
                        <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $komentar['nama'] }}">
                        </div>
                    
                        <div class="mb-3">
                            <label for="">Tentang</label>
                            <input type="text" class="form-control" name="tentang" value="{{ $komentar['tentang'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="">Komentar</label>
                            <textarea name="komentar" class="form-control" id="" >{{ $komentar['komentar'] }}</textarea>
                        </div>
                        <a href="{{ url('dashboard/komentar') }}" class="btn btn-danger"><i class="bi bi-backspace-fill"></i></a>
                        <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
