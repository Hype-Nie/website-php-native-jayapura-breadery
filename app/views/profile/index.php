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
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bx bx-lock me-1"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
