<?php ob_start(); ?>

<style>
:root {
    --primary-color: #1E90FF;
    --secondary-color: #F39C12;
    --card-bg: #ffffff;
    --text-main: #233446;
    --text-muted: #8592a3;
}

.catalog-container {
    padding-top: 2rem;
}

/* Pills Filter */
.filter-pills {
    display: flex;
    overflow-x: auto;
    padding: 10px 5px;
    gap: 12px;
    margin-bottom: 35px;
    scrollbar-width: none;
}
.filter-pills::-webkit-scrollbar { display: none; }

.pill-item {
    white-space: nowrap;
    padding: 10px 24px;
    border-radius: 12px;
    background: #fff;
    color: var(--text-main);
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.pill-item:hover {
    background: #f8f9fa;
    color: var(--primary-color);
    transform: translateY(-2px);
}
.pill-item.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    box-shadow: 0 4px 12px rgba(30, 144, 255, 0.25);
}

/* Search Box */
.search-input-group {
    position: relative;
    max-width: 650px;
    margin: 0 auto 50px;
}
.search-input-group .form-control {
    padding: 16px 25px 16px 55px;
    border-radius: 18px;
    border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    font-size: 1rem;
    transition: all 0.3s ease;
}
.search-input-group .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 10px 30px rgba(30, 144, 255, 0.1);
}
.search-input-group i {
    position: absolute;
    left: 22px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 1.4rem;
}

/* Product Card */
.product-card-premium {
    background: var(--card-bg);
    border-radius: 24px;
    border: 1px solid rgba(0,0,0,0.04);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
}
.product-card-premium:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    border-color: rgba(30, 144, 255, 0.1);
}

.img-wrapper {
    position: relative;
    padding-top: 100%;
    background: #fcfcfd;
    overflow: hidden;
}
.product-img-main {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
}
.product-card-premium:hover .product-img-main {
    transform: scale(1.1);
}

/* Preview & Stock Badges */
.btn-preview-trigger {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-main);
    opacity: 0;
    transform: translateX(10px);
    transition: all 0.3s ease;
    cursor: pointer;
    z-index: 5;
    border: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.product-card-premium:hover .btn-preview-trigger {
    opacity: 1;
    transform: translateX(0);
}
.btn-preview-trigger:hover {
    background: var(--primary-color);
    color: #fff;
}

.stock-status {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    z-index: 5;
    letter-spacing: 0.5px;
}

/* Card Content */
.card-details {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.cat-tag {
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--secondary-color);
    text-transform: uppercase;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}
.prod-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 12px;
    line-height: 1.4;
    height: 3rem;
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
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--primary-color);
}

.btn-add-cart-main {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: #f1f3f5;
    color: var(--text-main);
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    transition: all 0.3s ease;
}
.btn-add-cart-main:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgba(30, 144, 255, 0.2);
}

/* Image Preview Modal */
#imagePreviewModal .modal-content {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(15px);
    border: none;
    border-radius: 30px;
    overflow: hidden;
}
#imagePreviewModal .modal-body {
    padding: 40px;
}
.preview-img-container {
    background: #fff;
    border-radius: 20px;
    padding: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    margin-bottom: 25px;
}

