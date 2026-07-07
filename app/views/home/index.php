<?php ob_start(); ?>

<style>
:root {
    --primary-color: #1B4571; /* Royal Blue from banner */
    --primary-dark: #133458;
    --surface-color: #FFFFFF;
    --on-surface: #121D3D; /* Navy Blue for text */
    --border-color: rgba(27, 69, 113, 0.08);
    --muted-color: #5A7492;
    --font-family-base: 'Poppins', system-ui, sans-serif;
    --body-bg: #F0F4F8; /* Soft Ice Blue */
}

body {
    font-family: var(--font-family-base);
    background-color: var(--body-bg) !important;
    color: var(--on-surface);
    line-height: 1.5;
}

/* Typography Scale */
.text-display { font-size: 32px; font-weight: 700; line-height: 38px; }
.text-headline-lg { font-size: 24px; font-weight: 700; line-height: 29px; }
.text-headline-md { font-size: 20px; font-weight: 600; line-height: 24px; }
.text-body-md { font-size: 16px; font-weight: 400; line-height: 1.5; }
.text-body-sm { font-size: 14px; font-weight: 400; line-height: 1.4; }
.text-label-md { font-size: 14px; font-weight: 500; }

/* Buttons */
.btn-compact {
    padding: 11px 16px;
    height: 40px;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 150ms ease;
    text-decoration: none;
}
.btn-primary-compact {
    background-color: var(--primary-color);
    color: var(--neutral-color);
    border-radius: 12px;
    border: none;
}
.btn-primary-compact:hover {
    background-color: var(--primary-dark);
    color: var(--neutral-color);
}
.btn-secondary-compact {
    background-color: transparent;
    color: var(--on-surface);
    border-radius: 4px;
    border: 1px solid var(--border-color);
}
.btn-secondary-compact:hover {
    background-color: #f9fafb;
}
.btn-outline-white {
    background-color: transparent;
    color: var(--neutral-color);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 4px;
}
.btn-outline-white:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--neutral-color);
}

