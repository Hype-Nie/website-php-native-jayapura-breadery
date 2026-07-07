<?php

/**
 * @var int $todaySales
 * @var int $todayTransactions
 * @var int $monthlyTotal
 * @var int $pendingOrders
 * @var array|null $payrollSummary
 * @var array|null $payrollHistory
 * @var object|null $currentMonthPayroll
 * @var int $currentMonth
 * @var int $currentYear
 * @var array $lowStockProducts
 * @var array $recentTransactions
 * @var array $recentOrders
 * @var array $dailySales
 */
ob_start();
?>

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

<!-- Status Gaji Section - Hanya untuk karyawan -->
<?php if (isset($payrollHistory)): ?>
    <div class="row">
        <!-- Status Gaji Card -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bx bx-money-withdraw me-2 text-primary"></i>Status Gaji Saya
                    </h5>
                    <span class="badge bg-label-primary"><?= date('F Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)) ?></span>
                </div>
                <div class="card-body p-4">
                    <?php if ($currentMonthPayroll): ?>
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar flex-shrink-0 me-3" style="width: 3rem; height: 3rem;">
                                <span class="avatar-initial rounded <?= $currentMonthPayroll->status === 'paid' ? 'bg-label-success' : 'bg-label-warning' ?>">
                                    <i class="bx bx-<?= $currentMonthPayroll->status === 'paid' ? 'check' : 'time' ?>" style="font-size: 1.5rem;"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold">
                                    <?= $currentMonthPayroll->status === 'paid' ? 'Sudah Dibayar' : 'Menunggu Pembayaran' ?>
                                </h4>
                                <?php if ($currentMonthPayroll->status === 'paid' && $currentMonthPayroll->payment_date): ?>
                                    <small class="text-success">
                                        <i class="bx bx-calendar-check me-1"></i>
                                        Dibayar pada <?= date('d F Y', strtotime($currentMonthPayroll->payment_date)) ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted">Gaji Pokok</td>
                                    <td class="text-end fw-semibold">Rp <?= number_format($currentMonthPayroll->base_salary, 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tunjangan</td>
                                    <td class="text-end fw-semibold text-success">+ Rp <?= number_format($currentMonthPayroll->allowance, 0, ',', '.') ?></td>
                                </tr>
                                <?php if ($currentMonthPayroll->bonus > 0): ?>
                                    <tr>
                                        <td class="text-muted">Bonus</td>
                                        <td class="text-end fw-semibold text-success">+ Rp <?= number_format($currentMonthPayroll->bonus, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($currentMonthPayroll->deduction > 0): ?>
                                    <tr>
                                        <td class="text-muted">Potongan</td>
                                        <td class="text-end fw-semibold text-danger">- Rp <?= number_format($currentMonthPayroll->deduction, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr class="border-top">
                                    <td class="fw-bold fs-5">Total Gaji</td>
                                    <td class="text-end fw-bold fs-5 text-primary">Rp <?= number_format($currentMonthPayroll->total_salary, 0, ',', '.') ?></td>
                                </tr>
                            </table>
                        </div>

                        <?php if ($currentMonthPayroll->status === 'paid' && !empty($currentMonthPayroll->transfer_proof)): ?>
                            <a href="<?= BASE_URL ?>assets/img/payrolls/<?= htmlspecialchars($currentMonthPayroll->transfer_proof) ?>"
                                class="btn btn-outline-info w-100" target="_blank">
                                <i class="bx bx-image me-1"></i> Lihat Bukti Transfer
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="avatar avatar-xl mx-auto mb-3" style="background: #f3f4f6;">
                                <i class="bx bx-info-circle text-muted" style="font-size: 2rem;"></i>
                            </div>
                            <h6 class="text-muted mb-1">Belum ada data gaji</h6>
                            <small class="text-muted">Belum ada data gaji untuk bulan ini. Hubungi admin untuk pembuatan slip gaji.</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Riwayat Gaji -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bx bx-history me-2 text-primary"></i>Riwayat Gaji
                    </h5>
                    <?php if (isset($hasMorePayrolls) && $hasMorePayrolls && empty($showAllPayrolls)): ?>
                        <a href="<?= BASE_URL ?>dashboard?show_all_payrolls=1" class="btn btn-sm btn-outline-primary">
                            Tampilkan Semua
                        </a>
                    <?php elseif (!empty($showAllPayrolls)): ?>
                        <a href="<?= BASE_URL ?>dashboard" class="btn btn-sm btn-outline-secondary">
                            Lebih Sedikit
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-body p-0 flex-grow-1" style="min-height: 0; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light position-sticky top-0" style="z-index: 1;">
                                <tr>
                                    <th class="py-3 px-4">Periode</th>
                                    <th class="py-3 text-end">Total Gaji</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="py-3 px-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($payrollHistory)): ?>
                                    <?php foreach ($payrollHistory as $ph): ?>
                                        <tr>
                                            <td class="px-4">
                                                <span class="fw-semibold"><?= date('F Y', mktime(0, 0, 0, $ph->period_month, 1, $ph->period_year)) ?></span>
                                            </td>
                                            <td class="text-end fw-semibold">Rp <?= number_format($ph->total_salary, 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <?php if ($ph->status === 'paid'): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3">
                                                        <i class="bx bx-check me-1"></i>Dibayar
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3">
                                                        <i class="bx bx-time me-1"></i>Draft
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 text-center">
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#payrollDetailModal" onclick='fillPayrollModal(<?= json_encode($ph) ?>)'>
                                                    <i class="bx bx-show me-1"></i>Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="py-4">
                                                <div class="avatar avatar-lg mx-auto mb-3" style="background: #f3f4f6;">
                                                    <i class="bx bx-inbox text-muted" style="font-size: 2rem;"></i>
                                                </div>
                                                <p class="text-muted mb-0">Belum ada riwayat gaji</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
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

<!-- Modal Detail Slip Gaji -->
<div class="modal fade" id="payrollDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header" style="background-color: #1e90ff;">
                <h5 class="modal-title" style="color: #ffffff;">
                    <i class="bx bx-receipt me-2"></i>Detail Slip Gaji
                </h5>
                <button type="button" class="btn-close" style="filter: invert(1) grayscale(100%) brightness(200%);" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #ffffff;">
                <div class="text-center mb-4">
                    <h6 style="color: #6c757d;">Periode</h6>
                    <h4 class="fw-bold" style="color: #1e90ff;" id="modalPeriod">-</h4>
                    <span id="modalStatus" class="badge mt-2">-</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td style="color: #212529;">Gaji Pokok</td>
                            <td class="text-end fw-semibold" style="color: #212529;" id="modalBaseSalary">-</td>
                        </tr>
                        <tr>
                            <td style="color: #212529;">Tunjangan</td>
                            <td class="text-end fw-semibold" style="color: #198754;" id="modalAllowance">-</td>
                        </tr>
                        <tr id="modalBonusRow">
                            <td style="color: #212529;">Bonus</td>
                            <td class="text-end fw-semibold" style="color: #198754;" id="modalBonus">-</td>
                        </tr>
                        <tr id="modalDeductionRow">
                            <td style="color: #212529;">Potongan</td>
                            <td class="text-end fw-semibold" style="color: #dc3545;" id="modalDeduction">-</td>
                        </tr>
                        <tr class="border-top">
                            <td class="fw-bold fs-5" style="color: #212529;">Total Gaji</td>
                            <td class="text-end fw-bold fs-5" style="color: #1e90ff;" id="modalTotal">-</td>
                        </tr>
                    </table>
                </div>

                <div id="modalPaymentInfo" class="alert mt-3" style="display: none; background-color: #d1e7dd; border: none;">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-calendar-check fs-4 me-2" style="color: #0f5132;"></i>
                        <div>
                            <small style="color: #0f5132;">Dibayar pada</small>
                            <strong style="color: #0f5132;" id="modalPaymentDate">-</strong>
                        </div>
                    </div>
                </div>

                <div id="modalNotesSection" class="mt-3 p-3 rounded" style="display: none; background-color: #f8f9fa;">
                    <h6 style="color: #212529; margin-bottom: 8px;">Catatan</h6>
                    <p class="mb-0" style="color: #212529;" id="modalNotes">-</p>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn" style="background-color: #6c757d; color: #ffffff;" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function fillPayrollModal(data) {
        // Format currency
        const formatCurrency = (num) => 'Rp ' + new Intl.NumberFormat('id-ID').format(num);

        // Format date
        const formatDate = (dateStr) => {
            if (!dateStr) return '-';
            const date = new Date(dateStr);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };

        // Fill data
        document.getElementById('modalPeriod').textContent =
            new Date(data.period_year, data.period_month - 1).toLocaleDateString('id-ID', {
                month: 'long',
                year: 'numeric'
            });

        const statusBadge = document.getElementById('modalStatus');
        if (data.status === 'paid') {
            statusBadge.className = 'badge bg-success mt-2';
            statusBadge.innerHTML = '<i class="bx bx-check me-1"></i>Dibayar';
        } else {
            statusBadge.className = 'badge bg-warning text-dark mt-2';
            statusBadge.innerHTML = '<i class="bx bx-time me-1"></i>Draft';
        }

        document.getElementById('modalBaseSalary').textContent = formatCurrency(data.base_salary);
        document.getElementById('modalAllowance').textContent = '+' + formatCurrency(data.allowance);
        document.getElementById('modalTotal').textContent = formatCurrency(data.total_salary);

        // Handle bonus
        const bonusRow = document.getElementById('modalBonusRow');
        if (data.bonus > 0) {
            bonusRow.style.display = 'table-row';
            document.getElementById('modalBonus').textContent = '+' + formatCurrency(data.bonus);
        } else {
            bonusRow.style.display = 'none';
        }

        // Handle deduction
        const deductionRow = document.getElementById('modalDeductionRow');
        if (data.deduction > 0) {
            deductionRow.style.display = 'table-row';
            document.getElementById('modalDeduction').textContent = '-' + formatCurrency(data.deduction);
        } else {
            deductionRow.style.display = 'none';
        }

        // Handle payment info
        const paymentInfo = document.getElementById('modalPaymentInfo');
        if (data.status === 'paid' && data.payment_date) {
            paymentInfo.style.display = 'block';
            document.getElementById('modalPaymentDate').textContent = formatDate(data.payment_date);
        } else {
            paymentInfo.style.display = 'none';
        }

        // Handle notes
        const notesSection = document.getElementById('modalNotesSection');
        if (data.notes && data.notes.trim()) {
            notesSection.style.display = 'block';
            document.getElementById('modalNotes').textContent = data.notes;
        } else {
            notesSection.style.display = 'none';
        }
    }
</script>

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