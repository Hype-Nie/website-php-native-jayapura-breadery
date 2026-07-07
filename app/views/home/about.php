<?php ob_start(); ?>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0d6efd, #0a53be);
    }
    .hero-header {
        background: var(--primary-gradient);
        padding: 80px 0;
        border-radius: 0 0 40px 40px;
        color: white;
        text-align: center;
        margin-bottom: 60px;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
    }
    .about-image-wrapper {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    .about-image-wrapper img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .about-image-wrapper:hover img {
        transform: scale(1.03);
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(13, 110, 253, 0.1);
        border-color: rgba(13, 110, 253, 0.1);
    }
    .feature-icon-box {
        width: 70px;
        height: 70px;
        background: #f0f7ff;
        color: #0d6efd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        transition: all 0.3s ease;
    }
    .feature-card:hover .feature-icon-box {
        background: var(--primary-gradient);
        color: white;
        transform: scale(1.1) rotate(5deg);
    }
    .feature-title {
        font-weight: 800;
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #212529;
    }
    .feature-text {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
    }
</style>

<div class="container py-5" style="max-width: 1200px;">
    <!-- Clean Header -->
    <div class="text-center mb-5 pb-3">
        <h1 class="fw-bold display-5" style="color: var(--on-surface);">Tentang Kami</h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
            Mengenal lebih dekat cerita di balik <?= APP_NAME ?>
        </p>
    </div>

    <div class="row align-items-center g-5 mb-5 pb-4">
        <div class="col-lg-6 position-relative z-1">
            <div class="pe-lg-4">
                <span class="badge bg-primary text-white px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="letter-spacing: 1px;">KAMI ADALAH TBJ</span>
                <h2 class="fw-bold mb-4" style="font-size: 2.5rem; color: #1a1d20; line-height: 1.3;">
                    Pusat Aksesoris & Tato Temporer Kekinian di Jayapura
                </h2>
                <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">
                    Hadir sejak tahun 2023, kami berkomitmen penuh untuk selalu menjadi penyedia utama yang melengkapi <em>style</em> kamu setiap harinya. Kami ingin kamu tampil lebih berani, percaya diri, dan ekspresif.
                </p>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    Kami percaya bahwa setiap detail kecil yang kamu pakai punya cerita sendiri. Itulah alasan TBJ terus tumbuh, tidak hanya sekadar mengikuti tren, namun menyentuh keunikan setiap pelanggan setia kami.
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="about-image-wrapper">
                <div class="brand-showcase-card d-flex flex-column justify-content-center align-items-center w-100" style="position: relative; min-height: 450px; border-radius: 24px; background: linear-gradient(135deg, #f0f7ff 0%, #e1f0ff 100%); box-shadow: 10px 20px 40px rgba(0,0,0,0.08); overflow: hidden; transition: all 0.4s ease; border: 1px solid rgba(255,255,255,0.4); z-index: 1;">
                    <!-- Decorative background blobs: Yellow and Blue -->
                    <div style="position: absolute; top: -50px; left: -50px; width: 250px; height: 250px; background: linear-gradient(135deg, rgba(255,215,0,0.5) 0%, rgba(255,235,59,0.5) 100%); border-radius: 50%; filter: blur(45px); z-index: 0;"></div>
                    <div style="position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background: linear-gradient(120deg, rgba(33,150,243,0.4) 0%, rgba(3,169,244,0.4) 100%); border-radius: 50%; filter: blur(55px); z-index: 0;"></div>
                    
                    <!-- Content -->
                    <div style="z-index: 1; text-align: center; transform: translateY(0); transition: transform 0.4s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; justify-content: center; align-items: center; margin: 0 auto 5px auto;">
                            <img src="<?= BASE_URL ?>assets/img/logo/logo.png" alt="Logo <?= APP_NAME ?>" style="width: 280px; height: auto; filter: drop-shadow(0px 15px 25px rgba(0,0,0,0.15)); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <h3 class="brand-text-3d px-3 text-center" style="font-size: 2.2rem !important; margin-top: 5px; margin-bottom: 12px; white-space: normal; line-height: 1.3;"><?= APP_NAME ?></h3>
                        <div class="d-block w-100">
                            <div class="d-inline-block px-4 py-1 rounded-pill" style="background: rgba(255, 215, 0, 0.9); border: 1px solid rgba(255, 215, 0, 1); box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);">
                                <span class="fw-bold" style="letter-spacing: 2px; text-transform: uppercase; font-size: 0.85rem; color: #1a1a1a;">Est. 2023</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="text-center mb-5 pt-4">
        <h2 class="fw-bold mb-3" style="font-size: 2.2rem;">Kenapa Memilih Kami?</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">Kami memberikan pelayanan maksimal demi memastikan gaya Anda selalu up-to-date dan berkualitas.</p>
    </div>
    
    <div class="row g-4">
        <!-- Feature 1 -->
        <div class="col-sm-6 col-lg-3">
            <div class="feature-card text-center">
                <div class="feature-icon-box">
                    <i class="bx bx-check-circle"></i>
                </div>
                <h3 class="feature-title">Kualitas Terjamin</h3>
                <p class="feature-text">Produk tato temporer kami diimpor dengan kualitas premium yang sangat aman bagi kulit.</p>
            </div>
        </div>
        
        <!-- Feature 2 -->
        <div class="col-sm-6 col-lg-3">
            <div class="feature-card text-center">
                <div class="feature-icon-box">
                    <i class="bx bx-time-five"></i>
                </div>
                <h3 class="feature-title">Selalu Baru</h3>
                <p class="feature-text">Koleksi kami terus di-update setiap minggu dengan desain terbaru yang sedang hype.</p>
            </div>
        </div>
        
        <!-- Feature 3 -->
        <div class="col-sm-6 col-lg-3">
            <div class="feature-card text-center">
                <div class="feature-icon-box">
                    <i class="bx bx-wallet-alt"></i>
                </div>
                <h3 class="feature-title">Harga Bersahabat</h3>
                <p class="feature-text">Tampil gaya tidak perlu menguras dompet. Harga kami sangat bersaing untuk kualitas sultan.</p>
            </div>
        </div>
        
        <!-- Feature 4 -->
        <div class="col-sm-6 col-lg-3">
            <div class="feature-card text-center">
                <div class="feature-icon-box">
                    <i class="bx bx-map"></i>
                </div>
                <h3 class="feature-title">Mudah Diakses</h3>
                <p class="feature-text">Lokasi toko kami di Jembatan Merah sangat strategis, dan sistem pesanan online sangat praktis.</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/public_header.php';
?>
