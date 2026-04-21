<?php ob_start(); ?>

<style>
:root {
    --primary-color: #1E90FF;
    --secondary-color: #F39C12;
    --card-bg: #ffffff;
    --text-main: #233446;
    --text-muted: #8592a3;
    --body-bg: #fcfcfd;
}

.catalog-container {
    padding-top: 2.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    position: relative;
}

/* Breadcrumb - Pastikan di atas dan tidak tertutup */
.breadcrumb-wrapper {
    background: #ffffff !important;
    padding: 14px 20px !important;
    border-radius: 12px !important;
    margin-bottom: 25px !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06) !important;
    position: relative;
    z-index: 100;
}
.breadcrumb-custom {
    display: flex !important;
    align-items: center;
    gap: 8px;
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 0.9rem;
    color: #1e293b !important;
}
.breadcrumb-custom li {
    display: inline !important;
    list-style: none !important;
}
.breadcrumb-custom a {
    color: #1E90FF !important;
    text-decoration: none !important;
    font-weight: 700 !important;
    font-size: 0.9rem !important;
    background: none !important;
}
.breadcrumb-custom a:hover {
    text-decoration: underline !important;
}
.breadcrumb-custom .separator {
    color: #94a3b8 !important;
    font-size: 1.1rem !important;
    font-weight: 300 !important;
    display: inline !important;
    margin: 0 4px;
    line-height: 1;
}
.breadcrumb-custom .active {
    color: #334155 !important;
    font-weight: 800 !important;
    background: none !important;
}

/* Pills Filter - Dibuat lebih ramping */
.filter-pills {
    display: flex;
    overflow-x: auto;
    padding: 2px 2px 15px;
    gap: 10px;
    margin-bottom: 20px;
    scrollbar-width: none;
}
.filter-pills::-webkit-scrollbar { display: none; }

.pill-item {
    white-space: nowrap;
    padding: 8px 18px;
    border-radius: 10px;
    background: #fff;
    color: var(--text-main);
    font-weight: 700;
    transition: all 0.2s ease;
    text-decoration: none;
    border: 1px solid rgba(0,0,0,0.05);
    font-size: 0.85rem;
}
.pill-item.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Product Card - Optimasi Ruang Mobile */
.product-card-premium {
    background: var(--card-bg);
    border-radius: 18px;
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}

.img-wrapper {
    position: relative;
    padding-top: 100%; /* Tetap 1:1 */
    background: #f8f9fa;
}
.product-img-main {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    object-fit: cover;
}

.btn-preview-trigger {
    position: absolute;
    top: 8px; right: 8px;
    width: 32px; height: 32px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(8px);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-main);
    z-index: 5; border: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.stock-status {
    position: absolute;
    top: 8px; left: 8px;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.55rem;
    font-weight: 800;
    text-transform: uppercase;
    z-index: 5;
}

