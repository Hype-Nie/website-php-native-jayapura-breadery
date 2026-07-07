<?php ob_start(); ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h5 class="mb-0"><?= $title ?></h5>
        <div class="d-flex gap-2">
            <form class="d-flex" method="GET" action="<?= BASE_URL ?>products">
                <div class="input-group input-group-sm" style="width:250px">
                    <input type="text" class="form-control" name="q" placeholder="Cari produk..."
                        value="<?= htmlspecialchars($search ?? '') ?>" />
                    <button class="btn btn-outline-primary" type="submit"><i class="bx bx-search"></i></button>
                    <?php if (!empty($search)): ?>
                        <a href="<?= BASE_URL ?>products" class="btn btn-outline-secondary"><i class="bx bx-x"></i></a>
                    <?php endif; ?>
                </div>
            </form>
            <a href="<?= BASE_URL ?>products/add" class="btn btn-primary btn-sm">
                <i class="bx bx-plus me-1"></i> Tambah Produk
            </a>
        </div>
    </div>
    <style>
        .table-responsive { min-height: 200px; }
    </style>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width:72px" class="text-center">Gambar</th>
                    <th>Barcode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $i => $product): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="text-center">
                                <?php
                                $imgPath = !empty($product->image) ? BASE_URL . 'assets/img/products/' . $product->image : null;
                                if ($imgPath): ?>
                                    <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($product->name) ?>"
                                        class="rounded" style="height:40px;width:40px;object-fit:cover;" />
                                <?php else: ?>
                                    <i class="bx bx-image-alt text-muted" style="font-size:1.4rem"></i>
                                <?php endif; ?>
                            </td>
                            <td><code><?= htmlspecialchars($product->barcode) ?></code></td>
                            <td><strong><?= htmlspecialchars($product->name) ?></strong></td>
                            <td>
                                <?php if ($product->category): ?>
                                    <span class="badge bg-label-primary me-1"><?= htmlspecialchars($product->category) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>Rp <?= number_format($product->price, 0, ',', '.') ?></td>
                            <td>
                                <?php if ($product->stock <= 0): ?>
                                    <span class="badge bg-label-danger">Habis</span>
                                <?php elseif ($product->stock <= 10): ?>
                                    <span class="badge bg-label-warning"><?= $product->stock ?></span>
                                <?php else: ?>
                                    <span class="badge bg-label-success"><?= $product->stock ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?= BASE_URL ?>products/edit/<?= $product->id ?>" class="btn btn-sm btn-icon btn-outline-primary" title="Edit">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form method="POST" action="<?= BASE_URL ?>products/delete/<?= $product->id ?>" class="d-inline">
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus"
                                            onclick="showCustomConfirm('Yakin ingin menghapus produk ini?', () => this.closest('form').submit())">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bx bx-package bx-lg"></i>
                            <p class="mt-2 mb-0">
                                <?= !empty($search) ? 'Tidak ditemukan produk dengan kata kunci tersebut' : 'Belum ada produk. <a href="' . BASE_URL . 'products/add">Tambah sekarang</a>' ?>
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