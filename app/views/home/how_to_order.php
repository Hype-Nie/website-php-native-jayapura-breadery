<?php ob_start(); ?>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0d6efd, #0a53be);
        --accent-gradient: linear-gradient(135deg, #f0f7ff, #ffffff);
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
    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }
    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: #e9ecef;
        border-radius: 4px;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 60px;
        width: 50%;
        padding-right: 40px;
    }
    .timeline-item:nth-child(even) {
        margin-left: auto;
        padding-right: 0;
        padding-left: 40px;
    }
    .timeline-dot {
        position: absolute;
        top: 0;
        right: -24px;
        width: 48px;
        height: 48px;
        background: var(--primary-gradient);
        border: 4px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        z-index: 2;
    }
    .timeline-item:nth-child(even) .timeline-dot {
        left: -24px;
        right: auto;
    }
    .timeline-content {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(13, 110, 253, 0.1);
    }
    .timeline-icon {
        font-size: 2.5rem;
        color: #0d6efd;
        margin-bottom: 15px;
    }
    .timeline-title {
        font-weight: 800;
        font-size: 1.4rem;
        color: #212529;
        margin-bottom: 10px;
    }
    .timeline-text {
        color: #6c757d;
        line-height: 1.7;
        margin-bottom: 0;
    }
    @media (max-width: 768px) {
        .timeline::before {
            left: 24px;
        }
        .timeline-item {
            width: 100%;
            padding-left: 70px !important;
            padding-right: 0 !important;
        }
        .timeline-dot {
            left: 0 !important;
            right: auto !important;
        }
    }
</style>

<div class="container py-5" style="max-width: 1200px;">
    <!-- Clean Header -->
    <div class="text-center mb-5 pb-3">
        <h1 class="fw-bold display-5" style="color: var(--on-surface);">Cara Pemesanan</h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
            Panduan praktis berbelanja koleksi tato temporer di TBJ.
        </p>
    </div>

    <div class="timeline">
        <!-- Step 1 -->
        <div class="timeline-item">
            <div class="timeline-dot">1</div>
            <div class="timeline-content">
                <i class="bx bx-search-alt timeline-icon"></i>
                <h3 class="timeline-title">Pilih Produk</h3>
                <p class="timeline-text">Telusuri halaman <strong>Katalog</strong> kami yang menyediakan berbagai desain tato kekinian. Klik gambar produk untuk melihat detail spesifikasinya.</p>
            </div>
        </div>
        
        <!-- Step 2 -->
        <div class="timeline-item">
            <div class="timeline-dot">2</div>
            <div class="timeline-content">
                <i class="bx bx-cart-add timeline-icon"></i>
                <h3 class="timeline-title">Masukkan Keranjang</h3>
                <p class="timeline-text">Tentukan jumlah barang dan klik tombol <strong>Tambah ke Keranjang</strong>. Produk Anda akan otomatis tersimpan sementara.</p>
            </div>
        </div>
        
        <!-- Step 3 -->
        <div class="timeline-item">
            <div class="timeline-dot">3</div>
            <div class="timeline-content">
                <i class="bx bx-file-find timeline-icon"></i>
                <h3 class="timeline-title">Checkout & Data</h3>
                <p class="timeline-text">Buka menu keranjang di sudut kanan atas, periksa pesanan Anda, klik <strong>Lanjut Pembayaran</strong>, dan isi data diri dengan lengkap.</p>
            </div>
        </div>
        
        <!-- Step 4 -->
        <div class="timeline-item">
            <div class="timeline-dot">4</div>
            <div class="timeline-content">
                <i class="bx bxl-whatsapp timeline-icon text-success"></i>
                <h3 class="timeline-title">Konfirmasi WhatsApp</h3>
                <p class="timeline-text">Sistem akan mengarahkan Anda ke WhatsApp Admin. Kami akan mengkonfirmasi total pembayaran dan metode pengambilannya.</p>
            </div>
        </div>
        
        <!-- Step 5 -->
        <div class="timeline-item">
            <div class="timeline-dot" style="background: #198754;"><i class="bx bx-check"></i></div>
            <div class="timeline-content" style="border-top: 4px solid #198754;">
                <i class="bx bx-store timeline-icon text-success"></i>
                <h3 class="timeline-title">Ambil & Tampil Kece!</h3>
                <p class="timeline-text">Pesanan siap diambil di Kontener Biru TBJ (Jembatan Merah). Kami buka setiap hari jam 5 Sore - 10 Malam.</p>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-5 pt-4">
        <a href="<?= BASE_URL ?>catalog" class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow" style="font-size: 1.1rem; background: var(--primary-gradient); border: none;">
            Mulai Belanja <i class="bx bx-right-arrow-alt ms-2"></i>
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/public_header.php';
?>