.card-details {
    padding: 10px 12px 14px; /* Padding lebih kecil agar teks tidak terlalu turun */
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.cat-tag {
    font-size: 0.6rem;
    font-weight: 800;
    color: var(--secondary-color);
    text-transform: uppercase;
    margin-bottom: 4px;
}
.prod-name {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 8px;
    line-height: 1.2;
    height: 2.2rem; /* Lebih pendek sedikit */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.price-row {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.prod-price {
    font-size: 1rem;
    font-weight: 800;
    color: var(--primary-color);
}

.btn-add-cart-main {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f0f4f8;
    color: var(--primary-color);
    display: flex; align-items: center; justify-content: center;
    border: none;
    font-size: 1.2rem;
}

/* Tampilan Desktop Overrides */
@media (min-width: 768px) {
    .catalog-container { padding-top: 2rem; }
    .card-details { padding: 18px 20px 22px; }
    .prod-name { font-size: 1.1rem; height: 3rem; }
    .prod-price { font-size: 1.25rem; }
    .btn-add-cart-main { width: 46px; height: 46px; border-radius: 14px; }
    .btn-preview-trigger { width: 40px; height: 40px; border-radius: 12px; top: 12px; right: 12px; opacity: 0; transform: translateX(10px); }
    .product-card-premium:hover .btn-preview-trigger { opacity: 1; transform: translateX(0); }
    .product-card-premium:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
}

@keyframes cart-bounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.3); }
}
.cart-bounce-anim { animation: cart-bounce 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
</style>

<div class="container catalog-container">
    <!-- Breadcrumb Box -->
    <div class="breadcrumb-wrapper">
        <ul class="breadcrumb-custom">
            <li><a href="<?= BASE_URL ?>">Beranda</a></li>
            <li class="separator">&rsaquo;</li>
            <?php if ($selectedCategory): ?>
                <li><a href="<?= BASE_URL ?>catalog">Katalog</a></li>
                <li class="separator">&rsaquo;</li>
                <li class="active"><?= htmlspecialchars($selectedCategory) ?></li>
            <?php else: ?>
                <li class="active">Semua Koleksi</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Search Section -->
    <div class="mb-4">
        <form action="<?= BASE_URL ?>catalog" method="GET">
            <div class="search-input-group" style="position: relative;">
                <i class="bx bx-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1.2rem;"></i>
                <input type="text" name="q" class="form-control" style="padding: 14px 20px 14px 50px; border-radius: 15px; border: 1px solid rgba(0,0,0,0.08); font-size: 0.95rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03);" placeholder="Cari manik-manik..." value="<?= htmlspecialchars($search ?? '') ?>">
                <?php if ($selectedCategory): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($selectedCategory) ?>">
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Filter Section -->
    <div class="filter-pills">
        <a href="<?= BASE_URL ?>catalog<?= $search ? '?q='.urlencode($search) : '' ?>" class="pill-item <?= empty($selectedCategory) ? 'active' : '' ?>">Semua</a>
        <?php foreach ($categories as $cat): ?>
            <a href="<?= BASE_URL ?>catalog?category=<?= urlencode($cat->category) ?><?= $search ? '&q='.urlencode($search) : '' ?>" 
               class="pill-item <?= $selectedCategory === $cat->category ? 'active' : '' ?>">
                <?= htmlspecialchars($cat->category) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Product Grid -->
    <?php if (!empty($products)): ?>
        <div class="row g-3 g-md-4 mb-5">
            <?php foreach ($products as $product): ?>
                <?php $isAvailable = $product->stock > 0; ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card-premium">
                        <div class="img-wrapper">
                            <?php if (!$isAvailable): ?>
                                <span class="stock-status bg-danger text-white">Habis</span>
                            <?php endif; ?>

                            <?php if (!empty($product->image)): ?>
                                <button class="btn-preview-trigger" onclick="showImagePreview('<?= BASE_URL ?>assets/img/products/<?= $product->image ?>', '<?= htmlspecialchars(addslashes($product->name)) ?>', 'Rp <?= number_format($product->price, 0, ',', '.') ?>')">
                                    <i class="bx bx-expand"></i>
                                </button>
                                <img src="<?= BASE_URL ?>assets/img/products/<?= $product->image ?>" alt="<?= htmlspecialchars($product->name) ?>" class="product-img-main" loading="lazy">
                            <?php else: ?>
                                <div class="product-img-main d-flex align-items-center justify-content-center bg-lighter">
                                    <i class="bx bx-image-alt text-muted fs-2"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-details">
                            <span class="cat-tag"><?= htmlspecialchars($product->category) ?></span>
                            <h3 class="prod-name"><?= htmlspecialchars($product->name) ?></h3>
                            
                            <div class="price-row">
                                <div class="prod-price">Rp <?= number_format($product->price, 0, ',', '.') ?></div>
                                <?php if ($isAvailable): ?>
                                    <button class="btn-add-cart-main btn-add-to-cart" data-id="<?= $product->id ?>">
                                        <i class="bx bx-plus"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-catalog text-center py-5">
            <i class="bx bx-search-alt-2 text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
            <h4 class="fw-700">Produk Tidak Ditemukan</h4>
            <a href="<?= BASE_URL ?>catalog" class="btn btn-primary rounded-pill px-4 mt-2">Reset</a>
        </div>
    <?php endif; ?>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="previewImage" src="" alt="" class="img-fluid rounded-4 mb-3" style="max-height:60vh;">
                <h4 id="previewProductName" class="fw-800 mb-1"></h4>
                <p id="previewProductPrice" class="fs-5 fw-700 text-primary mb-0"></p>
            </div>
        </div>
    </div>
</div>

<!-- Toast Feedback -->
<div id="toast-minimal" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px); background: #233446; color: white; padding: 12px 25px; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); z-index: 10000; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; align-items: center; gap: 10px; opacity: 0; font-size: 0.85rem; width: max-content; max-width: 85vw;">
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
        const productCard = startElement.closest('.product-card-premium');
        const productImg = productCard ? productCard.querySelector('.product-img-main') : null;
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
        if (productImg && productImg.src) {
            const img = document.createElement('img');
            img.src = productImg.src;
            img.style.width = '100%'; img.style.height = '100%'; img.style.objectFit = 'cover';
            animated.appendChild(img);
        } else { animated.style.background = 'var(--primary-color)'; }
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
            target.classList.add('cart-bounce-anim');
            setTimeout(() => target.classList.remove('cart-bounce-anim'), 400);
        }, 850);
    }

    document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
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
                    const floatingBadge = document.getElementById('cartCountBadge');
                    if (floatingBadge) { floatingBadge.textContent = data.cart_count; }
                } else { alert(data.message); }
            })
            .catch(() => { this.innerHTML = originalHtml; this.disabled = false; });
        });
    });

    window.showImagePreview = function(src, name, price) {
        document.getElementById('previewImage').src = src;
        document.getElementById('previewProductName').textContent = name;
        document.getElementById('previewProductPrice').textContent = price;
        new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
    };
});
</script>

<?php
$content = ob_get_clean();
include '../app/views/layouts/public_header.php';
?>
