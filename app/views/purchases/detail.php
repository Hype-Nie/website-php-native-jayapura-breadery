<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-none d-print-block mb-3">
                        <img src="<?= BASE_URL ?>assets/img/logo/logo.png" alt="Logo" style="height: 60px; margin-bottom: 5px;">
                        <h4 class="mb-0"><?= APP_NAME ?></h4>
                    </div>
                    <h5 class="mb-0"><?= $title ?></h5>
                </div>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-2" onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak Nota
                    </button>
                    <a href="<?= BASE_URL ?>purchases" class="btn btn-outline-secondary btn-sm">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Barcode</th>
                            <th>Harga Beli</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchase->items as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= htmlspecialchars($item->product_name) ?></strong></td>
                                <td><code><?= htmlspecialchars($item->barcode) ?></code></td>
                                <td>Rp <?= number_format($item->price, 0, ',', '.') ?></td>
                                <td><?= $item->quantity ?></td>
                                <td class="fw-semibold">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end fw-bold">Total</td>
                            <td class="fw-bold text-success">Rp <?= number_format($purchase->total_amount, 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-success">
                <h5 class="mb-0 text-white"><i class="bx bx-info-circle me-2"></i>Info Pembelian</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">Kode Pembelian</small>
                    <strong><?= htmlspecialchars($purchase->purchase_code) ?></strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Tanggal</small>
                    <strong><?= date('d/m/Y H:i', strtotime($purchase->purchase_date ?? $purchase->created_at)) ?></strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block">Supplier</small>
                    <strong><?= htmlspecialchars($purchase->supplier_name ?? '-') ?></strong>
                </div>
                <?php if (!empty($purchase->notes)): ?>
                    <div class="mb-3">
                        <small class="text-muted d-block">Catatan</small>
                        <span><?= htmlspecialchars($purchase->notes) ?></span>
                    </div>
                <?php endif; ?>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="h6 mb-0">Total</span>
                    <span class="h4 mb-0 text-success fw-bold">Rp <?= number_format($purchase->total_amount, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageStyles = '
<style>
@media print {
    .layout-navbar, .layout-menu, .layout-footer,
    .card-header .btn, .content-footer, .btn, .navbar, footer { display: none !important; }
    .col-lg-8, .col-lg-4 { width: 100% !important; max-width: 100% !important; flex: 0 0 100% !important; margin-bottom: 20px !important; }
    .content-wrapper { padding: 0 !important; }
    .card { border: 1px solid #ddd !important; box-shadow: none !important; margin-bottom: 20px !important; }
    .table { font-size: 12px; }
    body { background-color: #fff !important; }
}
</style>';
include '../app/views/layouts/header.php';
?>