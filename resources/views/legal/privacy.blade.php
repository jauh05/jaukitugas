@extends('material.dash')

@section('temp')
    <div class="container py-5 mt-2 legal-page">
        <div class="glass-card p-4 p-md-5 mx-auto" style="max-width: 860px;">
            <span class="jt-chip mb-3">Draf</span>
            <h1 class="fw-bold mb-2">Kebijakan Privasi</h1>
            <p class="text-muted small mb-4">Privacy Policy</p>

            <p class="mb-1"><strong>Nama layanan:</strong> Jauki Tugas</p>
            <p class="mb-1"><strong>Website:</strong> <a href="https://jaukitugas.my.id">https://jaukitugas.my.id</a></p>
            <p class="mb-1"><strong>Kontak:</strong> <a href="mailto:jaukiacademu@gmail.com">jaukiacademu@gmail.com</a></p>
            <p class="mb-4"><strong>Terakhir diperbarui:</strong> 1 November 2026</p>

            <h2 class="h4 fw-bold mt-4">1. Data yang kami gunakan</h2>
            <ul>
                <li><strong>Login dengan TikTok:</strong> nama tampilan dan avatar akun TikTok Anda (scope user.info.basic), serta identifier akun (open_id).</li>
                <li><strong>Token akses dan token refresh:</strong> disimpan di server kami dan tidak pernah ditampilkan ke browser.</li>
                <li><strong>Video yang Anda pilih untuk diunggah:</strong> dikirim ke TikTok sebagai draf (scope video.upload).</li>
            </ul>

            <h2 class="h4 fw-bold mt-4">2. Cara kami menggunakan data</h2>
            <ul>
                <li>Menampilkan nama dan avatar akun TikTok yang terhubung.</li>
                <li>Mengirim video yang Anda pilih ke akun TikTok Anda sebagai draf.</li>
                <li>Kami tidak memposting langsung. Video hanya terbit jika Anda mempublikasikannya sendiri dari aplikasi TikTok.</li>
            </ul>

            <h2 class="h4 fw-bold mt-4">3. Pembagian data</h2>
            <p>Kami tidak menjual data Anda dan tidak membagikannya ke pihak ketiga, kecuali penyedia infrastruktur yang diperlukan untuk menjalankan layanan.</p>

            <h2 class="h4 fw-bold mt-4">4. Retensi (lama penyimpanan)</h2>
            <p>[PERLU KEPUTUSAN: berapa lama token akses dan token refresh disimpan]</p>
            <p>[PERLU KEPUTUSAN: berapa lama file video disimpan, dan kapan dihapus setelah dikirim ke TikTok]</p>

            <h2 class="h4 fw-bold mt-4">5. Hak Anda</h2>
            <ul>
                <li>Memutus koneksi akun TikTok kapan saja.</li>
                <li>Meminta penghapusan data Anda dengan menghubungi <a href="mailto:jaukiacademu@gmail.com">jaukiacademu@gmail.com</a>.</li>
            </ul>

            <hr class="my-5">

            <h1 class="fw-bold mb-2">Privacy Policy</h1>
            <p class="text-muted small mb-4">Bahasa Indonesia di atas. English version below.</p>

            <p class="mb-1"><strong>Service name:</strong> Jauki Tugas</p>
            <p class="mb-1"><strong>Website:</strong> <a href="https://jaukitugas.my.id">https://jaukitugas.my.id</a></p>
            <p class="mb-1"><strong>Contact:</strong> <a href="mailto:jaukiacademu@gmail.com">jaukiacademu@gmail.com</a></p>
            <p class="mb-4"><strong>Last updated:</strong> 1 November 2026</p>

            <h2 class="h4 fw-bold mt-4">1. Data we use</h2>
            <ul>
                <li><strong>Log in with TikTok:</strong> your TikTok display name and avatar (scope user.info.basic), and your account identifier (open_id).</li>
                <li><strong>Access token and refresh token:</strong> stored on our server and never shown to the browser.</li>
                <li><strong>Videos you choose to upload:</strong> sent to TikTok as a draft (scope video.upload).</li>
            </ul>

            <h2 class="h4 fw-bold mt-4">2. How we use the data</h2>
            <ul>
                <li>To show the name and avatar of the connected TikTok account.</li>
                <li>To send the videos you choose to your TikTok account as drafts.</li>
                <li>We do not post directly. A video is published only if you publish it yourself from the TikTok app.</li>
            </ul>

            <h2 class="h4 fw-bold mt-4">3. Sharing</h2>
            <p>We do not sell your data and do not share it with third parties, except infrastructure providers needed to run the service.</p>

            <h2 class="h4 fw-bold mt-4">4. Retention</h2>
            <p>[PERLU KEPUTUSAN: how long access and refresh tokens are stored]</p>
            <p>[PERLU KEPUTUSAN: how long video files are stored, and when they are deleted after being sent to TikTok]</p>

            <h2 class="h4 fw-bold mt-4">5. Your rights</h2>
            <ul>
                <li>Disconnect your TikTok account at any time.</li>
                <li>Request deletion of your data by contacting <a href="mailto:jaukiacademu@gmail.com">jaukiacademu@gmail.com</a>.</li>
            </ul>

            <div class="text-center mt-5">
                <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-muted"><i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda</a>
            </div>
        </div>
    </div>
@endsection
