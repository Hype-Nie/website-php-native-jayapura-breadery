<?php ob_start(); ?>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h5 class="mb-0">Daftar Gaji</h5>
        <div class="d-flex align-items-center gap-2">
            <form class="d-flex align-items-center gap-2" method="GET" action="<?= BASE_URL ?>payrolls" id="filterForm">
                <input type="hidden" name="show_all" id="showAllInput" value="<?= $showAll ? '1' : '0' ?>">
                <select name="month" class="form-select form-select-sm" style="width: 120px;" <?= $showAll ? 'disabled' : '' ?>>
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?= $m ?>" <?= $month == $m ? 'selected' : '' ?>>
                            <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <select name="year" class="form-select form-select-sm" style="width: 90px;" <?= $showAll ? 'disabled' : '' ?>>
                    <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                        <option value="<?= $y ?>" <?= $year == $y ? 'selected' : '' ?>>
                            <?= $y ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-sm btn-outline-primary" title="Filter" <?= $showAll ? 'disabled' : '' ?>><i class="bx bx-filter-alt"></i></button>
                
                <?php if ($showAll): ?>
                    <a href="<?= BASE_URL ?>payrolls" class="btn btn-sm btn-outline-secondary">
                        <i class="bx bx-calendar"></i> Periode
                    </a>
                <?php else: ?>
                    <button type="button" class="btn btn-sm btn-outline-info" onclick="showAllPeriods()">
                        <i class="bx bx-list-ul"></i> Semua
                    </button>
                <?php endif; ?>
            </form>
            <a href="<?= BASE_URL ?>payrolls/create" class="btn btn-sm btn-primary">
                <i class="bx bx-plus"></i> Tambah
            </a>
        </div>
    </div>

    <script>
    function showAllPeriods() {
        document.getElementById('showAllInput').value = '1';
        document.getElementById('filterForm').submit();
    }
    </script>

    <div class="card-body pb-0">
        <?php 
            $paidCount = count(array_filter($payrolls, fn($p) => $p->status === 'paid'));
            $draftCount = count(array_filter($payrolls, fn($p) => $p->status === 'draft'));
        ?>
        <div class="d-flex gap-3 flex-wrap mb-3">
            <?php if ($showAll): ?>
                <span class="badge bg-label-dark"><i class="bx bx-list-ul me-1"></i> Menampilkan: Semua Periode</span>
            <?php else: ?>
                <span class="badge bg-label-secondary"><i class="bx bx-calendar me-1"></i> Periode: <?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></span>
            <?php endif; ?>
            <span class="badge bg-label-info"><i class="bx bx-wallet me-1"></i> Total Dibayar: Rp <?= number_format($totalPaid, 0, ',', '.') ?></span>
            <span class="badge bg-label-primary"><i class="bx bx-file me-1"></i> Total Slip: <?= count($payrolls) ?></span>
            <span class="badge bg-label-success"><i class="bx bx-check me-1"></i> Dibayar: <?= $paidCount ?></span>
            <span class="badge bg-label-warning"><i class="bx bx-time me-1"></i> Draft: <?= $draftCount ?></span>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Karyawan</th>
                    <th>Periode</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Bonus</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($payrolls)): ?>
                    <?php foreach ($payrolls as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <strong><?= htmlspecialchars($p->employee_name) ?></strong>
                            </td>
                            <td>
                                <span class="badge bg-label-secondary">
                                    <?= date('F Y', mktime(0, 0, 0, $p->period_month, 1, $p->period_year)) ?>
                                </span>
                            </td>
                            <td>Rp <?= number_format($p->base_salary, 0, ',', '.') ?></td>
                            <td class="text-success">+Rp <?= number_format($p->allowance, 0, ',', '.') ?></td>
                            <td class="text-danger">-Rp <?= number_format($p->deduction, 0, ',', '.') ?></td>
                            <td class="text-info">+Rp <?= number_format($p->bonus, 0, ',', '.') ?></td>
                            <td>
                                <strong class="text-primary">Rp <?= number_format($p->total_salary, 0, ',', '.') ?></strong>
                            </td>
                            <td>
                                <?php if ($p->status === 'paid'): ?>
                                    <span class="badge bg-label-success"><i class="bx bx-check-circle me-1"></i>Dibayar</span>
                                <?php else: ?>
                                    <span class="badge bg-label-warning"><i class="bx bx-time me-1"></i>Draft</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($p->status === 'draft'): ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-icon btn-success" 
                                            onclick="openPayModal(<?= $p->id ?>, '<?= htmlspecialchars($p->employee_name, ENT_QUOTES) ?>')" title="Bayar & Upload">
                                            <i class="bx bx-upload"></i>
                                        </button>
                                        <a href="<?= BASE_URL ?>payrolls/edit/<?= $p->id ?>" class="btn btn-sm btn-icon btn-primary" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form method="POST" action="<?= BASE_URL ?>payrolls/delete/<?= $p->id ?>" class="d-inline">
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger rounded-end" 
                                                onclick="return confirm('Yakin hapus slip gaji ini?')" title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <div class="btn-group">
                                        <a href="<?= BASE_URL ?>payrolls/print/<?= $p->id ?>" target="_blank" class="btn btn-sm btn-icon btn-primary" title="Cetak">
                                            <i class="bx bx-printer"></i>
                                        </a>
                                        <?php if (!empty($p->transfer_proof)): ?>
                                            <a href="<?= BASE_URL ?>assets/img/payrolls/<?= htmlspecialchars($p->transfer_proof) ?>" target="_blank" class="btn btn-sm btn-icon btn-info" title="Bukti TF">
                                                <i class="bx bx-image"></i>
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-icon btn-secondary" disabled title="Tidak ada bukti TF">
                                                <i class="bx bx-image"></i>
                                            </button>
                                        <?php endif; ?>
                                        <form method="POST" action="<?= BASE_URL ?>payrolls/undoPay/<?= $p->id ?>" class="d-inline">
                                            <button type="submit" class="btn btn-sm btn-icon btn-warning rounded-end" 
                                                onclick="return confirm('Batalkan status pembayaran?')" title="Batal Bayar">
                                                <i class="bx bx-undo"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            <i class="bx bx-inbox bx-lg mb-2"></i>
                            <p class="m-0">Tidak ada data gaji</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (!$showAll && !empty($unpaidEmployees)): ?>
<div class="card mb-4 border-warning" style="border: 1px solid #ffab00;">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
            <h5 class="m-0 me-2 text-warning"><i class="bx bx-user-x me-2"></i>Karyawan Belum Digaji - <?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></h5>
        </div>
        <span class="badge bg-label-warning"><?= count($unpaidEmployees) ?> Karyawan</span>
    </div>
    <div class="card-body mt-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Karyawan</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($unpaidEmployees as $i => $emp): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <strong><?= htmlspecialchars($emp->name) ?></strong>
                            </td>
                            <td><code><?= htmlspecialchars($emp->username) ?></code></td>
                            <td>
                                <a href="<?= BASE_URL ?>payrolls/create?employee_id=<?= $emp->id ?>&period_month=<?= $month ?>&period_year=<?= $year ?>" 
                                   class="btn btn-sm btn-primary">
                                    <i class="bx bx-plus"></i> Buat Slip
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Pay Modal -->
<div class="modal fade" id="payModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" enctype="multipart/form-data" id="payFormModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bx bx-upload me-2 text-primary"></i>Bayar Gaji
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong>Slip Gaji:</strong> <span id="modalPayrollInfo" class="fw-bold"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bukti Transfer <span class="text-danger">*</span></label>
                        <input type="file" name="transfer_proof" id="transferProofInput" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        <div class="form-text">Format: JPG, PNG, PDF. Maks 5MB.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Konfirmasi Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openPayModal(id, employeeName) {
    document.getElementById('modalPayrollInfo').textContent = employeeName;
    document.getElementById('payFormModal').action = '<?= BASE_URL ?>payrolls/pay/' + id;
    var modalElement = document.getElementById('payModal');
    var modal = new bootstrap.Modal(modalElement);
    modal.show();
}
</script>

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>