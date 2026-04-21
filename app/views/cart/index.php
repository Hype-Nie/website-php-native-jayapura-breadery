<?php ob_start(); ?>

<style>
.cart-page {
    padding-top: 2rem;
    padding-bottom: 5rem;
}

.cart-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    color: #2b2b2b;
}

.cart-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.03);
    overflow: hidden;
}

.cart-item {
    padding: 20px;
    border-bottom: 1px solid #f1f3f5;
    transition: background 0.3s ease;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item:hover {
    background: #fcfcfd;
}

.item-img {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    background: #f8f9fa;
}

.item-info h5 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #2b2b2b;
}

.item-info .barcode {
    font-size: 0.8rem;
    color: #8e94a9;
    font-family: monospace;
}

.item-price {
    font-weight: 600;
    color: #1E90FF;
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
    background: #1E90FF;
    color: white;
}

.qty-input {
    width: 40px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 600;
}

.summary-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    background: white;
    padding: 25px;
    position: sticky;
    top: 2rem;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px dashed #dee2e6;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.summary-total {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #f1f3f5;
    font-size: 1.3rem;
    font-weight: 800;
    color: #1E90FF;
}

.btn-checkout {
    width: 100%;
    padding: 15px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1.1rem;
    margin-top: 20px;
    box-shadow: 0 8px 20px rgba(105, 108, 255, 0.3);
}

.empty-cart {
    text-align: center;
    padding: 100px 20px;
}

.empty-cart i {
    font-size: 5rem;
    color: #e9ecef;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
        gap: 15px;
    }
    .item-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
}
</style>

<div class="container cart-page">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h1 class="cart-title mb-0">Keranjang Saya</h1>
        <a href="<?= BASE_URL ?>catalog" class="text-primary fw-600 text-decoration-none">
            <i class="bx bx-left-arrow-alt"></i> Kembali Belanja
        </a>
    </div>

    <?php if (!empty($cartItems)): ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card cart-card">
                    <div class="card-body p-0">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="cart-item d-flex align-items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded" style="width: 80px; height: 80px; overflow: hidden;">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= BASE_URL ?>assets/img/products/<?= $item['image'] ?>" class="item-img">
                                        <?php else: ?>
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class='bx bx-package text-muted fs-1'></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1 item-info">
                                    <span class="barcode"><?= htmlspecialchars($item['barcode']) ?></span>
                                    <h5><?= htmlspecialchars($item['product_name']) ?></h5>
                                    <div class="item-price">Rp <?= number_format($item['price'], 0, ',', '.') ?></div>
                                </div>
                                <div class="item-controls d-flex flex-column align-items-end gap-2">
                                    <div class="qty-control">
                                        <button class="qty-btn update-qty" data-id="<?= $item['product_id'] ?>" data-action="decrease">-</button>
                                        <input type="text" class="qty-input" value="<?= $item['quantity'] ?>" readonly>
                                        <button class="qty-btn update-qty" data-id="<?= $item['product_id'] ?>" data-action="increase">+</button>
                                    </div>
                                    <button class="btn btn-link text-danger p-0 small remove-item" data-id="<?= $item['product_id'] ?>">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="<?= BASE_URL ?>cart/clear" class="btn btn-label-danger" onclick="return confirm('Kosongkan keranjang?')">
                        <i class="bx bx-trash-alt me-1"></i> Kosongkan Keranjang
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="summary-title">Ringkasan Belanja</h5>
                    <div class="summary-row">
                        <span class="text-muted">Total Produk</span>
                        <span class="fw-bold"><?= count($cartItems) ?> Item</span>
                    </div>
                    <div class="summary-row">
                        <span class="text-muted">Total Jumlah</span>
                        <span class="fw-bold"><?= array_sum(array_column($cartItems, 'quantity')) ?> Pcs</span>
                    </div>
                    
                    <div class="summary-total">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Harga</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                    </div>
                    
                    <a href="<?= BASE_URL ?>checkout" class="btn btn-primary btn-checkout">
                        Lanjut ke Checkout <i class="bx bx-right-arrow-alt ms-1"></i>
                    </a>
                    
                    <div class="mt-4 text-center">
                        <p class="small text-muted mb-0">
                            <i class="bx bx-shield-quarter text-success"></i> Pembayaran aman & terpercaya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card cart-card">
            <div class="empty-cart">
                <i class="bx bx-shopping-bag"></i>
                <h3>Keranjang Anda Kosong</h3>
                <p class="text-muted mb-4">Sepertinya Anda belum menambahkan produk apapun ke keranjang.</p>
                <a href="<?= BASE_URL ?>catalog" class="btn btn-primary btn-lg rounded-pill px-5">
                    Mulai Belanja Sekarang
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update Quantity
    document.querySelectorAll('.update-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const action = this.dataset.action;
            const input = this.parentElement.querySelector('.qty-input');
            let qty = parseInt(input.value);
            
            if (action === 'increase') qty++;
            else qty--;
            
            if (qty < 1) return;
            
            fetch('<?= BASE_URL ?>cart/update', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${id}&quantity=${qty}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) location.reload();
                else alert(data.message);
            });
        });
    });

    // Remove Item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Hapus item ini?')) return;
            
            const id = this.dataset.id;
            fetch('<?= BASE_URL ?>cart/remove', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${id}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) location.reload();
            });
        });
    });
});
</script>

<?php
$content = ob_get_clean();
include '../app/views/layouts/public_header.php';
?>
