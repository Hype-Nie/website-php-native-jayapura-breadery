<?php ob_start(); ?>

<style>
:root {
    --primary-color: #1E90FF;
    --secondary-color: #F39C12;
    --dark-color: #233446;
    --light-color: #f5f5f9;
}

.hero-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
    border-radius: 30px;
    margin-bottom: 80px;
    position: relative;
    overflow: hidden;
}

.hero-section::after {
    content: '';
    position: absolute;
    top: -10%;
    right: -10%;
    width: 40%;
    height: 80%;
    background: radial-gradient(circle, rgba(30, 144, 255, 0.1) 0%, transparent 70%);
    z-index: 0;
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--dark-color);
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: #8592a3;
    margin-bottom: 2.5rem;
    max-width: 600px;
}

.featured-section {
    padding: 60px 0;
}

.section-header {
    margin-bottom: 50px;
    text-align: center;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 1rem;
}

.category-card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    border-color: var(--primary-color);
}

.category-icon {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 20px;
    display: block;
}

.product-card-modern {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
}

.product-card-modern:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
}

.product-image-modern {
    width: 100%;
    height: 250px;
    object-fit: cover;
    background: #f8f9fa;
}

.product-info-modern {
    padding: 25px;
}

.product-tag-modern {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--secondary-color);
    margin-bottom: 10px;
    display: block;
}

.product-name-modern {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 15px;
    height: 3rem;
    overflow: hidden;
}

.product-price-modern {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary-color);
}

.btn-modern {
    padding: 12px 30px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary-modern {
    background: var(--primary-color);
    color: white;
    border: none;
}

.btn-primary-modern:hover {
    background: #1a82e6;
    box-shadow: 0 8px 15px rgba(30, 144, 255, 0.3);
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
}
</style>

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <span class="badge bg-label-primary mb-3">Selamat Datang di <?= APP_NAME ?></span>
                <h1 class="hero-title">Kreativitas Tanpa Batas dengan Manik-manik.</h1>
                <p class="hero-subtitle">
                    Temukan berbagai pilihan manik-manik berkualitas untuk perhiasan, aksesoris, dan kerajinan tangan Anda.
                    Dari yang klasik hingga modern, semua ada di sini.
                </p>
                <div class="d-flex gap-3">
                    <a href="<?= BASE_URL ?>catalog" class="btn btn-primary-modern btn-lg">
                        <i class="bx bx-shopping-bag me-2"></i> Jelajahi Produk
                    </a>
                    <a href="#featured" class="btn btn-outline-secondary btn-lg btn-modern">
                        Lihat Terpopuler
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <img src="<?= BASE_URL ?>assets/img/illustrations/man-with-laptop-light.png" alt="Hero Illustration" class="img-fluid" />
            </div>
        </div>
    </div>
</div>

<div class="container mb-5" id="categories">
    <div class="section-header">
        <h2 class="section-title">Kategori Unggulan</h2>
        <p class="text-muted">Pilih kategori yang sesuai dengan kebutuhan Anda</p>
    </div>
    <div class="row g-4">
        <?php foreach (array_slice($categories, 0, 4) as $cat): ?>
            <div class="col-md-3">
                <a href="<?= BASE_URL ?>catalog?category=<?= urlencode($cat->category) ?>" class="text-decoration-none">
                    <div class="category-card">
                        <i class="bx bx-purchase-tag category-icon"></i>
                        <h5 class="mb-0 text-dark"><?= htmlspecialchars($cat->category) ?></h5>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="featured-section bg-light py-5 mb-5" id="featured">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Produk Terbaru</h2>
            <p class="text-muted">Jangan lewatkan koleksi terbaru kami</p>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="product-card-modern">
                        <?php if (!empty($product->image)): ?>
                            <img src="<?= BASE_URL ?>assets/img/products/<?= $product->image ?>" alt="<?= htmlspecialchars($product->name) ?>" class="product-image-modern" />
                        <?php else: ?>
                            <div class="product-image-modern d-flex align-items-center justify-content-center bg-lighter">
                                <i class="bx bx-image-alt text-muted" style="font-size: 3rem;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="product-info-modern">
                            <span class="product-tag-modern"><?= htmlspecialchars($product->category) ?></span>
                            <h3 class="product-name-modern"><?= htmlspecialchars($product->name) ?></h3>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="product-price-modern">Rp <?= number_format($product->price, 0, ',', '.') ?></div>
                                <a href="<?= BASE_URL ?>catalog" class="btn btn-icon btn-label-primary rounded-circle">
                                    <i class="bx bx-right-arrow-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= BASE_URL ?>catalog" class="btn btn-outline-primary btn-lg btn-modern">
                Lihat Semua Produk
            </a>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <img src="<?= BASE_URL ?>assets/img/illustrations/girl-doing-yoga-light.png" alt="About" class="img-fluid" />
        </div>
        <div class="col-lg-6">
            <h2 class="section-title text-start">Tentang <?= APP_NAME ?></h2>
            <p class="mb-4 text-muted" style="font-size: 1.1rem; line-height: 1.8;">
                Kami adalah penyedia manik-manik terpercaya di Jayapura. Kami berkomitmen untuk menyediakan bahan-bahan berkualitas tinggi untuk menunjang kreativitas Anda dalam membuat perhiasan dan aksesoris unik.
            </p>
            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 bg-label-success rounded">
                            <i class="bx bx-check text-success fs-4"></i>
                        </div>
                        <h6 class="mb-0">Kualitas Premium</h6>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 bg-label-info rounded">
                            <i class="bx bx-time text-info fs-4"></i>
                        </div>
                        <h6 class="mb-0">Stok Selalu Update</h6>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 bg-label-warning rounded">
                            <i class="bx bx-wallet text-warning fs-4"></i>
                        </div>
                        <h6 class="mb-0">Harga Terjangkau</h6>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 bg-label-danger rounded">
                            <i class="bx bx-map text-danger fs-4"></i>
                        </div>
                        <h6 class="mb-0">Lokasi Strategis</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../app/views/layouts/public_header.php';
?>
