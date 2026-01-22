@extends('dashboard')
@section('halo')
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
    {{-- <h1 class="mt-4">Selamat datang</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ session('id_admin') }}</li>
    </ol> --}}
@endsection
@section('info')
<div class="row mt-5">
    <div class="text-center col-md-12 bg-secondary badge mb-3">
        <h3>
            <span class="badge text-bg-secondary">
                Rekap : 
                {{ strftime('%B', strtotime(date('Y-m-d'))) }} 
                {{ date('Y') }}
            </span>
        </h3>
    </div>
</div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-header">Jumlah <b>komentar</b></div>
            <div class="card-body">
                <h1 class="">{{ $jumlah_komentar }} <i class="bi bi-journal-text"></i></h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-header ">Costomer <b>Selesai</b>
            </div>
            <div class="card-body">
                <h1 class="">{{ $jumlah_costomer_sudah }} <i class="bi bi-person-check"></i></h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-header">Costomer <b>Belum</b> </div>
            <div class="card-body">
                <h1 class="">{{ $jumlah_costomer_belum }} <i class="bi bi-person-exclamation"></i></h1>
            </div>
    </div>
</div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-dark mb-4">
            <div class="card-header">Total <b>Pendapatan</b>
            </div>
            <div class="card-body">
                <h1 class=""> <i class="bi bi-cash-stack"></i> {{ number_format( $total_pendapatan) }},- </h1>
            </div>
        </div>
    </div>
    {{-- ewallet --}}
    <div class="card border-0 mb-3">
        <div class="card-body">
            <div class="row justify-content-center">
                {{-- satu --}}
                @foreach ($jumlah_metode as $val)
                <div class="col-md-3">
                    <div class="card bg-dark text-white">
                    <div class="card-body text-center">
                        <div>
                            <h5><i class="bi bi-credit-card-2-back"> {{ $val['nama_metode'] }}</i></h5>
                        </div>
                        <div>
                            <span class="badge bg-primary"><i class="bi bi-person-fill">  {{ $val['jumlah_pembayaran'] }}</i></span> <span class="badge bg-warning text-dark"> <i class="bi bi-cash-stack"> Rp.{{ number_format( $val['total_harga']) }}</i> </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
    {{-- Grafik --}}
    <div class="row">
        <div class="col-md-6"> 
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Jumlah Costomer tahun <b> {{ $tahunSekarang }} </b>
                    </div>
                    <div class="card-body">
                        {!! $chartCos->container() !!}
                        <script src="{{ $chartCos->cdn() }}"></script>
                        {!! $chartCos->script() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Pendapatan tahun <b> {{ $tahunSekarang }} </b>
                    </div>
                    <div class="card-body">
                        {!! $chart->container() !!}
                        <script src="{{ $chart->cdn() }}"></script>
                        {!! $chart->script() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button rekap --}}
    <div class="p-3 mb-5 justify-content-center">
        <a href="" class="btn btn-outline-dark" id="btn_rekap">Lihat rekap tahun sebelumnya <i class="bi bi-calendar-check"></i></a>
    </div>
    {{-- rekap tahunan --}}
    <div class="row" style="display: none" id="rekap">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar"></i>
                    Rekap tahunan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 shadow-sm border-0 p-3">
                            <div class="">
                                <div class="card-body"> 
                                    <div class="card bg-dark text-white mb-4">
                                        <div class="card-header text-center">Rekap <b>{{ $tahunSekarang - 1  }}</b></div>
                                        <div class="card-body">
                                            <h3 class="text-center">Rp. {{ number_format($tahun_1) }},- <i class="bi bi-cash-stack"></i></h3>
                                        </div>
                                    </div> 
                                    @foreach ($bulanLalu as $key => $bulan)
                                    <ol class="list-group mb-1">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="">
                                                <div class="fw-bold">Bulan <?php  $i = $key - 1 ?> {{ $i+1 }}  </div> <!-- Menampilkan bulan dalam angka -->
                                                <span class="fs-6">Rp {{ number_format($bulan) }},- </span>
                                            </div>
                                            <div>
                                                <!-- Menampilkan jumlah customer per bulan -->
                                                <span class="badge text-bg-success rounded-pill fs-6">
                                                    <i class="bi bi-person-check"></i> {{ $costomerLalu[$key] }} Costomer
                                                </span>
                                            </div>
                                        </li>
                                    </ol>
                                @endforeach
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-6 shadow-sm border-0 p-3">
                            <div class="">
                                <div class="card-body"> 
                                    <div class="card bg-dark text-white mb-4">
                                        <div class="card-header text-center">Rekap <b>{{ $tahunSekarang - 2  }}</b></div>
                                        <div class="card-body">
                                            <h3 class="text-center">Rp. {{ number_format($tahun_2) }},- <i class="bi bi-cash-stack"></i></h3>
                                        </div>
                                    </div> 
                                    @foreach ($bulanLalu2 as $key => $bulan)
                                    <ol class="list-group mb-1">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="">
                                                <div class="fw-bold">Bulan <?php  $i = $key - 1 ?> {{ $i+1 }} </div> <!-- Menampilkan bulan dalam angka -->
                                                <span class="fs-6">Rp {{ number_format($bulan) }} ,- </span>
                                            </div>
                                            <div>
                                                <!-- Menampilkan jumlah customer per bulan -->
                                                <span class="badge text-bg-success rounded-pill fs-6">
                                                    <i class="bi bi-person-check"></i> {{ $costomerLalu2[$key] }} Costomer
                                                </span>
                                            </div>
                                        </li>
                                    </ol>
                                @endforeach
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#btn_rekap').click(function(e){
                e.preventDefault();
                $('#rekap').toggle(500);
            })
        })
    </script>
    
@endsection

