<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <title>Eror</title>
</head>
<body>
    
    <div class="container text-center mt-5">
        <h1 class="display-1 text-danger">405</h1>
        <h2 class="mb-3">Halaman Tidak Ditemukan</h2>
        <p class="lead">Sepertinya halaman yang kamu cari tidak tersedia atau telah dipindahkan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
    
</body>
</html>


