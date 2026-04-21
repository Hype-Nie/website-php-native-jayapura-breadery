<?php ob_start(); ?>

<style>
.checkout-page {
    padding-top: 2rem;
    padding-bottom: 5rem;
}

.checkout-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 2rem;
    color: #2b2b2b;
}

.checkout-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.03);
    background: white;
    padding: 30px;
    height: 100%;
}

.section-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 25px;
    color: #2b2b2b;
}

.section-label i {
    color: #1E90FF;
    background: rgba(105, 108, 255, 0.1);
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
}

.form-control {
    padding: 12px 15px;
    border-radius: 12px;
    border: 1px solid #dee2e6;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #1E90FF;
    box-shadow: 0 0 0 4px rgba(105, 108, 255, 0.1);
}

.order-summary-mini {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
}

.summary-item-mini {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 0.95rem;
}

.summary-total-mini {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px dashed #dee2e6;
    font-weight: 800;
    font-size: 1.2rem;
    color: #1E90FF;
}

.btn-place-order {
    width: 100%;
    padding: 18px;
    border-radius: 15px;
    font-weight: 800;
    font-size: 1.1rem;
    box-shadow: 0 10px 25px rgba(105, 108, 255, 0.3);
    margin-top: 10px;
}

.info-alert {
    background: rgba(105, 108, 255, 0.1);
    border: none;
    border-radius: 12px;
    color: #1E90FF;
    padding: 15px;
    display: flex;
    gap: 12px;
    margin-bottom: 25px;
}

.info-alert i {
    font-size: 1.5rem;
}

.product-list-mini {
    max-height: 350px;
    overflow-y: auto;
    margin-bottom: 20px;
    padding-right: 10px;
}

.product-list-mini::-webkit-scrollbar {
    width: 5px;
}

.product-list-mini::-webkit-scrollbar-thumb {
    background: #e9ecef;
    border-radius: 10px;
}

.mini-product-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.mini-product-img {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    object-fit: cover;
    background: #eee;
}

.mini-product-info h6 {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 700;
}

.mini-product-info span {
    font-size: 0.8rem;
    color: #8e94a9;
}
</style>

<div class="container checkout-page">
    <h1 class="checkout-title">Selesaikan Pesanan</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible mb-4" role="alert">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>checkout/process">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="checkout-card">
                    <div class="section-label">
                        <i class="bx bx-user"></i>
                        Data Pemesan
                    </div>

                    <div class="info-alert">
                        <i class="bx bx-store-alt"></i>
                        <div>
                            <strong>Ambil di Toko</strong><br>
                            Pesanan ini untuk diambil langsung di toko. Silakan isi nama Anda untuk mempermudah kasir mencari pesanan Anda.
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" 
                                   placeholder="Masukkan nama sesuai KTP / Identitas"
                                   value="<?= htmlspecialchars($old['name'] ?? '') ?>" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="phone" 
                                   placeholder="Contoh: 0812xxxxxxxx"
                                   value="<?= htmlspecialchars($old['phone'] ?? '') ?>" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" name="notes" rows="3" 
                                      placeholder="Tambahkan instruksi khusus jika ada..."><?= htmlspecialchars($old['notes'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top">
                        <a href="<?= BASE_URL ?>cart" class="btn btn-label-secondary">
                            <i class="bx bx-left-arrow-alt me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="checkout-card">
                    <div class="section-label">
                        <i class="bx bx-receipt"></i>
                        Rincian Pesanan
                    </div>

                    <div class="product-list-mini">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="mini-product-item">
                                <div class="flex-shrink-0 bg-light rounded" style="width: 50px; height: 50px; overflow: hidden;">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="<?= BASE_URL ?>assets/img/products/<?= $item['image'] ?>" class="w-100 h-100 object-fit-cover">
                                    <?php else: ?>
                                        <i class="bx bx-package text-muted d-flex align-items-center justify-content-center h-100 fs-4"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 mini-product-info">
                                    <h6><?= htmlspecialchars($item['product_name']) ?></h6>
                                    <span><?= $item['quantity'] ?> x Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                                </div>
                                <div class="text-end fw-bold">
                                    Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="order-summary-mini">
                        <div class="summary-total-mini">
                            <span>Total Bayar di Kasir</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-place-order">
                        Pesan & Bayar di Kasir <i class="bx bx-chevron-right ms-1"></i>
                    </button>
                    
                    <div class="mt-4 p-3 bg-lighter rounded-3">
                        <p class="small text-muted mb-0">
                            <i class="bx bx-info-circle me-1"></i> 
                            Setelah menekan tombol di atas, Anda akan mendapatkan kode pesanan. Tunjukkan kode tersebut ke kasir kami untuk melakukan pembayaran dan pengambilan barang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
include '../app/views/layouts/public_header.php';
?>
