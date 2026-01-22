@extends('dashboard')
@section('tabel')
<div class="card mb-4 mt-5       ">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Komentar
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>tentang</th>
                    <th>Isi</th>
                    <th>Waktu</th>
                    <th>Update</th>
                    <th><i class="bi bi-pencil-square"></i></th>
                    <th><i class="bi bi-trash2-fill"></i></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>tentang</th>
                    <th>Isi</th>
                    <th>Waktu</th>
                    <th>Update</th>
                    <th>Edit</th>
                    <th>hapus</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($komentar as $key => $value )
                <tr>
                    <td> {{ $key+1 }}</td>
                    <td>{{ $value['nama'] }}</td>
                    <td>{{ $value['tentang'] }}</td>
                    <td>{{ $value['komentar'] }}</td>
                    <td>{{ $value['created_at'] }}</td>
                    <td>{{ $value['updated_at'] }}</td>
                    <td class="d-flex justify-content-center align-items-center " role="group">
                        <a href="{{ url('dashboard/'.$value['id_komentar'].'/edit')}}" class="btn btn-warning btn-sm"> <i class="bi bi-pencil"></i></a>
                    </td>
                    <td>
                        <form action="{{ url("komentar/".$value['id_komentar']) }}" method="post" class="deleteForm">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm deleteButton"> <i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                    
                </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection