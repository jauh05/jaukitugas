@extends('material.dash')

@section('temp')
    <div class="container py-5 mt-2 legal-page">
        <div class="glass-card p-4 p-md-5 mx-auto" style="max-width: 860px;">
            <span class="jt-chip mb-3">Draf</span>
            <h1 class="fw-bold mb-2">Ketentuan Layanan</h1>
            <p class="text-muted small mb-4">Terms of Service</p>

            <p class="mb-1"><strong>Nama layanan:</strong> Jauki Tugas</p>
            <p class="mb-1"><strong>Website:</strong> <a href="https://jaukitugas.my.id">https://jaukitugas.my.id</a></p>
            <p class="mb-1"><strong>Kontak:</strong> <a href="mailto:jaukiacademu@gmail.com">jaukiacademu@gmail.com</a></p>
            <p class="mb-4"><strong>Terakhir diperbarui:</strong> 1 November 2026</p>

            <h2 class="h4 fw-bold mt-4">1. Ruang lingkup layanan</h2>
            <p>Jauki Tugas menyediakan fitur penjadwalan dan pengiriman draft konten ke akun TikTok yang dihubungkan oleh pemilik akun. Kami tidak memposting konten secara langsung. Konten dikirim sebagai draf, dan hanya terbit jika pemilik akun mempublikasikannya sendiri dari aplikasi TikTok.</p>

            <h2 class="h4 fw-bold mt-4">2. Kewajiban pengguna</h2>
            <ul>
                <li>Anda hanya boleh mengunggah konten yang Anda miliki atau yang Anda punya hak untuk mengunggahnya.</li>
                <li>Anda bertanggung jawab atas isi konten yang Anda kirim, termasuk tidak melanggar hak pihak lain, hukum yang berlaku, dan ketentuan TikTok.</li>
                <li>Anda menjaga keamanan akun Anda dan dapat memutus koneksi akun TikTok kapan saja.</li>
            </ul>

            <h2 class="h4 fw-bold mt-4">3. Kepatuhan pada ketentuan TikTok</h2>
            <p>Penggunaan layanan ini wajib mematuhi Terms of Service dan Community Guidelines TikTok. Konten yang melanggar ketentuan TikTok dapat ditolak oleh TikTok, dan kami dapat membatasi akses pengguna yang melanggar.</p>

            <h2 class="h4 fw-bold mt-4">4. Batasan tanggung jawab</h2>
            <p>Layanan disediakan apa adanya. Kami tidak bertanggung jawab atas kerugian tidak langsung, termasuk kehilangan konten, kehilangan jangkauan, atau keputusan TikTok terhadap konten Anda. Batas tanggung jawab kami: [PERLU KEPUTUSAN: batas nilai ganti rugi].</p>

            <h2 class="h4 fw-bold mt-4">5. Perubahan layanan</h2>
            <p>Kami dapat mengubah atau menghentikan sebagian fitur layanan. Perubahan penting akan diumumkan melalui website. Jangka waktu pemberitahuan sebelum perubahan berlaku: [PERLU KEPUTUSAN].</p>

            <h2 class="h4 fw-bold mt-4">6. Hukum yang berlaku</h2>
            <p>Ketentuan ini tunduk pada hukum Republik Indonesia. Perselisihan diselesaikan terlebih dahulu melalui musyawarah. Pengadilan yang berwenang: [PERLU KEPUTUSAN].</p>

            <hr class="my-5">

            <h1 class="fw-bold mb-2">Terms of Service</h1>
            <p class="text-muted small mb-4">Bahasa Indonesia di atas. English version below.</p>

            <p class="mb-1"><strong>Service name:</strong> Jauki Tugas</p>
            <p class="mb-1"><strong>Website:</strong> <a href="https://jaukitugas.my.id">https://jaukitugas.my.id</a></p>
            <p class="mb-1"><strong>Contact:</strong> <a href="mailto:jaukiacademu@gmail.com">jaukiacademu@gmail.com</a></p>
            <p class="mb-4"><strong>Last updated:</strong> 1 November 2026</p>

            <h2 class="h4 fw-bold mt-4">1. Scope of the service</h2>
            <p>Jauki Tugas provides scheduling and delivery of content drafts to a TikTok account connected by the account owner. We do not post content directly. Content is sent as a draft and is published only if the account owner publishes it themselves from the TikTok app.</p>

            <h2 class="h4 fw-bold mt-4">2. User obligations</h2>
            <ul>
                <li>You may only upload content that you own or that you have the right to upload.</li>
                <li>You are responsible for the content you send, including not infringing the rights of others, applicable law, and TikTok's rules.</li>
                <li>You keep your account secure and may disconnect your TikTok account at any time.</li>
            </ul>

            <h2 class="h4 fw-bold mt-4">3. Compliance with TikTok's rules</h2>
            <p>Use of this service must comply with TikTok's Terms of Service and Community Guidelines. TikTok may reject content that violates its rules, and we may restrict access for users who violate them.</p>

            <h2 class="h4 fw-bold mt-4">4. Limitation of liability</h2>
            <p>The service is provided "as is". We are not liable for indirect losses, including loss of content, loss of reach, or TikTok's decisions about your content. Our liability cap: [PERLU KEPUTUSAN: liability cap amount].</p>

            <h2 class="h4 fw-bold mt-4">5. Changes to the service</h2>
            <p>We may change or discontinue parts of the service. Material changes will be announced on the website. Notice period before changes take effect: [PERLU KEPUTUSAN].</p>

            <h2 class="h4 fw-bold mt-4">6. Governing law</h2>
            <p>These terms are governed by the laws of the Republic of Indonesia. Disputes are first resolved through good-faith discussion. Competent court: [PERLU KEPUTUSAN].</p>

            <div class="text-center mt-5">
                <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-muted"><i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda</a>
            </div>
        </div>
    </div>
@endsection