/* Animations */
@keyframes cart-bounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.3); }
}
.cart-bounce-anim {
    animation: cart-bounce 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cart-animation-element {
    position: fixed;
    z-index: 10000;
    pointer-events: none;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    overflow: hidden;
}
</style>

<div class="container catalog-container">
    <!-- Search Section -->
    <div class="search-container">
        <form action="<?= BASE_URL ?>catalog" method="GET">
            <div class="search-input-group">
                <i class="bx bx-search"></i>
                <input type="text" name="q" class="form-control" placeholder="Cari manik-manik idaman Anda..." value="<?= htmlspecialchars($search ?? '') ?>">
                <?php if ($selectedCategory): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($selectedCategory) ?>">
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Filter Section -->
    <div class="filter-pills">
        <a href="<?= BASE_URL ?>catalog<?= $search ? '?q='.urlencode($search) : '' ?>" class="pill-item <?= empty($selectedCategory) ? 'active' : '' ?>">Semua Koleksi</a>
        <?php foreach ($categories as $cat): ?>
            <a href="<?= BASE_URL ?>catalog?category=<?= urlencode($cat->category) ?><?= $search ? '&q='.urlencode($search) : '' ?>" 
               class="pill-item <?= $selectedCategory === $cat->category ? 'active' : '' ?>">
                <?= htmlspecialchars($cat->category) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Product Grid -->
    <?php if (!empty($products)): ?>
        <div class="row g-4 mb-5">
            <?php foreach ($products as $product): ?>
                <?php $isAvailable = $product->stock > 0; ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card-premium">
                        <div class="img-wrapper">
                            <!-- Stock Badge -->
                            <?php if (!$isAvailable): ?>
                                <span class="stock-status bg-danger text-white">Habis</span>
                            <?php endif; ?>

                            <!-- Preview Trigger -->
                            <?php if (!empty($product->image)): ?>
                                <button class="btn-preview-trigger" onclick="showImagePreview('<?= BASE_URL ?>assets/img/products/<?= $product->image ?>', '<?= htmlspecialchars(addslashes($product->name)) ?>', 'Rp <?= number_format($product->price, 0, ',', '.') ?>')">
                                    <i class="bx bx-expand"></i>
                                </button>
                            <?php endif; ?>

                            <!-- Image -->
                            <?php if (!empty($product->image)): ?>
                                <img src="<?= BASE_URL ?>assets/img/products/<?= $product->image ?>" alt="<?= htmlspecialchars($product->name) ?>" class="product-img-main" loading="lazy">
                            <?php else: ?>
                                <div class="product-img-main d-flex align-items-center justify-content-center bg-lighter">
                                    <i class="bx bx-image-alt text-muted fs-1"></i>
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
            <i class="bx bx-search-alt-2 text-muted mb-3" style="font-size: 5rem; opacity: 0.3;"></i>
            <h4 class="fw-700">Produk Tidak Ditemukan</h4>
            <p class="text-muted">Maaf, kami tidak dapat menemukan produk yang Anda cari.</p>
            <a href="<?= BASE_URL ?>catalog" class="btn btn-primary rounded-pill px-4 mt-2">Lihat Semua Koleksi</a>
        </div>
    <?php endif; ?>
</div>

<!-- Floating Cart -->
<?php if (!empty($_SESSION['cart'])): ?>
<a href="<?= BASE_URL ?>cart" class="cart-fab" id="floatingCart">
    <i class="bx bx-shopping-bag fs-4"></i>
    <span class="badge rounded-pill bg-danger" id="cartCountBadge"><?= count($_SESSION['cart']) ?></span>
</a>
<?php endif; ?>

<!-- Toast Feedback -->
<div id="toast-minimal" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px); background: #233446; color: white; padding: 14px 30px; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); z-index: 10000; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; align-items: center; gap: 12px; opacity: 0;">
    <i class="bx bx-check-circle text-success fs-4"></i>
    <span id="toast-msg">Berhasil!</span>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-4" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="preview-img-container">
                    <img id="previewImage" src="" alt="" class="img-fluid rounded-4" style="max-height:65vh;">
                </div>
                <h3 id="previewProductName" class="fw-800 mb-1"></h3>
                <p id="previewProductPrice" class="fs-4 fw-700 text-primary mb-0"></p>
            </div>
        </div>
    </div>
</div>

<style>
.cart-fab {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 64px;
    height: 64px;
    background: var(--primary-color);
    color: white;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 15px 30px rgba(30, 144, 255, 0.35);
    z-index: 1000;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.cart-fab:hover { transform: scale(1.1) translateY(-5px); color: white; }
.cart-fab .badge { position: absolute; top: -5px; right: -5px; border: 3px solid #fff; padding: 6px 10px; }
</style>

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
        animated.className = 'cart-animation-element';
        
        if (productImg && productImg.src) {
            const img = document.createElement('img');
            img.src = productImg.src;
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            animated.appendChild(img);
        } else {
            animated.style.background = 'var(--primary-color)';
        }

        animated.style.position = 'fixed';
        animated.style.width = '70px';
        animated.style.height = '70px';
        animated.style.left = (startRect.left) + 'px';
        animated.style.top = (startRect.top) + 'px';
        animated.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        
        document.body.appendChild(animated);

        setTimeout(() => {
            animated.style.left = (endRect.left) + 'px';
            animated.style.top = (endRect.top) + 'px';
            animated.style.width = '20px';
            animated.style.height = '20px';
            animated.style.opacity = '0.3';
            animated.style.transform = 'scale(0.1) rotate(360deg)';
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
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${id}&quantity=1`
            })
            .then(res => res.json())
            .then(data => {
                this.innerHTML = originalHtml;
                this.disabled = false;

                if (data.success) {
                    runCartAnimation(this);
                    showToast(data.message);
                    
                    const navBadge = document.getElementById('navCartCount');
                    if (navBadge) {
                        navBadge.textContent = data.cart_count;
                        navBadge.style.display = 'flex';
                    }
                    const floatingBadge = document.getElementById('cartCountBadge');
                    if (floatingBadge) {
                        floatingBadge.textContent = data.cart_count;
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                this.innerHTML = originalHtml;
                this.disabled = false;
                console.error(err);
            });
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
