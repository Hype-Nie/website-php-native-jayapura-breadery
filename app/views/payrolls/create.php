<?php ob_start(); ?>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
        <div class="avatar flex-shrink-0 me-3" style="width: 3rem; height: 3rem;">
            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-plus" style="font-size: 1.5rem;"></i></span>
        </div>
        <div>
            <h4 class="fw-bold mb-0">Tambah Slip Gaji</h4>
            <small class="text-muted">Buat slip gaji baru untuk karyawan</small>
        </div>
    </div>
    <a href="<?= BASE_URL ?>payrolls" class="btn btn-outline-secondary">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger border-0 shadow-sm">
        <div class="d-flex align-items-center">
            <i class="bx bx-error-circle fs-4 me-2"></i>
            <div>
                <strong>Terjadi Kesalahan:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-semibold">
                    <i class="bx bx-user-pin me-2 text-primary"></i>Informasi Karyawan & Periode
                </h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= BASE_URL ?>payrolls/create" id="payrollForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-user me-1 text-primary"></i>Karyawan <span class="text-danger">*</span>
                            </label>
                            <select name="employee_id" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Karyawan --</option>
                                <?php foreach ($employees as $emp): ?>
                                    <option value="<?= $emp->id ?>" <?= ($old['employee_id'] ?? '') == $emp->id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($emp->name) ?> (<?= htmlspecialchars($emp->username) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-calendar me-1 text-primary"></i>Bulan <span class="text-danger">*</span>
                            </label>
                            <select name="period_month" class="form-select form-select-lg" required>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?= $m ?>" <?= ($old['period_month'] ?? date('n')) == $m ? 'selected' : '' ?>>
                                        <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-calendar-alt me-1 text-primary"></i>Tahun <span class="text-danger">*</span>
                            </label>
                            <select name="period_year" class="form-select form-select-lg" required>
                                <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                                    <option value="<?= $y ?>" <?= ($old['period_year'] ?? date('Y')) == $y ? 'selected' : '' ?>>
                                        <?= $y ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-semibold mb-4">
                        <i class="bx bx-calculator me-2 text-primary"></i>Rincian Gaji
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-wallet me-1 text-success"></i>Gaji Pokok <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="base_salary" class="form-control salary-input" 
                                    value="<?= $old['base_salary'] ?? '' ?>" min="0" required 
                                    placeholder="Masukkan gaji pokok">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-gift me-1 text-info"></i>Tunjangan
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="allowance" class="form-control salary-input" 
                                    value="<?= $old['allowance'] ?? '0' ?>" min="0" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-minus-circle me-1 text-danger"></i>Potongan
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="deduction" class="form-control salary-input" 
                                    value="<?= $old['deduction'] ?? '0' ?>" min="0" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-plus-circle me-1 text-warning"></i>Bonus
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="bonus" class="form-control salary-input" 
                                    value="<?= $old['bonus'] ?? '0' ?>" min="0" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- Total Preview Card -->
                    <div class="card mt-4 border-0 shadow-sm bg-label-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-primary fw-semibold">Estimasi Total Gaji</p>
                                    <h3 class="mb-0 fw-bold text-primary" id="totalAmount">Rp 0</h3>
                                </div>
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-primary"><i class="bx bx-calculator text-white" style="font-size: 1.5rem;"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label fw-semibold">
                            <i class="bx bx-note me-1 text-secondary"></i>Catatan
                        </label>
                        <textarea name="notes" class="form-control" rows="3" 
                            placeholder="Tambahkan catatan jika diperlukan..."><?= htmlspecialchars($old['notes'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bx bx-save me-1"></i> Simpan Slip Gaji
                        </button>
                        <a href="<?= BASE_URL ?>payrolls" class="btn btn-outline-secondary btn-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light py-3">
                <h6 class="mb-0 fw-semibold">
                    <i class="bx bx-info-circle me-2 text-primary"></i>Informasi
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success me-2 mt-1"></i>
                        <span>Slip gaji akan dibuat dengan status <strong>Draft</strong></span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success me-2 mt-1"></i>
                        <span>Admin dapat mengubah status menjadi <strong>Dibayar</strong> setelah transfer</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bx bx-check-circle text-success me-2 mt-1"></i>
                        <span>Upload bukti transfer wajib saat pembayaran</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bx bx-check-circle text-success me-2 mt-1"></i>
                        <span>Format file: JPG, PNG, PDF (maks 5MB)</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function calculateTotal() {
    var base = parseInt(document.querySelector('[name="base_salary"]').value) || 0;
    var allowance = parseInt(document.querySelector('[name="allowance"]').value) || 0;
    var deduction = parseInt(document.querySelector('[name="deduction"]').value) || 0;
    var bonus = parseInt(document.querySelector('[name="bonus"]').value) || 0;
    var total = base + allowance + bonus - deduction;
    document.getElementById('totalAmount').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}

document.querySelectorAll('.salary-input').forEach(function(el) {
    el.addEventListener('input', calculateTotal);
});

calculateTotal();
</script>

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
