<?php $role = $_SESSION['user']['role'] ?? ''; ?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= BASE_URL ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= BASE_URL ?>assets/img/logo/logo.png" alt="<?= APP_NAME ?>" width="42" height="42" style="border-radius:50%;object-fit:cover;box-shadow:0 2px 6px rgba(0,0,0,0.08);" loading="eager" fetchpriority="high" decoding="async" />
            </span>
            <div class="app-brand-text-wrapper ms-2" style="white-space: normal; line-height: 1.2;">
                <span class="app-brand-text demo menu-text fw-bolder" style="font-size: 1.1rem;"><?= APP_NAME ?></span>
                <div class="app-brand-subtitle text-muted" style="font-size: 0.75rem;">by Cicipung</div>
            </div>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <?php $t = $title ?? ''; ?>
    <ul class="menu-inner py-1">
        <?php if ($role === 'admin' || $role === 'karyawan'): ?>
        <li class="menu-item <?= $t === 'Dashboard' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pesanan & Penjualan</span>
        </li>

        <li class="menu-item <?= in_array($t, ['Penjualan Baru', 'Transaksi Baru']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>transactions/create" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                <div>Penjualan Baru</div>
            </a>
        </li>

        <li class="menu-item <?= in_array($t, ['Riwayat Penjualan', 'Detail Penjualan', 'Riwayat Transaksi', 'Detail Transaksi']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>transactions" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div>Riwayat Penjualan</div>
            </a>
        </li>

        <li class="menu-item <?= in_array($t, ['Pesanan Pelanggan', 'Detail Pesanan']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>orders" class="menu-link">
                <i class="menu-icon tf-icons bx bx-receipt"></i>
                <div>Daftar Pesanan</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pembelian</span>
        </li>

        <li class="menu-item <?= $t === 'Pembelian Baru' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>purchases/create" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div>Pembelian Baru</div>
            </a>
        </li>

        <li class="menu-item <?= in_array($t, ['Riwayat Pembelian', 'Detail Pembelian']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>purchases" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div>Riwayat Pembelian</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>

        <li class="menu-item <?= in_array($t, ['Daftar Produk', 'Tambah Produk', 'Edit Produk']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>products" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div>Produk</div>
            </a>
        </li>

        <li class="menu-item <?= in_array($t, ['Daftar Kategori', 'Tambah Kategori', 'Edit Kategori']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>categories" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Kategori</div>
            </a>
        </li>

        <li class="menu-item <?= in_array($t, ['Daftar Supplier', 'Tambah Supplier', 'Edit Supplier']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>suppliers" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div>Supplier</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>

        <li class="menu-item <?= $t === 'Laporan Penjualan' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>reports/sales" class="menu-link">
                <i class="menu-icon tf-icons bx bx-line-chart"></i>
                <div>Laporan Penjualan</div>
            </a>
        </li>

        <li class="menu-item <?= $t === 'Laporan Pembelian' ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>reports/purchases" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div>Laporan Pembelian</div>
            </a>
        </li>

        <?php if ($role === 'admin'): ?>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Penggajian</span>
        </li>

        <li class="menu-item <?= in_array($t, ['Daftar Gaji', 'Tambah Slip Gaji', 'Edit Slip Gaji']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>payrolls" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div>Daftar Gaji</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengaturan</span>
        </li>

        <li class="menu-item <?= in_array($t, ['Manajemen User', 'Tambah User', 'Edit User']) ? 'active' : '' ?>">
            <a href="<?= BASE_URL ?>users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div>Manajemen User</div>
            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
    </ul>
</aside>
