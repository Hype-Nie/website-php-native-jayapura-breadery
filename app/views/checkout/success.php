<?php ob_start(); ?>

<style>
.success-page {
    padding-top: 3rem;
    padding-bottom: 5rem;
}

.success-card {
    border: none;
    border-radius: 30px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.05);
    background: white;
    padding: 40px;
    text-align: center;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: rgba(113, 221, 55, 0.1);
    color: #71dd37;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto 20px;
}

.order-code-display {
    background: #f0f2ff;
    border: 2px dashed #1E90FF;
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 30px;
}

.code-label {
    display: block;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #1E90FF;
    font-weight: 700;
    margin-bottom: 5px;
}

.code-value {
    font-size: 2.5rem;
    font-weight: 900;
    color: #2b2b2b;
    font-family: 'Monaco', 'Consolas', monospace;
}

.info-box-success {
    background: #fff;
    border: 1px solid #f1f3f5;
    border-radius: 20px;
    padding: 25px;
    text-align: left;
    margin-bottom: 30px;
}

.info-header-success {
    font-weight: 800;
    font-size: 1.1rem;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #f1f3f5;
    color: #2b2b2b;
}

.item-row-success {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.item-qty-name {
    display: flex;
    gap: 10px;
}

.total-row-success {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid #f8f9fa;
    display: flex;
    justify-content: space-between;
    font-weight: 800;
    font-size: 1.25rem;
    color: #1E90FF;
}

.instruction-alert {
    background: #233446;
    color: white;
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 30px;
}

@media print {
    @page {
        margin: 0.5cm;
    }
    body {
        background: white !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .navbar, footer, .btn-no-print, .success-icon {
        display: none !important;
    }
    .success-page {
        padding-top: 0 !important;
    }
    .success-card {
        box-shadow: none !important;
        padding: 0 !important;
        border: none !important;
    }
    .order-code-display {
        background: #f0f2ff !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        padding: 10px !important;
        margin-bottom: 20px !important;
    }
    .instruction-alert {
        display: none !important;
    }
    .info-box-success {
        margin-bottom: 0 !important;
        border: 1px solid #eee !important;
    }
}
</style>

<div class="container success-page">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="success-card">
                <div class="success-icon">
                    <i class="bx bx-check-circle"></i>
                </div>
                
                <h2 class="fw-800 mb-2">Pesanan Diterima!</h2>
                <p class="text-muted mb-4">Silakan datang ke toko untuk melakukan pembayaran.</p>

                <div class="order-code-display">
                    <span class="code-label">Kode Pesanan Anda</span>
                    <span class="code-value"><?= htmlspecialchars($order->order_code) ?></span>
                </div>

                <div class="instruction-alert">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bx bx-store fs-1"></i>
                        <div class="text-start">
                            <h6 class="text-white mb-1">Tunjukkan ke Kasir</h6>
                            <p class="small mb-0 text-white-50">Kasir akan memproses pembayaran Anda berdasarkan kode di atas.</p>
                        </div>
                    </div>
                </div>

                <div class="info-box-success">
                    <div class="info-header-success">Ringkasan Pesanan</div>
                    <div class="mb-3">
                        <div class="small text-muted mb-1">Nama Pemesan:</div>
                        <div class="fw-bold fs-5 text-dark"><?= htmlspecialchars($order->customer_name) ?></div>
                    </div>
                    
                    <div class="small text-muted mb-2">Item yang dibeli:</div>
                    <?php foreach ($order->items as $item): ?>
                        <div class="item-row-success">
                            <div class="item-qty-name">
                                <span class="fw-bold text-primary"><?= $item->quantity ?>x</span>
                                <span><?= htmlspecialchars($item->product_name) ?></span>
                            </div>
                            <span class="text-muted small">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></span>
                        </div>
                    <?php endforeach; ?>

                    <div class="total-row-success">
                        <span>Total Bayar</span>
                        <span>Rp <?= number_format($order->total_amount, 0, ',', '.') ?></span>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <button onclick="window.print()" class="btn btn-outline-primary btn-lg rounded-pill fw-bold btn-no-print">
                        <i class="bx bx-printer me-2"></i> Cetak / Simpan PDF
                    </button>
                    <a href="<?= BASE_URL ?>catalog" class="btn btn-label-secondary btn-lg rounded-pill fw-bold btn-no-print">
                        Kembali Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../app/views/layouts/public_header.php';
?>
