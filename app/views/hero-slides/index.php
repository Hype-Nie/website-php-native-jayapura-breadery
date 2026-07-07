<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Pengaturan /</span> Hero Slides</h4>
    <a href="<?= BASE_URL ?>heroslides/add" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Tambah Slide
    </a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible" role="alert">
        <?= $_SESSION['flash']['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>URL Tombol</th>
                    <th>Status</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (empty($slides)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada slide.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($slides as $s): ?>
                        <tr>
                            <td>
                                <img src="<?= BASE_URL ?>assets/img/hero-slides/<?= htmlspecialchars($s->image) ?>" alt="Slide" width="100" class="rounded" style="object-fit: cover; height: 60px;">
                            </td>
                            <td>
                                <small class="text-muted"><?= htmlspecialchars($s->cta_url ?: '-') ?></small>
                            </td>
                            <td>
                                <?php if ($s->is_active): ?>
                                    <span class="badge bg-label-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-label-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $s->sort_order ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>heroslides/edit/<?= $s->id ?>" class="btn btn-sm btn-info">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <form action="<?= BASE_URL ?>heroslides/delete/<?= $s->id ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus slide ini?')">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
