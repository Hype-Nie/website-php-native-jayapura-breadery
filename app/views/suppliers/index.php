<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h5 class="mb-0"><?= $title ?></h5>
        <div class="d-flex gap-2">
            <form class="d-flex" method="GET" action="<?= BASE_URL ?>suppliers">
                <div class="input-group input-group-sm" style="width:240px">
                    <input type="text" class="form-control" name="q" placeholder="Cari supplier..."
                        value="<?= htmlspecialchars($search ?? '') ?>" />
                    <button class="btn btn-outline-primary" type="submit"><i class="bx bx-search"></i></button>
                    <?php if (!empty($search)): ?>
                        <a href="<?= BASE_URL ?>suppliers" class="btn btn-outline-secondary"><i class="bx bx-x"></i></a>
                    <?php endif; ?>
                </div>
            </form>
            <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                <a href="<?= BASE_URL ?>suppliers/add" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus me-1"></i> Tambah
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Supplier</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Total Pembelian</th>
                    <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($suppliers)): ?>
                    <?php foreach ($suppliers as $i => $sup): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><strong><?= htmlspecialchars($sup->name) ?></strong></td>
                            <td><?= htmlspecialchars($sup->phone ?: '-') ?></td>
                            <td><?= htmlspecialchars($sup->email ?: '-') ?></td>
                            <td>
                                <span class="badge bg-label-info"><?= $sup->purchase_count ?? 0 ?> transaksi</span>
                                <?php if (($sup->total_amount ?? 0) > 0): ?>
                                    <br><small class="text-muted">Rp <?= number_format($sup->total_amount, 0, ',', '.') ?></small>
                                <?php endif; ?>
                            </td>
                            <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?= BASE_URL ?>suppliers/edit/<?= $sup->id ?>" class="btn btn-sm btn-icon btn-outline-primary" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form method="POST" action="<?= BASE_URL ?>suppliers/delete/<?= $sup->id ?>" class="d-inline">
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus"
                                                onclick="showCustomConfirm('Yakin ingin menghapus supplier ini?', () => this.closest('form').submit())">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bx bx-truck bx-lg"></i>
                            <p class="mt-2 mb-0">
                                <?= !empty($search) ? 'Tidak ditemukan supplier dengan kata kunci tersebut' : 'Belum ada supplier' ?>
                            </p>
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