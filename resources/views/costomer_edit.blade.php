@extends('dashboard')
@section('info')
@if (session('pesan_berhasil'))
<script>
    Swal.fire({
        position: "top-center",
        icon: "success",
        html: "<p style='color: #28a745; font-size: 18px;'>{{ session('pesan_berhasil') }}</p>",
        showConfirmButton: false,
        timer: 2500,
        customClass: {
        popup: 'swal-borderless'
    }
});
</script>
@endif
@if (session('pesan_gagal'))
<script>
    Swal.fire({
        position: "top-center",
        icon: "error",
        html: "<p style='color: #dc3545; font-size: 18px;'>{{ session('pesan_gagal') }}</p>",
        showConfirmButton: false,
        timer: 2500,
        customClass: {
        popup: 'swal-borderless'
    }
});
</script>
@endif
    <div class="container p-3">
        <div class="row">
        <div class="card col-md-6">
            <div class="card-header">Edit Costomer</div>
            <div class="card-body">
                <form action="{{ url('update/data/'.$costomer['id_costomer']) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control @error('nama_costomer') is-invalid @enderror" name="nama_costomer" value="{{ $costomer['nama'] }}">
                    @error('nama_costomer')
                        <div class="text-danger small">
                            {{ '*)' . $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal_costomer') is-invalid @enderror" name="tanggal_costomer" value="{{ $costomer['tanggal'] }}">
                    @error('tanggal_costomer')
                            <div class="text-danger small">
                                {{ '*)' . $message }}
                            </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">waktu</label>
                        <input type="time" class="form-control @error('waktu_costomer') is-invalid @enderror" name="waktu_costomer" value="{{ $costomer['waktu'] }} ">
                    @error('waktu_costomer')
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