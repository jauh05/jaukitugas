@extends('dashboard')
@section('info')
    <div class="container mt-5">
        <div class="card col-md-8">
            <div class="card-header">Tambah Costomer</div>
            <div class="card-body">
                <form action="{{ url('dashboard/costomer/tambah/data') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control @error('nama_costomer') is-invalid @enderror" name="nama_costomer" value="{{ old('nama_costomer') }}">
                        @error('nama_costomer')
                            <div class="text-danger small">
                                {{ '*)' . $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal_costomer') is-invalid @enderror" name="tanggal_costomer" value="{{ old('tanggal_costomer') }}">
                        @error('tanggal_costomer')
                            <div class="text-danger small">
                                {{ '*)' . $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">waktu</label>
                        <input type="time" class="form-control @error('waktu_costomer') is-invalid @enderror" name="waktu_costomer" value="{{ old('waktu_costomer') }}">
                        @error('waktu_costomer')
                            <div class="text-danger small">
                                {{ '*)' . $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Metode?</label>
                        <select name="metode" id="" class="form-control form-select @error('metode') is-invalid @enderror">
                            @foreach ($costomer as $value )
                            <option value="{{ $value['id_metode'] }}">{{ $value['nama_metode'] }}</option>
                            @endforeach
                        </select>
                        @error('metode')
                            <div class="text-danger small">
                                {{ '*)' . $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Apakah sudah diselesaikan?</label>
                        <select name="selesaikan" id="" class="form-control form-select @error('selesaikan') is-invalid @enderror">
                            <option value="belum">belum</option>
                            <option value="pembayaran">pembayaran</option>
                            <option value="proses">proses</option>
                            <option value="sudah">sudah</option>
                        </select>
                        @error('selesaikan')
                            <div class="text-danger small">
                                {{ '*)' . $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ url('dashboard/costomer') }}" class="btn btn-danger"><i class="bi bi-backspace-fill"></i></a>
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('input[name = harga]').keyup(function(){
                var harga = $('input[name = harga]').val();
                var jumlah = $('input[name = jumlah]').val();
                var total = harga * jumlah;
                $('input[name = total_harga]').val(total);
            })
        })
    </script>
@endsection