/* Hero Section */
.hero-slider-wrapper {
    margin-bottom: 40px;
}
.hero-carousel {
    background-color: #f9fafb;
    position: relative;
}
.hero-carousel .carousel-item {
    height: 50vh;
    min-height: 400px;
    position: relative;
}
@media (min-width: 992px) {
    .hero-carousel .carousel-item {
        height: 80vh;
        min-height: 600px;
        max-height: 900px;
    }
}
.hero-image-banner {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.carousel-indicators [data-bs-target] {
    width: 32px;
    height: 4px;
    border-radius: 2px;
    background-color: var(--primary-color);
    opacity: 0.5;
    border: none;
    transition: opacity 150ms ease;
}
.carousel-indicators .active {
    opacity: 1;
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.hero-carousel:hover .carousel-control-prev, 
.hero-carousel:hover .carousel-control-next {
    opacity: 0.8;
}
.carousel-control-icon-bg {
    background-color: rgba(255,255,255,0.7);
    color: var(--on-surface);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    font-size: 24px;
    transition: all 0.2s ease;
}
.carousel-control-prev:hover .carousel-control-icon-bg, 
.carousel-control-next:hover .carousel-control-icon-bg {
    background-color: white;
    color: var(--primary-color);
}
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 16px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.carousel-indicators [data-bs-target] {
    width: 24px;
    height: 4px;
    border-radius: 2px;
    background-color: var(--neutral-color);
    opacity: 0.4;
    border: none;
    transition: opacity 150ms ease;
}
.carousel-indicators .active {
    opacity: 1;
}

/* Section Styles */
.section-wrapper {
    margin-bottom: 60px;
    padding-top: 20px;
}
.section-header-centered {
    text-align: center;
    margin-bottom: 32px;
}
.section-title-clean {
    font-size: 28px;
    font-weight: 800;
    color: var(--on-surface);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}
.section-subtitle-clean {
    font-size: 14px;
    color: var(--muted-color);
    max-width: 500px;
    margin: 0 auto;
}

/* Category Circles */
.categories-wrapper {
    display: flex;
    gap: 32px;
    overflow-x: auto;
    padding: 10px 10px 24px;
    justify-content: center;
    scrollbar-width: none; /* Firefox */
}
.categories-wrapper::-webkit-scrollbar {
    display: none;
}
.category-circle-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    min-width: 90px;
}
.category-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--surface-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: var(--primary-color);
    box-shadow: 0 4px 16px rgba(30, 144, 255, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-circle-link:hover .category-circle {
    transform: translateY(-6px);
    box-shadow: 0 10px 24px rgba(30, 144, 255, 0.15);
}
.category-circle-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--on-surface);
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Clean Product Cards */
.product-card-clean {
    display: flex;
    flex-direction: column;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: transparent;
    height: 100%;
    position: relative;
}
.product-card-clean:hover {
    transform: translateY(-8px);
}
.product-image-clean-container {
    background: var(--surface-color);
    border-radius: 16px;
    overflow: hidden;
    height: 280px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    border: 1px solid rgba(0,0,0,0.02);
    position: relative;
    transition: all 0.4s ease;
}
.product-card-clean:hover .product-image-clean-container {
    box-shadow: 0 15px 35px rgba(30, 144, 255, 0.12);
}
.product-image-clean {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.product-card-clean:hover .product-image-clean {
    transform: scale(1.08);
}
.product-image-overlay {
    position: absolute;
    inset: 0;
    background: rgba(18, 29, 61, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s ease;
    z-index: 2;
}
.product-card-clean:hover .product-image-overlay {
    opacity: 1;
}
.btn-quick-add {
    background: #FFFFFF;
    color: var(--on-surface);
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.btn-quick-add:hover {
    background: var(--primary-color);
    color: #FFFFFF;
}
.product-card-clean:hover .btn-quick-add {
    transform: translateY(0);
}
.product-info-clean {
    text-align: center;
    padding: 0 10px;
}
.product-tag-clean {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--muted-color);
    margin-bottom: 6px;
    display: block;
    font-weight: 600;
}
.product-name-clean {
    font-size: 16px;
    font-weight: 700;
    color: var(--on-surface);
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
    transition: color 0.3s ease;
}
.product-card-clean:hover .product-name-clean {
    color: var(--primary-color);
}
.product-price-clean {
    font-size: 17px;
    font-weight: 800;
    color: var(--primary-color);
}
.btn-premium-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    background: var(--on-surface);
    color: #FFFFFF;
    padding: 16px 40px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(18, 29, 61, 0.15);
}
.btn-premium-action:hover {
    background: var(--primary-color);
    color: #FFFFFF;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(30, 144, 255, 0.3);
}
.btn-premium-action i {
    font-size: 20px;
    transition: transform 0.3s ease;
}
.btn-premium-action:hover i {
    transform: translateX(6px);
}

/* Premium Value Proposition */
.value-prop-section-premium {
    padding: 80px 0;
    background: #FFFFFF;
    border-radius: 32px;
    box-shadow: 0 10px 40px rgba(30, 144, 255, 0.03);
    margin: 60px 0;
}
.value-main-title {
    font-size: 40px;
    font-weight: 800;
    color: var(--on-surface);
    line-height: 1.2;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.value-main-desc {
    font-size: 16px;
    color: var(--muted-color);
    line-height: 1.6;
}
.value-list {
    display: flex;
    flex-direction: column;
    gap: 32px;
}
.value-list-item {
    display: flex;
    align-items: flex-start;
    gap: 24px;
}
.value-number {
    font-size: 56px;
    font-weight: 900;
    color: rgba(30, 144, 255, 0.15);
    line-height: 0.8;
    min-width: 70px;
    letter-spacing: -2px;
}
.value-text h4 {
    font-size: 20px;
    font-weight: 700;
    color: var(--on-surface);
    margin-bottom: 8px;
}
.value-text p {
    font-size: 15px;
    color: var(--muted-color);
    margin: 0;
    line-height: 1.6;
}

/* About Section */
.about-section-compact {
    background-color: var(--surface-color);
    padding: 60px 0;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(30, 144, 255, 0.05);
    margin-bottom: 60px;
}
.about-text-compact {
    font-size: 16px;
    color: var(--muted-color);
    line-height: 1.8;
}
.feature-item-compact {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 15px;
    font-weight: 600;
    color: var(--on-surface);
}
.feature-icon-compact {
    color: var(--primary-color);
    font-size: 24px;
    background: rgba(30, 144, 255, 0.1);
    padding: 6px;
    border-radius: 8px;
}

@media (max-width: 991px) {
    .carousel-slide-content {
        flex-direction: column;
        padding: 32px 24px;
        text-align: center;
    }
    .hero-text-content {
        padding-right: 0;
        margin-bottom: 24px;
    }
    .hero-title {
        font-size: 28px;
    }
    .hero-carousel .carousel-item {
        height: auto;
        min-height: 500px;
    }
}
</style>

<div class="hero-slider-wrapper w-100">
    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover" data-bs-touch="true" data-bs-keyboard="true">
        
        <?php if (!empty($heroSlides)): ?>
            <div class="carousel-indicators">
                <?php foreach ($heroSlides as $index => $slide): ?>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($heroSlides as $index => $slide): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <?php if (!empty($slide->cta_url)): ?>
                            <a href="<?= BASE_URL . ltrim($slide->cta_url, '/') ?>" class="d-block w-100 h-100">
                                <img src="<?= BASE_URL ?>assets/img/hero-slides/<?= htmlspecialchars($slide->image) ?>" alt="Banner" class="hero-image-banner" />
                            </a>
                        <?php else: ?>
                            <img src="<?= BASE_URL ?>assets/img/hero-slides/<?= htmlspecialchars($slide->image) ?>" alt="Banner" class="hero-image-banner" />
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($heroSlides) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <div class="carousel-control-icon-bg">
                        <i class="bx bx-chevron-left"></i>
                    </div>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <div class="carousel-control-icon-bg">
                        <i class="bx bx-chevron-right"></i>
                    </div>
                    <span class="visually-hidden">Next</span>
                </button>
            <?php endif; ?>

        <?php else: ?>
            <!-- Fallback Static Banner -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= BASE_URL ?>assets/img/hero-slides/hero_fallback_tbj.jpg" alt="Hero Illustration" class="hero-image-banner" />
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="container section-wrapper" id="categories">
    <div class="section-header-centered">
        <h2 class="section-title-clean">Pilihan Kategori</h2>
        <p class="section-subtitle-clean">Temukan berbagai koleksi terbaik kami untuk menunjang penampilanmu</p>
    </div>
    <div class="categories-wrapper">
        <?php foreach ($categories as $cat): ?>
            <a href="<?= BASE_URL ?>catalog?category=<?= urlencode($cat->category) ?>" class="category-circle-link">
                <div class="category-circle">
                    <i class="bx bx-category-alt"></i>
                </div>
                <span class="category-circle-name"><?= htmlspecialchars($cat->category) ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
    <div class="value-prop-section-premium">
        <div class="row align-items-center g-5 px-4 px-md-5">
            <div class="col-lg-5">
                <h2 class="value-main-title">Kenapa<br>Memilih TBJ?</h2>
                <p class="value-main-desc">Kami menghadirkan pengalaman belanja aksesoris yang didesain khusus untuk kenyamanan dan kepuasan gaya Anda.</p>
            </div>
            <div class="col-lg-7">
                <div class="value-list">
                    <div class="value-list-item">
                        <div class="value-number">01</div>
                        <div class="value-text">
                            <h4>Pesan Online, Ambil Praktis</h4>
                            <p>Tak perlu antre panjang di toko. Anda bisa checkout barang incaran secara online, lalu ambil pesanan langsung di stan kami dengan cepat.</p>
                        </div>
                    </div>
                    <div class="value-list-item">
                        <div class="value-number">02</div>
                        <div class="value-text">
                            <h4>Kualitas Terkurasi (Premium)</h4>
                            <p>Semua koleksi aksesoris, pernak-pernik, dan tato temporer kami melewati proses seleksi kualitas yang sangat ketat untuk hasil maksimal.</p>
                        </div>
                    </div>
                    <div class="value-list-item">
                        <div class="value-number">03</div>
                        <div class="value-text">
                            <h4>Bayar Nyaman di Kasir</h4>
                            <p>Periksa kembali kelengkapan belanjaan Anda saat pengambilan di lokasi, lalu lakukan pembayaran dengan aman langsung di kasir kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container section-wrapper" id="featured">
    <div class="section-header-centered">
        <h2 class="section-title-clean">Koleksi Terbaru</h2>
        <p class="section-subtitle-clean">Lihat produk-produk terbaru yang paling diminati</p>
    </div>
    <div class="row g-4">
        <?php foreach ($featuredProducts as $product): ?>
            <?php $isAvailable = $product->stock > 0; ?>
            <div class="col-md-4 col-lg-3 col-6">
                <a href="<?= BASE_URL ?>catalog/detail/<?= $product->id ?>" class="product-card-clean">
                    <div class="product-image-clean-container">
                        <div class="product-image-overlay">
                            <?php if ($isAvailable): ?>
                                <button class="btn-quick-add btn-add-to-cart" data-id="<?= $product->id ?>">
                                    <i class="bx bx-shopping-bag"></i> Tambah
                                </button>
                            <?php else: ?>
                                <button class="btn-quick-add" disabled style="opacity:0.8;">Habis</button>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($product->image)): ?>
                            <img src="<?= BASE_URL ?>assets/img/products/<?= $product->image ?>" alt="<?= htmlspecialchars($product->name) ?>" class="product-image-clean" />
                        <?php else: ?>
                            <div class="product-image-clean d-flex align-items-center justify-content-center bg-light">
                                <i class="bx bx-image-alt text-muted" style="font-size: 4rem;"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info-clean">
                        <span class="product-tag-clean"><?= htmlspecialchars($product->category) ?></span>
                        <h3 class="product-name-clean"><?= htmlspecialchars($product->name) ?></h3>
                        <div class="product-price-clean">Rp <?= number_format($product->price, 0, ',', '.') ?></div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-5">
        <a href="<?= BASE_URL ?>catalog" class="btn-premium-action">
            Lihat Semua Koleksi <i class="bx bx-right-arrow-alt"></i>
        </a>
    </div>
</div>

<!-- Toast Feedback -->
<div id="toast-minimal" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px); background: #233446; color: white; padding: 12px 25px; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); z-index: 10000; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; align-items: center; gap: 10px; opacity: 0; font-size: 0.85rem; width: max-content; max-width: 85vw; pointer-events: none;">
    <i class="bx bx-check-circle text-success fs-5"></i>
    <span id="toast-msg">Berhasil!</span>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.getElementById('toast-minimal');
    const toastMsg = document.getElementById('toast-msg');
    
    function showToast(msg) {
        toastMsg.textContent = msg;
        toast.style.opacity = '1';
        toast.style.transform = 'translateX(-50%) translateY(0)';
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(-50%) translateY(100px)';
        }, 3000);
    }

    function runCartAnimation(startElement) {
        const cartIcon = document.querySelector('.navbar-modern .bx-shopping-bag') || document.querySelector('.cart-fab i');
        if (!cartIcon) return;
        const productCard = startElement.closest('.product-card-clean');
        const productImg = productCard ? productCard.querySelector('.product-image-clean') : null;
        const startRect = (productImg || startElement).getBoundingClientRect();
        const endRect = cartIcon.getBoundingClientRect();
        const animated = document.createElement('div');
        animated.style.position = 'fixed';
        animated.style.zIndex = '10000';
        animated.style.width = '60px';
        animated.style.height = '60px';
        animated.style.borderRadius = '12px';
        animated.style.overflow = 'hidden';
        animated.style.left = startRect.left + 'px';
        animated.style.top = startRect.top + 'px';
        animated.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        
        if (productImg && productImg.tagName === 'IMG' && productImg.src) {
            const img = document.createElement('img');
            img.src = productImg.src;
            img.style.width = '100%'; img.style.height = '100%'; img.style.objectFit = 'cover';
            animated.appendChild(img);
        } else if (productImg) {
            const cloned = productImg.cloneNode(true);
            cloned.style.width = '100%'; cloned.style.height = '100%';
            animated.appendChild(cloned);
        } else { 
            animated.style.background = 'var(--primary-color)'; 
        }
        
        document.body.appendChild(animated);
        setTimeout(() => {
            animated.style.left = endRect.left + 'px';
            animated.style.top = endRect.top + 'px';
            animated.style.width = '20px'; animated.style.height = '20px';
            animated.style.opacity = '0.3'; animated.style.transform = 'scale(0.1) rotate(360deg)';
        }, 50);
        setTimeout(() => {
            animated.remove();
            const target = cartIcon.closest('.btn-cart-modern') || cartIcon.parentElement;
            if(target && target.classList) {
                target.style.transform = 'scale(1.3)';
                setTimeout(() => target.style.transform = 'scale(1)', 400);
            }
        }, 850);
    }

    document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // prevent link click
            const id = this.dataset.id;
            const originalHtml = this.innerHTML;
            this.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>';
            this.disabled = true;
            fetch('<?= BASE_URL ?>cart/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                body: `product_id=${id}&quantity=1`
            })
            .then(res => res.json())
            .then(data => {
                this.innerHTML = originalHtml; this.disabled = false;
                if (data.success) {
                    runCartAnimation(this); showToast(data.message);
                    const navBadge = document.getElementById('navCartCount');
                    if (navBadge) { navBadge.textContent = data.cart_count; navBadge.style.display = 'flex'; }
                } else { showGlobalToast(data.message || 'Terjadi kesalahan', 'danger'); }
            })
            .catch(() => { this.innerHTML = originalHtml; this.disabled = false; });
        });
    });
});
</script>

