@extends('dashboard')
@section('tabel')
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
<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Komentar
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-wallet"> +</i>
          </button>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>id</th>
                    <th>Nama</th>
                    <th>action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>id</th>
                    <th>Nama</th>
                    <th>action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($metode as $key => $value )
                <tr>   
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value['id_metode'] }}</td>
                    <td>{{ $value['nama_metode'] }}</td>
                    <td>
                        <a href="{{ url('metode/'.$value['id_metode'].'/edit') }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"> Edit</i></a>
                        <form action="{{ url('metode/delete/'.$value['id_metode']) }}" style="display:inline-block" method="post" class="deleteForm">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm deleteButton"><i class="bi bi-trash"> Hapus</i></button>
                        </form>
                    </td>
                </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Metode</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('metodepembayaran/tambah/data') }}" method="post">
                    @method('post')
                    @csrf
                    <label for="">Metode</label>
                    <input type="text" name="metode" id="" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection