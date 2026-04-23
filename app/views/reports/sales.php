<?php ob_start(); ?>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bx bx-filter-alt me-2"></i>Filter Laporan</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="<?= BASE_URL ?>reports/sales" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="from" value="<?= htmlspecialchars($from) ?>" />
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="to" value="<?= htmlspecialchars($to) ?>" />
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bx bx-search me-1"></i> Tampilkan
                </button>
                <a href="<?= BASE_URL ?>reports/exportSales?from=<?= $from ?>&to=<?= $to ?>" class="btn btn-success me-2">
                    <i class="bx bx-file me-1"></i> Export Excel
                </a>
                <a href="<?= BASE_URL ?>reports/printSales?from=<?= $from ?>&to=<?= $to ?>" class="btn btn-outline-secondary" target="_blank">
                    <i class="bx bx-printer me-1"></i> Cetak
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block">Total Penjualan</small>
                        <h4 class="mb-0 text-primary">Rp <?= number_format($totalSales, 0, ',', '.') ?></h4>
                    </div>
                    <div class="avatar bg-label-primary">
                        <span class="avatar-initial rounded"><i class="bx bx-trending-up"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block">Jumlah Transaksi</small>
                        <h4 class="mb-0"><?= count($sales) ?></h4>
                    </div>
                    <div class="avatar bg-label-info">
                        <span class="avatar-initial rounded"><i class="bx bx-receipt"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted d-block">Periode</small>
                        <h6 class="mb-0"><?= date('d/m/Y', strtotime($from)) ?> - <?= date('d/m/Y', strtotime($to)) ?></h6>
                    </div>
                    <div class="avatar bg-label-warning">
                        <span class="avatar-initial rounded"><i class="bx bx-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Sumber</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembalian</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sales)): ?>
                    <?php foreach ($sales as $i => $s): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <?php if ($s->source === 'order'): ?>
                                    <a href="<?= BASE_URL ?>orders/detail/<?= $s->id ?>">
                                        <code><?= htmlspecialchars($s->order_code) ?></code>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= BASE_URL ?>transactions/detail/<?= $s->id ?>">
                                        <code><?= htmlspecialchars($s->transaction_code) ?></code>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($s->created_at)) ?></td>
                            <td>
                                <?php if ($s->source === 'order'): ?>
                                    <span class="badge bg-label-warning">Pesanan</span>
                                <?php else: ?>
                                    <span class="badge bg-label-primary">POS</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-semibold">Rp <?= number_format($s->total_amount, 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($s->payment_amount, 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($s->change_amount, 0, ',', '.') ?></td>
                            <td>
                                <?php if ($s->source === 'order'): ?>
                                    <span class="text-muted"><?= htmlspecialchars($s->customer_name ?? '-') ?></span>
                                <?php else: ?>
                                    <span class="text-muted"><?= htmlspecialchars($s->cashier_name ?? '-') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Tidak ada transaksi pada periode ini</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($sales)): ?>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="4" class="text-end">Total</td>
                        <td class="text-primary">Rp <?= number_format($totalSales, 0, ',', '.') ?></td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
