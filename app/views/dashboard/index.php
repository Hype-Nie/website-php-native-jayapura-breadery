<?php ob_start(); ?>

<!-- Stats cards row -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-cart"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Penjualan Hari Ini</span>
                <h3 class="card-title mb-2">Rp <?= number_format($todaySales, 0, ',', '.') ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-receipt"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transaksi Hari Ini</span>
                <h3 class="card-title mb-2"><?= $todayTransactions ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-wallet"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Penjualan Bulan Ini</span>
                <h3 class="card-title mb-2">Rp <?= number_format($monthlyTotal, 0, ',', '.') ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-time"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Pesanan Pending</span>
                <h3 class="card-title mb-2"><?= $pendingOrders ?? 0 ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Payroll Summary (Admin Only) -->
<?php if (isset($payrollSummary)): ?>
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Penggajian Bulan Ini</h5>
                    <small class="text-muted"><?= date('F Y', mktime(0, 0, 0, $payrollSummary['month'], 1, $payrollSummary['year'])) ?></small>
                </div>
                <a href="<?= BASE_URL ?>payrolls" class="btn btn-sm btn-outline-primary">
                    <i class="bx bx-money-withdraw me-1"></i> Kelola Gaji
                </a>
            </div>
            <div class="card-body mt-3">
                <div class="row text-center">
                    <div class="col-md-3 border-end">
                        <h3 class="mb-1 fw-bold text-primary"><?= $payrollSummary['totalEmployees'] ?></h3>
                        <p class="mb-0 text-muted">Total Karyawan</p>
                    </div>
                    <div class="col-md-3 border-end">
                        <h3 class="mb-1 fw-bold text-success"><?= $payrollSummary['paidCount'] ?></h3>
                        <p class="mb-0 text-muted">Sudah Dibayar</p>
                    </div>
                    <div class="col-md-3 border-end">
                        <h3 class="mb-1 fw-bold text-warning"><?= $payrollSummary['draftCount'] + $payrollSummary['unpaidCount'] ?></h3>
                        <p class="mb-0 text-muted">Belum Dibayar</p>
                    </div>
                    <div class="col-md-3">
                        <h3 class="mb-1 fw-bold text-info">Rp <?= number_format($payrollSummary['totalPaid'], 0, ',', '.') ?></h3>
                        <p class="mb-0 text-muted">Total Dibayar</p>
                    </div>
                </div>

                <?php if (!empty($payrollSummary['unpaidList'])): ?>
                    <hr class="my-3">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <small class="text-muted">
                            <i class="bx bx-info-circle me-1"></i>Karyawan belum digaji:
                        </small>
                        <?php foreach ($payrollSummary['unpaidList'] as $emp): ?>
                            <span class="badge bg-label-danger"><?= htmlspecialchars($emp->name) ?></span>
                        <?php endforeach; ?>
                        <?php if ($payrollSummary['unpaidCount'] > 3): ?>
                            <span class="badge bg-label-secondary">+<?= $payrollSummary['unpaidCount'] - 3 ?> lainnya</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <!-- Sales Chart -->
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Penjualan 7 Hari Terakhir</h5>
                </div>
            </div>
            <div class="card-body px-2">
                <div id="salesChart"></div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="col-lg-4 mb-4 order-1">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Stok Menipis</h5>
                    <small class="text-muted">&le; 10 item tersisa</small>
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($lowStockProducts)): ?>
                    <ul class="p-0 m-0">
                        <?php foreach (array_slice($lowStockProducts, 0, 6) as $product): ?>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-<?= $product->stock <= 3 ? 'danger' : 'warning' ?>">
                                        <i class="bx bx-package"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><?= htmlspecialchars($product->name) ?></h6>
                                        <small class="text-muted"><?= $product->barcode ?></small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold text-<?= $product->stock <= 3 ? 'danger' : 'warning' ?>">
                                            <?= $product->stock ?> pcs
                                        </small>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="text-center text-muted py-4">
                        <i class="bx bx-check-circle bx-lg text-success"></i>
                        <p class="mt-2 mb-0">Semua stok aman</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-0">2 Penjualan Kasir Terakhir</h5>
                    <small class="text-muted">Transaksi langsung di toko</small>
                </div>
                <a href="<?= BASE_URL ?>transactions" class="btn btn-sm btn-outline-primary">Semua</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (!empty($recentTransactions)): ?>
                            <?php foreach (array_slice($recentTransactions, 0, 2) as $trx): ?>
                                <tr>
                                    <td>
                                        <a href="<?= BASE_URL ?>transactions/detail/<?= $trx->id ?>">
                                            <strong><?= $trx->transaction_code ?></strong>
                                        </a>
                                    </td>
                                    <td>Rp <?= number_format($trx->total_amount, 0, ',', '.') ?></td>
                                    <td><span class="badge bg-label-success">Selesai</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Belum ada transaksi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-0">2 Pesanan Website Terakhir</h5>
                    <small class="text-muted">Pesanan dari pelanggan (Landing Page)</small>
                </div>
                <a href="<?= BASE_URL ?>orders" class="btn btn-sm btn-outline-warning">Semua</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (!empty($recentOrders)): ?>
                            <?php foreach (array_slice($recentOrders, 0, 2) as $ord): ?>
                                <tr>
                                    <td>
                                        <a href="<?= BASE_URL ?>orders/detail/<?= $ord->id ?>">
                                            <strong><?= $ord->order_code ?></strong>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($ord->customer_name) ?></td>
                                    <td>Rp <?= number_format($ord->total_amount, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Belum ada pesanan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

// Chart data — fill missing days so chart is continuous
$salesByDate = [];
foreach ($dailySales as $row) {
    $salesByDate[$row->date] = (int)$row->total;
}
$chartLabels = [];
$chartData   = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-{$i} days"));
    $chartLabels[] = date('d M', strtotime($date));
    $chartData[]   = $salesByDate[$date] ?? 0;
}

$pageStyles = '<link rel="stylesheet" href="' . BASE_URL . 'assets/vendor/libs/apex-charts/apex-charts.css" />';

$pageScripts = '
<script src="' . BASE_URL . 'assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var options = {
        series: [{ name: "Penjualan", data: ' . json_encode($chartData) . ' }],
        chart: { height: 300, type: "area", toolbar: { show: false },
            dropShadow: { enabled: true, top: 10, left: 0, blur: 3, opacity: 0.1 }
        },
        dataLabels: { enabled: false },
        stroke: { width: 3, curve: "smooth" },
        colors: ["#1E90FF"],
        fill: {
            type: "gradient",
            gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1 }
        },
        xaxis: { categories: ' . json_encode($chartLabels) . ' },
        yaxis: {
            labels: {
                formatter: function(v) {
                    return "Rp " + new Intl.NumberFormat("id-ID").format(v);
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(v) {
                    return "Rp " + new Intl.NumberFormat("id-ID").format(v);
                }
            }
        }
    };
    new ApexCharts(document.querySelector("#salesChart"), options).render();
});
</script>';

include '../app/views/layouts/header.php';
?>  