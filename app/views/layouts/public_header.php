<!DOCTYPE html>

<html
    lang="id"
    class="light-style"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?= BASE_URL ?>assets/">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= $title ?? APP_NAME ?> - <?= APP_NAME ?></title>

    <meta name="description" content="Toko Manik-manik Jayapura Terlengkap" />

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/img/logo/logo.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/demo.css" />

    <style>
        :root {
            --primary-color: #1E90FF;
            --secondary-color: #F39C12;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfd;
        }

        .navbar-modern {
            padding: 15px 0;
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .navbar-modern.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 800;
            color: #233446 !important;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .nav-link-modern {
            font-weight: 600;
            color: #495057 !important;
            padding: 8px 15px !important;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .nav-link-modern:hover, .nav-link-modern.active {
            color: var(--primary-color) !important;
            background: rgba(30, 144, 255, 0.05);
        }

        .btn-cart-modern {
            position: relative;
            background: #f1f3f5;
            color: #233446;
            border: none;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .btn-cart-modern:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-cart-modern .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            border: 2px solid #fff;
        }

        .main-content {
            min-height: 80vh;
        }

        .footer-modern {
            background: #fff;
            padding: 50px 0 30px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .footer-title {
            font-weight: 800;
            font-size: 1.25rem;
            margin-bottom: 20px;
            color: #233446;
        }

        .footer-link {
            color: #637081;
            text-decoration: none;
            transition: all 0.2s;
            display: block;
            margin-bottom: 10px;
        }

        .footer-link:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }

        .social-btn {
            width: 38px;
            height: 38px;
            background: #f1f3f5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: #495057;
            transition: all 0.3s;
        }

        .social-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        .btn-primary { background-color: var(--primary-color); border-color: var(--primary-color); }
        .btn-primary:hover { background-color: #1a82e6; border-color: #1a82e6; }
        .text-primary { color: var(--primary-color) !important; }
        .bg-label-primary { background-color: rgba(30, 144, 255, 0.1) !important; color: var(--primary-color) !important; }
    </style>

    <script src="<?= BASE_URL ?>assets/vendor/js/helpers.js"></script>
    <script src="<?= BASE_URL ?>assets/js/config.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-modern">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>">
                <img src="<?= BASE_URL ?>assets/img/logo/logo.png" alt="<?= APP_NAME ?>" width="56" height="56" style="border-radius:14px;box-shadow:0 4px 12px rgba(0,0,0,0.15);" />
                <span><?= APP_NAME ?></span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <?php 
                $current_url = $_GET['url'] ?? trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
                $is_home = empty($current_url) || $current_url == 'home';
                $is_catalog = strpos($current_url, 'catalog') === 0;
                ?>
                <ul class="navbar-nav ms-auto me-lg-4 gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern <?= $is_home ? 'active' : '' ?>" href="<?= BASE_URL ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern <?= $is_catalog ? 'active' : '' ?>" href="<?= BASE_URL ?>catalog">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="<?= BASE_URL ?>#categories">Kategori</a>
                    </li>
                    <?php if (isset($_COOKIE['last_order_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-modern text-primary <?= strpos($current_url, 'checkout/success') === 0 ? 'active' : '' ?>" href="<?= BASE_URL ?>checkout/success/<?= $_COOKIE['last_order_id'] ?>">
                                <i class="bx bx-receipt me-1"></i> Pesanan Terakhir
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    <a href="<?= BASE_URL ?>cart" class="btn-cart-modern">
                        <i class="bx bx-shopping-bag fs-4"></i>
                        <span class="badge rounded-pill bg-danger" id="navCartCount" style="display: <?= empty($_SESSION['cart']) ? 'none' : 'flex' ?>; align-items: center; justify-content: center;">
                            <?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>
                    
                    <div class="vr d-none d-lg-block mx-1"></div>

                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="dropdown">
                            <a class="btn btn-primary d-flex align-items-center gap-2 rounded-pill px-4" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bx bx-user-circle fs-4"></i>
                                <span>Akun Saya</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3" style="border-radius: 15px;">
                                <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>dashboard"><i class="bx bx-grid-alt me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>profile"><i class="bx bx-user me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="<?= BASE_URL ?>auth/logout"><i class="bx bx-log-out me-2"></i> Keluar</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>auth/login" class="btn btn-label-primary rounded-pill px-4 fw-bold">
                            Login Admin
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="container mt-4">
                <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible border-0 shadow-sm" role="alert" style="border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <i class="bx <?= $_SESSION['flash']['type'] === 'danger' ? 'bx-error-circle' : 'bx-check-circle' ?> me-2 fs-4"></i>
                        <?= $_SESSION['flash']['message'] ?>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        
        <?= $content ?? '' ?>
    </div>

    <footer class="footer-modern">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <img src="<?= BASE_URL ?>assets/img/logo/logo.png" width="48" height="48" style="border-radius:10px" />
                        <span class="h4 fw-bold mb-0 text-dark"><?= APP_NAME ?></span>
                    </div>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Pusat manik-manik terlengkap di Jayapura. Menyediakan berbagai jenis manik-manik berkualitas untuk kebutuhan aksesoris dan kerajinan tangan Anda.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-btn"><i class="bx bxl-instagram fs-5"></i></a>
                        <a href="#" class="social-btn"><i class="bx bxl-facebook fs-5"></i></a>
                        <a href="#" class="social-btn"><i class="bx bxl-whatsapp fs-5"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2 offset-lg-1">
                    <h5 class="footer-title">Menu</h5>
                    <a href="<?= BASE_URL ?>" class="footer-link">Beranda</a>
                    <a href="<?= BASE_URL ?>catalog" class="footer-link">Katalog</a>
                    <a href="<?= BASE_URL ?>#categories" class="footer-link">Kategori</a>
                    <a href="<?= BASE_URL ?>cart" class="footer-link">Keranjang</a>
                </div>
                <div class="col-6 col-lg-2">
                    <h5 class="footer-title">Bantuan</h5>
                    <a href="#" class="footer-link">Cara Pesan</a>
                    <a href="#" class="footer-link">Pengiriman</a>
                    <a href="#" class="footer-link">Tentang Kami</a>
                    <a href="#" class="footer-link">Kontak</a>
                </div>
                <div class="col-lg-3">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="d-flex gap-3 mb-3">
                        <i class="bx bx-map text-primary fs-4"></i>
                        <span class="text-muted small">Kota Jayapura, Papua, Indonesia</span>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <i class="bx bx-phone text-primary fs-4"></i>
                        <span class="text-muted small">+62 812-3456-7890</span>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="bx bx-envelope text-primary fs-4"></i>
                        <span class="text-muted small">halo@thebeadery.com</span>
                    </div>
                </div>
            </div>
            <div class="pt-4 border-top text-center">
                <p class="text-muted small mb-0">
                    &copy; <?= date('Y') ?> <strong><?= APP_NAME ?></strong>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar-modern').classList.add('scrolled');
            } else {
                document.querySelector('.navbar-modern').classList.remove('scrolled');
            }
        });
    </script>
    <?= $pageScripts ?? '' ?>
</body>

</html>
