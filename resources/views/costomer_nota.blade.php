@extends('dashboard')
@section('info')
<div class="container mt-5">
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
    <div class="row justify-content-center">
        <div class="card col-md-8 shadow-sm border" id="notaCard" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header bg-dark text-center text mt-3" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h4 class="mb-0 text-white">
                    <img src="{{ asset('asset/jlogo.svg') }}" alt=""> Nota Jauki Tugas
                </h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-warning text-dark">
                        Nama : <i class="bi bi-person"></i> {{ $costomer['nama'] }}
                    </span>
                    <span class="badge bg-info text-dark">
                        Tanggal :  <i class="bi bi-calendar"></i> {{ $costomer['tanggal'] }}
                    </span>
                </div>

                <table class="table table-striped text-center">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-cart"></i> Item</th>
                            <th><i class="bi bi-journal"></i> Hal</th>
                            <th><i class="bi bi-cash"></i> Harga</th>
                            <th><i class="bi bi-cash-stack"></i> Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nota as $item => $value)
                            <tr>
                                <td>{{ $value['nama_produk'] }}</td>
                                <td>{{ $value['jumlah'] }}</td>
                                <td>{{ number_format($value['harga'])  }}</td>
                                <td>{{ number_format($value['total_harga'])  }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <h3>
                        <span class="badge bg-dark text-white px-4 py-3 shadow-lg" style="font-size: 1rem; border-radius: 15px;">
                            <i class="bi bi-wallet"></i> Total : Rp {{ number_format($costomer['total'], 0, ',', '.') }}
                        </span>
                    </h3>
                </div>
            </div>
            <div class="card-footer text-center bg-light py-2 mb-3" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                <p class="mb-2 text-muted" style="font-size: 0.85rem;">
                    Setiap tugas selesai, kami berikan <strong>1x free revisi</strong> jika sudah mengikuti media sosial kami.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://instagram.com/jaukitugas" class="text-dark text-decoration-none" target="_blank">
                        <i class="bi bi-instagram"></i> <span style="font-size: 0.85rem;">@jaukitugas</span>
                    </a>
                    <a href="https://wa.me/6285184771744" class="text-dark text-decoration-none" target="_blank">
                        <i class="bi bi-whatsapp"></i> <span style="font-size: 0.85rem;">0851-8477-1744</span>
                    </a>
                </div>
            </div>
        </div> 
        {{-- button --}}
        <div class="col-md-8 mt-3 mb-3 d-flex justify-content-between align-items-center text-center">
            <div>
                <a href="{{ url('dashboard/costomer') }}" class="btn btn-danger"><i class="bi bi-backspace-fill"></i> Batal</a>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" 
                class="btn btn-primary tambah_nota" name="tambah_nota"
                id = "{{ $costomer['id_costomer'] }}"
                ><i class="bi bi-bag-plus-fill"> Tambah</i></button>
                <button class="btn btn-info" name="edit_nota"> <i class="bi bi-pencil-fill"> Edit Nota</i></button>
            </div>
            <div>
                <button class="btn btn-warning btn-sm px-3 py-2 fw-bold shadow-sm" id="btnCapture">
                    <i class="bi bi-printer"></i> Cetak Nota
                </button>
            </div>
        </div>
    </div>
{{-- batas --}}
    </div>

   
    {{-- data nota untuk edit dan hapus --}}
    <div class="row justify-content-center mb-5">
    <div class="card col-md-8" style="display: none" id="muncul_edit">
        <div class="card-header mt-3">Data Nota</div>
        <div class="card-body">
            <table class="table table-striped table-light text-center text-small">
                <thead>
                    <tr>
                        <th>No</th>
                        <th><i class="bi bi-cart"></i> Item</th>
                        <th><i class="bi bi-journal"></i> Hal</th>
                        <th><i class="bi bi-cash"></i> Harga</th>
                        <th><i class="bi bi-cash-stack"></i> Jumlah</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nota as $key => $item)
                    <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item['nama_produk'] }}</td>
                            <td>{{ $item['jumlah'] }}</td>
                            <td>{{ $item['harga'] }}</td>
                            <td>{{ $item['total_harga'] }}</td>
                            <td>
                                <form action="{{ 'hapus/harga/'.$item['id_nota'] }}" method="post">
                                @method('delete')
                                @csrf
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash2"></i> </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Nota</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('tambah/harga/'.$costomer['id_costomer']) }}" method="post" id="modal_tambah_nota">
            @method('post')
            @csrf
                <div>
                    <h6>id costomer : <span class="badge text-bg-dark" nama = "id">{{ $costomer['id_costomer'] }}</span></h6>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="">Produk</label>
                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}">
                        @error('nama_produk')
                        <div class="text-danger small">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah') }}">
                            @error('jumlah')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="">Harga</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}">
                            @error('harga')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h6>Total Harga : <span class="badge text-bg-dark" id="total_harga"></span></h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Tambah</button>
            </div>
        </form>
        </div>
    </div>
  </div>



<!-- Tambahkan Library html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    document.getElementById("btnCapture").addEventListener("click", function() {
        let cardElement = document.getElementById("notaCard"); // Tangkap elemen card

        html2canvas(cardElement, {
            scale: 3, // Menambah resolusi agar tidak burik
            useCORS: true, // Mengizinkan elemen dengan gambar eksternal
            backgroundColor: null // Agar background tetap transparan
        }).then(canvas => {
            let imageData = canvas.toDataURL("image/jpeg", 1.0); // Kualitas maksimal

            // Buat elemen <a> untuk mengunduh gambar
            let downloadLink = document.createElement("a");
            downloadLink.href = imageData;
            downloadLink.download = "Nota_Jauki_Tugas.jpg";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('button[name = tambah_nota]').click(function(){
            $id = $(this).attr('id');
            
        })
        $('input[name = harga]').keyup(function(){
            var harga = $('input[name = harga]').val();
            var jumlah = $('input[name = jumlah]').val();

            var total_harga = harga * jumlah ;

            $('#total_harga').html(total_harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        
       
        })

        $('button[name = edit_nota]').click(function(){
            $('#muncul_edit').toggle(300);
        })
    })
    
</script>
@endsection
