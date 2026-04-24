<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h5 class="mb-0"><?= $title ?></h5>
        <form class="d-flex" method="GET" action="<?= BASE_URL ?>orders">
            <div class="input-group input-group-sm" style="width:250px">
                <input type="text" class="form-control" name="q" placeholder="Cari pesanan..."
                    value="<?= htmlspecialchars($search ?? '') ?>" />
                <button class="btn btn-outline-primary" type="submit"><i class="bx bx-search"></i></button>
                <?php if (!empty($search)): ?>
                    <a href="<?= BASE_URL ?>orders" class="btn btn-outline-secondary"><i class="bx bx-x"></i></a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card-body pb-0">
        <div class="d-flex gap-2 flex-wrap">
            <a href="<?= BASE_URL ?>orders" class="btn btn-sm <?= empty($status) ? 'btn-primary' : 'btn-outline-secondary' ?>">
                Semua
            </a>
            <a href="<?= BASE_URL ?>orders?status=pending" class="btn btn-sm <?= $status === 'pending' ? 'btn-primary' : 'btn-outline-secondary' ?>">
                <i class="bx bx-time me-1"></i> Pending <?= $pendingCount ? '(' . $pendingCount . ')' : '' ?>
            </a>
            <a href="<?= BASE_URL ?>orders?status=paid" class="btn btn-sm <?= $status === 'paid' ? 'btn-primary' : 'btn-outline-secondary' ?>">
                <i class="bx bx-check-circle me-1"></i> Lunas <?= $paidCount ? '(' . $paidCount . ')' : '' ?>
            </a>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Pesanan</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="width:1%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $i => $order): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><code><?= htmlspecialchars($order->order_code) ?></code></td>
                            <td><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></td>
                            <td>
                                <strong><?= htmlspecialchars($order->customer_name) ?></strong>
                                <div class="small text-muted"><?= htmlspecialchars($order->customer_phone) ?></div>
                            </td>
                            <td class="fw-semibold">Rp <?= number_format($order->total_amount, 0, ',', '.') ?></td>
                            <td>
                                <?php if ($order->status === 'pending'): ?>
                                    <span class="badge bg-label-warning">Pending</span>
                                <?php elseif ($order->status === 'paid'): ?>
                                    <span class="badge bg-label-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge bg-label-danger">Batal</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-nowrap">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="<?= BASE_URL ?>orders/detail/<?= $order->id ?>">
                                            <i class="bx bx-show me-1"></i> Detail
                                        </a>
                                        <?php if ($order->status === 'pending'): ?>
                                            <form method="POST" action="<?= BASE_URL ?>orders/markPaid" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $order->id ?>">
                                                <button type="submit" class="dropdown-item text-success"
                                                    onclick="return confirm('Proses pembayaran dan kurangi stok?')">
                                                    <i class="bx bx-check me-1"></i> Tandai Lunas
                                                </button>
                                            </form>
                                            <form method="POST" action="<?= BASE_URL ?>orders/cancel" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $order->id ?>">
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Batalkan pesanan ini?')">
                                                    <i class="bx bx-x me-1"></i> Batalkan
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bx bx-receipt bx-lg"></i>
                            <p class="mt-2 mb-0">Tidak ada pesanan</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
