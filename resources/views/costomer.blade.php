@extends('dashboard')
@section('tabel')
<div class="card mb-4 bg-dark text-white mt-5">
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
    <div class="card-header d-flex justufy-content-between">
        <div class="p-1">
            <h4><i class="fas fa-table me-1 fs-5"></i>Data Komentar</h4>
        </div>
        <div class="p-1">
            <form action="{{ url('dashboard/costomer/tambah') }}" method="">
                <button class="btn btn-primary"><i class="bi bi-person-fill-add"></i></button>
            </form>
        </div>
    </div>
    <div class="card-body text-white">
        <table id="datatablesSimple" class="text-dark table-striped table-light">
            <thead class="text-white">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Selesaikan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot class="text-dark">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Selesaikan</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody class="text-dark">
                @foreach ( $costomer as $key => $value )
                    <tr>
                       <td>{{ $key+1 }}</td>
                        <td>{{ $value['id_costomer'] }}</td>
                        <td>{{ $value['nama'] }}</td>
                        <td>{{ $value['tanggal'] }}</td>
                        <td>{{ $value['waktu'] }}</td>
                        <td>{{ $value['nama_metode'] }}</td>
                        <td> <b class="text-success">  Rp. {{ number_format($value['total'])}} </b> </td>
                        <td>
                            <form action="{{ url('selesaikan/'.$value['id_costomer']) }}" method="post">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">
                                        @if ($value['selesaikan']== 'sudah') 
                                            {{ 'sudah terselesaikan' }}
                                        @elseif($value['selesaikan'] == 'proses')
                                            {{ 'sedang dalam proses' }}
                                        @elseif($value['selesaikan'] == 'pembayaran')
                                            {{ 'belum melakukan pembayaran' }}
                                        @elseif($value['selesaikan'] == 'belum')
                                            {{ 'belum diproses' }}
                    
                                        @endif
                                    </label>
                                    <select id="disabledSelect"  name="selesaikan" class="form-select 
                                        @if($value['selesaikan'] == 'sudah') bg-info text-dark 
                                        @elseif($value['selesaikan'] == 'pembayaran') bg-danger text-white 
                                        @elseif($value['selesaikan'] == 'proses') bg-primary text-white 
                                        @elseif($value['selesaikan'] == 'belum') bg-light text-dark 
                                        @endif">
                                        <option value="sudah" @selected($value['selesaikan'] == 'sudah')>Sudah</option>
                                        <option value="pembayaran" @selected($value['selesaikan'] == 'pembayaran')>Pembayaran</option>
                                        <option value="proses" @selected($value['selesaikan'] == 'proses')>Proses</option>
                                        <option value="belum" @selected($value['selesaikan'] == 'belum')>Belum</option>
                                    </select>
                                    <select name="metode" id=""> 
                                    @foreach ($metode as $item)
                                         <option value="{{ $item['id_metode'] }}" {{ $item['id_metode']==$value['id_metode'] ? 'selected' : '' }} >{{ $item['nama_metode'] }}</option>
                                    @endforeach 
                                    </select>
                                    <button class="btn btn-success btn-sm"><i class="bi bi-check2-circle">submit</i></button>
                                  </div>
                            </form>
                        </td>
                        <td>
                            <a href="{{ url('costomer/'.$value['id_costomer'].'/nota') }}" class="btn btn-warning btn-sm"><i class="bi bi-printer-fill"> Nota</i></a>
                            <a href="{{ url('costomer/'.$value['id_costomer'].'/edit') }}" class="btn btn-info btn-sm"><i class="bi bi-pencil"> Edit</i></a>
                            <form method="post" action="{{ url('hapus/'.$value['id_costomer']) }}" style="display:inline-block" class="deleteForm">
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
<script>
    $(document).ready(function(){

        $('.tambah_nota').click(function(){
            var id = $(this).attr('idcos');
            var actionUrl = @json(url('tambah/harga/')) + '/' + id ;
            $('#modal_tambah_nota').attr('action',actionUrl);
            $('span[nama = id]').text(id);
        })
    })
</script>
@endsection