<div class="about-section-compact mt-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="brand-showcase-card d-flex flex-column justify-content-center align-items-center" style="position: relative; width: 100%; height: 500px; border-radius: 24px; background: linear-gradient(135deg, #f0f7ff 0%, #e1f0ff 100%); box-shadow: 10px 20px 40px rgba(0, 0, 0, 0.08); overflow: hidden; transition: all 0.4s ease; border: 1px solid rgba(255,255,255,0.4);">
                    <!-- Decorative background blobs: Yellow and Blue -->
                    <div style="position: absolute; top: -50px; left: -50px; width: 250px; height: 250px; background: linear-gradient(135deg, rgba(255,215,0,0.5) 0%, rgba(255,235,59,0.5) 100%); border-radius: 50%; filter: blur(45px); z-index: 0;"></div>
                    <div style="position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background: linear-gradient(120deg, rgba(33,150,243,0.4) 0%, rgba(3,169,244,0.4) 100%); border-radius: 50%; filter: blur(55px); z-index: 0;"></div>
                    
                    <!-- Content -->
                    <div style="z-index: 1; text-align: center; transform: translateY(0); transition: transform 0.4s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="display: flex; justify-content: center; align-items: center; margin: 0 auto 5px auto;">
                            <img src="<?= BASE_URL ?>assets/img/logo/logo.png" alt="Logo <?= APP_NAME ?>" style="width: 250px; height: auto; filter: drop-shadow(0px 15px 25px rgba(0,0,0,0.15)); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <h3 class="brand-text-3d px-3 text-center" style="font-size: 2.2rem !important; margin-top: 5px; margin-bottom: 12px; white-space: normal; line-height: 1.3;"><?= APP_NAME ?></h3>
                        <div class="d-block w-100">
                            <div class="d-inline-block px-4 py-1 rounded-pill" style="background: rgba(255, 215, 0, 0.9); border: 1px solid rgba(255, 215, 0, 1); box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);">
                                <span class="fw-bold" style="letter-spacing: 2px; text-transform: uppercase; font-size: 0.75rem; color: #1a1a1a;">Est. 2023</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="section-title-compact mb-3">Tentang <?= APP_NAME ?></h2>
                <p class="about-text-compact">
                  (TBJ) adalah Pusatnya Aksesoris kekinian dan Tato Temporer di Jayapura yang hadir sebagai tempat penyedia utama untuk penunjang style kamu. Berdiri sejak tahun 2023, kami berkomitmen penuh untuk selalu menjadi tempat pelengkap style kamu setiap hari agar kamu bisa tampil lebih percaya diri dan ekspresif.
                </p>
                <p class="about-text-compact mb-4">
                  Kami percaya bahwa setiap detail kecil yang kamu pakai punya cerita sendiri. Itulah alasan TBJ terus tumbuh bersama kamu, menghadirkan koleksi yang tidak hanya mengikuti tren, tapi juga menyentuh sisi unik dari setiap "sayang-sayang TBJ", kami bangga bisa menjadi bagian dari setiap momen berhargamu!
                </p>
                
                <div class="row g-4 mt-3">
                    <div class="col-sm-6">
                        <div class="feature-item-compact">
                            <i class="bx bx-check-circle feature-icon-compact"></i>
                            Kualitas Terjamin
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item-compact">
                            <i class="bx bx-time-five feature-icon-compact"></i>
                            Koleksi Selalu Baru
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item-compact">
                            <i class="bx bx-wallet-alt feature-icon-compact"></i>
                            Harga Bersahabat
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item-compact">
                            <i class="bx bx-map feature-icon-compact"></i>
                            Mudah Diakses
                        </div>
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
