<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT PLN Indonesia Power</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('<?= base_url('uploads/beranda.png') ?>') no-repeat center center/cover;
            padding-top: 70px; /* Sesuaikan dengan tinggi navbar */
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section dengan Parallax Effect */
        .hero {
            position: relative;
            height: 100vh;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('<?= base_url('uploads/beranda.jpg') ?>') no-repeat center center;
            background-size: cover;
            z-index: -2;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Overlay gelap */
            z-index: -1;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            animation: fadeInDown 1.5s ease-in-out;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .hero .btn {
            margin-top: 20px;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 5px;
            animation: fadeIn 2s ease-in-out;
        }

        /* Animasi */
        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* News Section */
        .news-section {
            padding: 3rem 1rem;
            background-color: #f8f9fa;
        }

        .news-section h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #004085;
        }

        .news-section .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
        }

        .news-section .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .news-section .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-section .card-body {
            padding: 1rem;
            text-align: left;
        }

        .news-section .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .news-section .card-text {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: #555;
        }

        .news-section .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .news-section .btn:hover {
            background-color: #0056b3;
        }

        /* Video and Text Section */
        .video-text-section {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 50px;
            gap: 20px;
            background-color: #ffffff;
        }

        .video-container {
            flex: 1;
        }

        .video-container iframe {
            width: 100%;
            height: 300px;
            border: none;
        }

        .text-container {
            flex: 1;
        }

        .text-container h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .text-container p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        /* Maps and Form Section */
        .map-form-section {
            padding: 50px;
            background-color: #f8f9fa;
        }

        .map-container iframe {
            width: 100%;
            height: 350px;
            border: none;
            border-radius: 8px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea,
        .form-container button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Loading Animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <!-- Loading Animation -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('uploads/logo.png') ?>" alt="Beranda" width="50" height="50">
                PLN Indonesia Power
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Sekilas Indonesia Power</a></li>
                            <li><a class="dropdown-item" href="#">Manajemen</a></li>
                            <li><a class="dropdown-item" href="#">Sejarah</a></li>
                            <li><a class="dropdown-item" href="#">Penghargaan dan Sertifikasi</a></li>
                            <li><a class="dropdown-item" href="#">Kinerja Perusahaan</a></li>
                            <li><a class="dropdown-item" href="#">Testimoni Stakeholder</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <h1>Total Business Solution</h1>
        <p>Indonesia Power menjadikan Indonesia Powerful. Berpengalaman menyediakan energi listrik lebih dari 25 tahun melalui pembangkit tenaga listrik yang tersebar di seluruh Indonesia.</p>
        <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg">Login</a>
    </header>

    <!-- News Section -->
    <section class="news-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">BERITA TERBARU</h2>
            <div class="row">
                <!-- Berita 1 -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= base_url('gambar/transformasi.jpeg') ?>" class="card-img-top" alt="Berita 1">
                        <div class="card-body">
                            <h5 class="card-title">Dibalik Keberhasilan PLN Indonesia Power Dalam Melakuka...</h5>
                            <p class="card-text"><small class="text-muted">08 November 2024</small></p>
                            <p class="card-text">KETERANGAN PERS NO. 076/RELEASE/PLNIP/2024</p>
                            <p class="card-text">Di Balik Keberhasilan PLN Indonesia Power Dalam Melakukan...</p>
                            <a href="#" class="btn btn-link">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Berita 2 -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= base_url('gambar/Panas.jpeg') ?>" class="card-img-top" alt="Berita 2">
                        <div class="card-body">
                            <h5 class="card-title">Optimalkan Energi Panas Bumi, PLN Indonesia Power Proaktif D...</h5>
                            <p class="card-text"><small class="text-muted">24 Oktober 2024</small></p>
                            <p class="card-text">KETERANGAN PERS NO. 074/RELEASE/PLNIP/2024</p>
                            <p class="card-text">Inovasi PLN Indonesia Power Menekan Emisi Dapat Pengakuan...</p>
                            <a href="#" class="btn btn-link">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Berita 3 -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= base_url('gambar/award.jpeg') ?>" class="card-img-top" alt="Berita 3">
                        <div class="card-body">
                            <h5 class="card-title">Beyond Compliance, PLN Indonesia Power Raih Penghargaan Tertinggi Pa...</h5>
                            <p class="card-text"><small class="text-muted">15 Oktober 2024</small></p>
                            <p class="card-text">KETERANGAN PERS NO. 073/RELEASE/PLNIP/2024PLN Indonesia Power Borong Subroto Award 2024, Wujud Kontribusi...</p>
                            <p class="card-text">KETERANGAN PERS NO. 073/RELEASE/PLNIP/2024
                            <p class="card-text">PLN Indonesia Power Borong Subroto Award 2024, Wujud Kontribusi...</p>
                            <a href="#" class="btn btn-link">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Video and Text Section -->
    <section class="video-text-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 video-container">
                    <iframe src="https://www.youtube.com/embed/example_video_id" allowfullscreen></iframe>
                </div>
                <div class="col-md-6 text-container">
                    <h2>INDONESIA POWER SUKSES RAIH 2 PROPER EMAS 2019</h2>
                    <p>PT Indonesia Power berhasil memborong 2 penghargaan tertinggi dalam kinerja pengelolaan lingkungan (Proper periode 2019). Sebagai salah satu anak usaha PT PLN (Persero), PT Indonesia Power melalui dua unitnya berhasil meraih 2 penghargaan Proper Emas. Penghargaan ini diterima oleh Direktur Utama PT Indonesia Power M Ashin Sidqi dan Direktur Operasi I M. Hanafi Nur Rifai'i, yang diberikan oleh Wakil Presiden RI Ma'ruf Amin di Istana Wakil Presiden RI, Rabu (8/01).</p>
                    <p>Proper Emas sebagai peringkat tertinggi dari penilaian proper merupakan bukti upaya berkelanjutan Indonesia Power dalam bidang lingkungan, efisiensi energi serta pengembangan dan pemberdayaan masyarakat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Maps and Form Section -->
    <section class="map-form-section">
        <div class="container">
            <div class="row">
                <!-- Map Container -->
                <div class="col-md-6 map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.4805447188705!2d110.42783597475749!3d-6.9525022930478055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f3575eb4a9bf%3A0xfd980aba05d8ed13!2sPT%20PLN%20Indonesia%20Power%20UBP%20Semarang!5e0!3m2!1sid!2sid!4v1735450425357!5m2!1sid!2sid" 
                        width="100%" 
                        height="350" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <!-- Form Container -->
                <div class="col-md-6 form-container">
                    <form class="contact-form" action="#" method="post">
                        <input type="text" name="name" placeholder="Nama" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <select name="subject" required>
                            <option value="">Pilih Subjek</option>
                            <option value="CSR">CSR</option>
                            <option value="K3">K3</option>
                            <option value="Operasi Pembangkit">Operasi Pembangkit</option>
                            <option value="Informasi Korporat">Informasi Korporat</option>
                            <option value="Jasa Pemeliharaan">Jasa Pemeliharaan</option>
                            <option value="SDM">SDM</option>
                            <option value="Procurement">Procurement</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Other">Other</option>
                        </select>
                        <textarea name="message" rows="5" placeholder="Pesan" required></textarea>
                        <button type="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

   
   <!-- Footer -->
<footer class="bg-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <!-- Informasi Perusahaan -->
            <div class="col-md-6 mb-4 mb-md-0" style="color: black;">
                <h5 class="font-weight-bold">PT PLN Indonesia Power UBP Semarang</h5>
                <p>Jl. Prof. Dr. Hamka No.32, Ngaliyan, Kota Semarang, Jawa Tengah 50181</p>
                <p><strong>Telepon:</strong> (024) 8661111</p>
                <p><strong>Email:</strong> ubp.semarang@indonesiapower.co.id</p>
            </div>
            <!-- Social Media -->
            <div class="col-md-6 text-md-left" style="color: black;">
                <h5 class="font-weight-bold">Social Media Kami</h5>
                <a href="https://www.instagram.com/plnip.ubpsemarang/" target="_blank" class="btn btn-outline-dark mx-1">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <a href="https://web.facebook.com/p/PT-PLN-Indonesia-Power-UBP-Semarang-61559618737181/?_rdc=1&_rdr" 
                target="_blank" 
                class="btn btn-outline-dark mx-1">
                    <i class="fab fa-facebook"></i> Facebook
                </a>
            </div>
        </div>
    </div>
</footer>

    <!-- Script untuk Loading Animation -->
    <script>
        window.addEventListener('load', function() {
            const loading = document.querySelector('.loading');
            loading.style.display = 'none';
        });
    </script>
</body>
</html>