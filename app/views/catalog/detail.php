<?php ob_start(); 
// Clean up filename from title
$cleanTitle = preg_replace('/\.(jpg|jpeg|png|webp|gif)$/i', '', $product->name);
?>
<style>
    .detail-card {
        border-radius: 24px;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.04);
        background: #ffffff;
    }
    .back-btn-modern {
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 600;
        letter-spacing: 0.3px;
        color: #6c757d;
        border: 2px solid #e9ecef;
        background: white;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    .back-btn-modern:hover {
        background: #f8f9fa;
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .product-title-modern {
        font-weight: 800;
        font-size: 2.5rem;
        line-height: 1.2;
        color: #1a1d20;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }
    .product-price-modern {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-color);
    }
    .badge-modern {
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border: none;
    }
    .badge-category {
        background-color: var(--primary-color);
        color: white;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }
    .badge-stock {
        background-color: #198754;
        color: white;
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2);
    }
    .badge-outstock {
        background-color: #dc3545;
        color: white;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
    }
    .desc-section {
        padding-top: 24px;
        border-top: 1px solid #f0f0f0;
        margin-top: 8px;
    }
    .desc-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .desc-title i {
        font-size: 1.3rem;
        color: var(--primary-color);
    }
    .desc-text {
        line-height: 1.9;
        color: #495057;
        font-size: 0.95rem;
        white-space: pre-line;
    }
    .desc-empty {
        color: #adb5bd;
        font-style: italic;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .desc-empty i {
        font-size: 1.2rem;
    }
    .gallery-main {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        background: #f8f9fa;
    }
    .gallery-img {
        width: 100%;
        height: 480px;
        object-fit: cover;
    }
    .thumb-btn {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        border: 3px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
        background: #f8f9fa;
    }
    .thumb-btn.active {
        border-color: var(--primary-color);
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
    .thumb-btn img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .qty-control {
        display: flex;
        align-items: center;
        background: #f1f3f5;
        border-radius: 10px;
        padding: 5px;
        width: fit-content;
    }
    .qty-btn {
        width: 30px;
        height: 30px;
        border: none;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2b2b2b;
        font-weight: bold;
        transition: all 0.2s;
    }
    .qty-btn:hover {
        background: var(--primary-color);
        color: white;
    }
    .qty-input {
        width: 40px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 600;
    }
    .btn-add-modern {
        border-radius: 16px;
        padding: 14px 24px;
        font-size: 1.1rem;
        font-weight: 700;
        background: var(--primary-color);
        border: none;
        box-shadow: 0 8px 20px rgba(30, 144, 255, 0.3);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-add-modern:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 25px rgba(13, 110, 253, 0.4);
    }
    .btn-add-modern:active {
        transform: translateY(1px);
    }
    .trust-badges {
        background: white;
        border: 2px dashed #e9ecef;
        border-radius: 16px;
        padding: 20px;
    }
    .trust-item {
        text-align: center;
        flex: 1;
    }
    .trust-icon {
        width: 48px;
        height: 48px;
        background: rgba(30, 144, 255, 0.1);
        color: var(--primary-color);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 10px;
    }
    .trust-text {
        font-size: 0.85rem;
        font-weight: 700;
        color: #495057;
    }
    
    /* Hide number input arrows */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    input[type=number] {
        -moz-appearance: textfield; /* Firefox */
    }
</style>

<div class="container py-5" style="max-width: 1200px;">
    <div class="mb-4">
        <a href="<?= BASE_URL ?>catalog" class="back-btn-modern">
            <i class="bx bx-arrow-back me-2"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="detail-card p-4 p-md-5">
        <div class="row g-5">
            <!-- Left: Image Gallery -->
            <div class="col-lg-6">
                <?php if (!empty($productImages)): ?>
                    <div id="productGallery" class="carousel slide gallery-main mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($productImages as $index => $img): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= BASE_URL ?>assets/img/products/<?= htmlspecialchars($img->image) ?>" class="gallery-img d-block w-100" alt="Product Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if (count($productImages) > 1): ?>
                        <div class="d-flex gap-3 overflow-auto pb-2" style="scrollbar-width: thin;">
                            <?php foreach ($productImages as $index => $img): ?>
                                <button type="button" data-bs-target="#productGallery" data-bs-slide-to="<?= $index ?>" class="thumb-btn <?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>">
                                    <img src="<?= BASE_URL ?>assets/img/products/<?= htmlspecialchars($img->image) ?>" alt="Thumbnail">
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <script>
                            document.getElementById('productGallery').addEventListener('slide.bs.carousel', function (e) {
                                document.querySelectorAll('.thumb-btn').forEach(btn => btn.classList.remove('active'));
                                document.querySelector(`.thumb-btn[data-bs-slide-to="${e.to}"]`).classList.add('active');
                            });
                        </script>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="gallery-main d-flex align-items-center justify-content-center" style="height: 480px;">
                        <?php if (!empty($product->image)): ?>
                            <img src="<?= BASE_URL ?>assets/img/products/<?= htmlspecialchars($product->image) ?>" class="gallery-img d-block w-100" alt="Product Image">
                        <?php else: ?>
                            <i class="bx bx-image text-muted" style="font-size: 6rem; opacity: 0.3;"></i>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right: Product Info -->
            <div class="col-lg-6 d-flex flex-column">
                <div class="d-flex gap-2 mb-3 align-items-center">
                    <span class="badge-modern badge-category">
                        <i class="bx bx-category me-1"></i> <?= htmlspecialchars($product->category ?: 'Uncategorized') ?>
                    </span>
                    
                    <?php if ($product->stock > 0): ?>
                        <span class="badge-modern badge-stock">
                            <i class="bx bx-check-circle me-1"></i> Stok: <?= $product->stock ?>
                        </span>
                    <?php else: ?>
                        <span class="badge-modern badge-outstock">
                            <i class="bx bx-x-circle me-1"></i> Habis
                        </span>
                    <?php endif; ?>
                </div>
                
                <h1 class="product-title-modern"><?= htmlspecialchars($cleanTitle) ?></h1>
                
                <div class="product-price-modern mb-4">
                    Rp <?= number_format($product->price, 0, ',', '.') ?>
                </div>
                
                <div class="desc-section">
                    <div class="desc-title"><i class="bx bx-info-circle"></i> Deskripsi Produk</div>
                    <?php if (!empty($product->description)): ?>
                        <div class="desc-text"><?= htmlspecialchars($product->description) ?></div>
                    <?php else: ?>
                        <div class="desc-empty"><i class="bx bx-edit-alt"></i> Belum ada deskripsi untuk produk ini.</div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-auto">
                    <form id="addToCartForm" class="d-flex flex-column flex-sm-row gap-3">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <div class="qty-control" style="transform: scale(1.2); transform-origin: left center; margin-right: 15px;">
                            <button type="button" class="qty-btn" onclick="let inp = this.nextElementSibling; if(inp.value > 1) inp.value--;">-</button>
                            <input type="text" name="quantity" class="qty-input" value="1" readonly>
                            <button type="button" class="qty-btn" onclick="let inp = this.previousElementSibling; let max = <?= $product->stock ?>; if(inp.value < max) inp.value++;">+</button>
                        </div>
                        
                        <button type="button" id="addBtn" class="btn btn-primary btn-add-modern flex-grow-1" onclick="handleAddToCart(<?= $product->id ?>, this.form.quantity.value, this)" <?= $product->stock == 0 ? 'disabled' : '' ?>>
                            <i class="bx bx-cart-add fs-4 me-2 align-middle"></i> <span class="align-middle">Tambah ke Keranjang</span>
                        </button>
                    </form>
                </div>
                
                <!-- Trust Badges -->
                <div class="d-flex mt-4 trust-badges gap-3">
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bx bx-check-shield"></i></div>
                        <div class="trust-text">Garansi<br>Kualitas</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bx bx-medal"></i></div>
                        <div class="trust-text">Produk<br>Original</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bx bx-store"></i></div>
                        <div class="trust-text">Ambil di<br>Toko</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageScripts = "
<script>
    function runCartAnimationDetail(startElement) {
        const cartIcon = document.querySelector('.navbar-modern .bx-shopping-bag') || document.querySelector('.cart-fab i') || document.querySelector('a[href$=\'cart\']');
        if (!cartIcon) return;
        
        // Find the active image in gallery, or fallback to the start element
        let productImg = document.querySelector('.carousel-item.active img') || document.querySelector('.gallery-main img');
        
        const startRect = (productImg || startElement).getBoundingClientRect();
        const endRect = cartIcon.getBoundingClientRect();
        
        const animated = document.createElement('div');
        animated.style.position = 'fixed';
        animated.style.zIndex = '10000';
        animated.style.width = '100px';
        animated.style.height = '100px';
        animated.style.borderRadius = '20px';
        animated.style.overflow = 'hidden';
        animated.style.left = startRect.left + 'px';
        animated.style.top = startRect.top + 'px';
        animated.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        animated.style.boxShadow = '0 10px 30px rgba(0,0,0,0.2)';
        
        if (productImg && productImg.tagName === 'IMG' && productImg.src) {
            const img = document.createElement('img');
            img.src = productImg.src;
            img.style.width = '100%'; img.style.height = '100%'; img.style.objectFit = 'cover';
            animated.appendChild(img);
        } else {
            animated.style.background = 'var(--primary-color)'; 
        }
        
        document.body.appendChild(animated);
        
        setTimeout(() => {
            animated.style.left = endRect.left + 'px';
            animated.style.top = endRect.top + 'px';
            animated.style.width = '25px'; animated.style.height = '25px';
            animated.style.opacity = '0.4'; 
            animated.style.transform = 'scale(0.1) rotate(360deg)';
        }, 50);
        
        setTimeout(() => {
            animated.remove();
            const target = cartIcon.closest('a') || cartIcon;
            if(target && target.style) {
                target.style.transition = 'transform 0.3s ease';
                target.style.transform = 'scale(1.3)';
                setTimeout(() => target.style.transform = 'scale(1)', 400);
            }
        }, 850);
    }

    function handleAddToCart(productId, qty, btn) {
        qty = parseInt(qty);
        if (isNaN(qty) || qty < 1) qty = 1;
        
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class=\"bx bx-loader-alt bx-spin fs-4 me-2 align-middle\"></i> <span class=\"align-middle\">Memproses...</span>';
        btn.disabled = true;
        
        fetch('" . BASE_URL . "cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'product_id=' + productId + '&quantity=' + qty
        })
        .then(response => response.json())
        .then(data => {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            
            if(data.success) {
                // Update badge if possible
                const navBadge = document.getElementById('navCartCount');
                if (navBadge) { navBadge.textContent = data.cart_count; navBadge.style.display = 'flex'; }
                
                runCartAnimationDetail(btn);
                showGlobalToast('Berhasil ditambahkan ke keranjang!', 'success');
            } else {
                showGlobalToast(data.message || 'Gagal menambahkan ke keranjang', 'danger');
            }
        })
        .catch(err => {
            console.error(err);
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            showGlobalToast('Terjadi kesalahan saat menambah ke keranjang', 'danger');
        });
    }
</script>
";
include __DIR__ . '/../layouts/public_header.php';
?>
