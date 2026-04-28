<?php ob_start(); ?>

<!-- Profile Header -->
<div class="d-flex align-items-center mb-4">
    <div class="avatar flex-shrink-0 me-3" style="width: 4rem; height: 4rem;">
        <span class="avatar-initial rounded-circle bg-label-primary fs-2 fw-bold">
            <?= strtoupper(substr($user->name, 0, 1)) ?>
        </span>
    </div>
    <div>
        <h4 class="fw-bold mb-1"><?= htmlspecialchars($user->name) ?></h4>
        <span class="badge bg-label-primary"><?= ucfirst($user->role) ?></span>
    </div>
</div>

<div class="row">
    <!-- Profile Info -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-semibold">
                    <i class="bx bx-user me-2 text-primary"></i>Informasi Profil
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger border-0">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error-circle fs-4 me-2"></i>
                            <ul class="mb-0">
                                <?php foreach ($errors as $err): ?>
                                    <li><?= $err ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>profile/update">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="name">
                            <i class="bx bx-user me-1 text-primary"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                            value="<?= htmlspecialchars($user->name) ?>" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="username">
                            <i class="bx bx-at me-1 text-primary"></i>Username
                        </label>
                        <input type="text" class="form-control form-control-lg" value="<?= htmlspecialchars($user->username) ?>" disabled />
                        <small class="text-muted">Username tidak dapat diubah</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="email">
                            <i class="bx bx-envelope me-1 text-primary"></i>Email
                        </label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                            value="<?= htmlspecialchars($user->email ?? '') ?>" placeholder="Email" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="phone">
                            <i class="bx bx-phone me-1 text-primary"></i>Telepon
                        </label>
                        <input type="text" class="form-control form-control-lg" id="phone" name="phone"
                            value="<?= htmlspecialchars($user->phone ?? '') ?>" placeholder="Nomor telepon" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="address">
                            <i class="bx bx-map me-1 text-primary"></i>Alamat
                        </label>
                        <textarea class="form-control" id="address" name="address" rows="3" 
                            placeholder="Alamat"><?= htmlspecialchars($user->address ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Password Change -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-semibold">
                    <i class="bx bx-lock-alt me-2 text-warning"></i>Ubah Password
                </h5>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($pwErrors)): ?>
                    <div class="alert alert-danger border-0">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error-circle fs-4 me-2"></i>
                            <ul class="mb-0">
                                <?php foreach ($pwErrors as $err): ?>
                                    <li><?= $err ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>profile/password">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="current_password">
                            <i class="bx bx-lock me-1 text-secondary"></i>Password Lama
                        </label>
                        <input type="password" class="form-control form-control-lg" id="current_password" name="current_password" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="new_password">
                            <i class="bx bx-key me-1 text-secondary"></i>Password Baru
                        </label>
                        <input type="password" class="form-control form-control-lg" id="new_password" name="new_password"
                            minlength="6" required />
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="confirm_password">
                            <i class="bx bx-check-shield me-1 text-secondary"></i>Konfirmasi Password Baru
                        </label>
                        <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" required />
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="bx bx-lock me-1"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Status Gaji Section - Hanya untuk karyawan -->
<?php if ($user->role === 'karyawan'): ?>
<div class="row">
    <!-- Status Gaji Card -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm mb-4">
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
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-semibold">
                    <i class="bx bx-history me-2 text-primary"></i>Riwayat Gaji
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 px-4">Periode</th>
                                <th class="py-3 text-end">Total Gaji</th>
                                <th class="py-3 text-center">Status</th>
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
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5">
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

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
