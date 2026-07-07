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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

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
            font-family: 'Poppins', sans-serif;
            background-color: #fcfcfd;
        }

        .navbar-modern {
            padding: 12px 0;
            background: #ffffff !important;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            z-index: 9999 !important;
        }

        .navbar-modern.scrolled {
            padding: 8px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .navbar-brand {
            font-weight: 700;
            color: #111 !important;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .brand-text-3d {
            font-family: "Bookman Old Style", Georgia, serif !important;
            font-size: 28px !important;
            font-weight: 900 !important;
            color: #f8f9fa !important;
            letter-spacing: 2px;
            text-shadow:
                /* Inner Bevel Highlight & Shadow */
                0 -1px 1px #ffffff,
                0 1px 1px #b0b8c4,
                /* Dark Outline */
                -1px -1px 0 #133458,
                 1px -1px 0 #133458,
                -1px  1px 0 #133458,
                 1px  1px 0 #133458,
                /* Metallic Cyan/Teal Extrusion (Gradient effect) */
                1px 1px 0 #2f9eb0,
                2px 2px 0 #278696,
                3px 3px 0 #217382,
                4px 4px 0 #1c616e,
                5px 5px 0 #17505b,
                6px 6px 0 #124049,
                /* Rich Drop Shadow */
                6px 6px 8px rgba(0,0,0,0.5),
                8px 12px 20px rgba(0,0,0,0.3);
            line-height: 1;
            display: inline-block;
        }

        @media (min-width: 992px) {
            .navbar-brand { font-size: 1.25rem; }
        }

        .nav-link-modern {
            font-size: 13px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #444 !important;
            padding: 8px 16px !important;
            transition: all 0.2s;
        }

        .nav-link-modern:hover, .nav-link-modern.active {
            color: var(--primary-color) !important;
        }

        .btn-cart-modern {
            position: relative;
            background: transparent;
            color: #111;
            border: none;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s;
        }

        .btn-cart-modern:hover {
            color: var(--primary-color);
        }

        .btn-cart-modern .badge {
            position: absolute;
            top: 0px;
            right: 0px;
            font-size: 10px;
            padding: 0.25em 0.5em;
            border-radius: 10px;
        }

        .main-content {
            min-height: 80vh;
            padding-top: 10px;
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

        /* Fix button hover states globally so they don't turn grey */
        .btn-warning:hover { background-color: #e68a00 !important; border-color: #e68a00 !important; color: #fff !important; }
        .btn-danger:hover { background-color: #dc3545 !important; border-color: #dc3545 !important; filter: brightness(0.9); color: #fff !important; }
        .btn-success:hover { background-color: #198754 !important; border-color: #198754 !important; filter: brightness(0.9); color: #fff !important; }
        .btn-info:hover { background-color: #0dcaf0 !important; border-color: #0dcaf0 !important; filter: brightness(0.9); color: #fff !important; }

        .btn-outline-warning:hover { background-color: #ff9800 !important; border-color: #ff9800 !important; color: #fff !important; }
        .btn-outline-danger:hover { background-color: #dc3545 !important; border-color: #dc3545 !important; color: #fff !important; }
        .btn-outline-success:hover { background-color: #198754 !important; border-color: #198754 !important; color: #fff !important; }
        .btn-outline-info:hover { background-color: #0dcaf0 !important; border-color: #0dcaf0 !important; color: #fff !important; }

        /* Dropdown item contextual hovers */
        .dropdown-item.text-warning:hover { background-color: rgba(255, 152, 0, 0.15) !important; color: #e68a00 !important; }
        .dropdown-item.text-success:hover { background-color: rgba(25, 135, 84, 0.15) !important; color: #146c43 !important; }
        .dropdown-item.text-danger:hover { background-color: rgba(220, 53, 69, 0.15) !important; color: #b02a37 !important; }
        .dropdown-item.text-info:hover { background-color: rgba(13, 202, 240, 0.15) !important; color: #0aa2c0 !important; }

        .btn-label-danger { background: rgba(255,62,29,0.12); color: #ff3e1d; }
        .btn-label-danger:hover { background: #ff3e1d; color: #fff; }
        .btn-label-secondary { background: rgba(133,146,163,0.12); color: #8592a3; }
        .btn-label-secondary:hover { background: #8592a3; color: #fff; }
        
        /* Vanilla Custom Confirm Modal */
        #vanillaConfirmOverlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            z-index: 99999; opacity: 0; pointer-events: none;
            transition: opacity 0.3s ease;
        }
        #vanillaConfirmOverlay.show { opacity: 1; pointer-events: auto; }
        #vanillaConfirmModal {
            background: #fff; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 90%; max-width: 320px; text-align: center; overflow: hidden;
            transform: translateY(-20px); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        #vanillaConfirmOverlay.show #vanillaConfirmModal { transform: translateY(0); }
        .vanilla-modal-body { padding: 30px 20px 20px; }
        .vanilla-modal-icon { 
            font-size: 4rem; color: #ff3e1d; background: rgba(255,62,29,0.12); 
            border-radius: 50%; 
            display: inline-flex; align-items: center; justify-content: center;
            width: 80px; height: 80px; margin-bottom: 15px; 
        }
        .vanilla-modal-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 10px; color: #333; }
        .vanilla-modal-text { font-size: 0.9rem; color: #6c757d; margin: 0; }
        .vanilla-modal-footer { display: flex; border-top: 1px solid #eee; }
        .vanilla-modal-btn { flex: 1; padding: 15px; border: none; background: #fff; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .vanilla-modal-btn.cancel { color: #6c757d; border-right: 1px solid #eee; }
        .vanilla-modal-btn.cancel:hover { background: #f8f9fa; }
        .vanilla-modal-btn.confirm { color: #ff3e1d; }
        .vanilla-modal-btn.confirm:hover { background: rgba(255,62,29,0.05); }
    </style>

    <!-- Global Custom Toast Style -->
    <style>
        #global-toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #212529;
            color: white;
            padding: 14px 28px;
            border-radius: 30px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1060;
            opacity: 0;
            pointer-events: none;
        }
        #global-toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
        #global-toast.toast-error {
            background: #dc3545;
            box-shadow: 0 15px 35px rgba(220,53,69,0.3);
        }
        #global-toast.toast-success {
            background: #198754;
            box-shadow: 0 15px 35px rgba(25,135,84,0.3);
        }
        #global-toast i {
            font-size: 1.4rem;
        }
    </style>
    <script src="<?= BASE_URL ?>assets/vendor/js/helpers.js"></script>
    <script src="<?= BASE_URL ?>assets/js/config.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-modern sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>">
                <img src="<?= BASE_URL ?>assets/img/logo/logo.png" alt="<?= APP_NAME ?>" width="32" height="32" style="border-radius: 6px;" />
                <span class="brand-text-3d">TBJ</span>
            </a>
            
            <button class="navbar-toggler border-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bx bx-menu" style="font-size: 1.8rem; color: #111;"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <?php 
                $current_url = $_GET['url'] ?? trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
                $is_home = empty($current_url) || $current_url == 'home';
                $is_catalog = strpos($current_url, 'catalog') === 0;
                
                // Fetch categories for dropdown
                require_once '../app/models/Product.php';
                $navProductModel = new Product();
                $navCategories = $navProductModel->getCategories();
                ?>
                <ul class="navbar-nav ms-auto me-lg-4 gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern <?= $is_home ? 'active' : '' ?>" href="<?= BASE_URL ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern <?= $is_catalog ? 'active' : '' ?>" href="<?= BASE_URL ?>catalog">Katalog</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-modern dropdown-toggle" href="#" id="navbarCategoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarCategoryDropdown" style="border-radius: 8px;">
                            <li><a class="dropdown-item py-2" style="font-size: 13px;" href="<?= BASE_URL ?>catalog">Semua Kategori</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php foreach ($navCategories as $cat): ?>
                                <li>
                                    <a class="dropdown-item py-2" style="font-size: 13px;" href="<?= BASE_URL ?>catalog?category=<?= urlencode($cat->category) ?>">
                                        <?= htmlspecialchars($cat->category) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php if (isset($_COOKIE['last_order_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-modern text-primary <?= strpos($current_url, 'checkout/success') === 0 ? 'active' : '' ?>" href="<?= BASE_URL ?>checkout/success/<?= $_COOKIE['last_order_id'] ?>">
                                <i class="bx bx-receipt me-1"></i> Pesanan Terakhir
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <a href="<?= BASE_URL ?>cart" class="btn-cart-modern me-2">
                        <i class="bx bx-shopping-bag" style="font-size: 1.4rem;"></i>
                        <span class="badge bg-danger" id="navCartCount" style="display: <?= empty($_SESSION['cart']) ? 'none' : 'flex' ?>; align-items: center; justify-content: center;">
                            <?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>
                    
                    <div class="vr d-none d-lg-block mx-2 bg-light"></div>

                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="dropdown">
                            <a class="btn btn-primary d-flex align-items-center gap-2 px-3" style="border-radius: 4px; font-size: 13px; text-transform: uppercase; font-weight: 600;" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bx bx-user-circle fs-5"></i>
                                <span>Akun Saya</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" style="border-radius: 8px;">
                                <li><a class="dropdown-item py-2" style="font-size: 13px;" href="<?= BASE_URL ?>dashboard"><i class="bx bx-grid-alt me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item py-2" style="font-size: 13px;" href="<?= BASE_URL ?>profile"><i class="bx bx-user me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" style="font-size: 13px;" href="<?= BASE_URL ?>auth/logout"><i class="bx bx-log-out me-2"></i> Keluar</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>auth/login" class="btn btn-primary px-4" style="border-radius: 4px; font-size: 13px; text-transform: uppercase; font-weight: 600;">
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

    <!-- Global Toast Container -->
    <div id="global-toast">
        <i class="bx bx-info-circle" id="global-toast-icon"></i>
        <span id="global-toast-text">Pesan</span>
    </div>

    <!-- Vanilla Custom Confirm Modal -->
    <div id="vanillaConfirmOverlay">
        <div id="vanillaConfirmModal">
            <div class="vanilla-modal-body">
                <div class="vanilla-modal-icon"><i class="bx bx-question-mark bx-burst"></i></div>
                <h5 class="vanilla-modal-title">Konfirmasi</h5>
                <p class="vanilla-modal-text" id="customConfirmText">Apakah Anda yakin?</p>
            </div>
            <div class="vanilla-modal-footer">
                <button class="vanilla-modal-btn cancel" id="customConfirmBtnCancel">Batal</button>
                <button class="vanilla-modal-btn confirm" id="customConfirmBtn">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <footer class="footer-modern">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <img src="<?= BASE_URL ?>assets/img/logo/logo.png" width="48" height="48" style="border-radius:10px" />
                        <span class="h4 mb-0 brand-text-3d" style="font-size: 36px !important;">TBJ</span>
                    </div>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        <strong>Lokasi Stan TBJ:</strong> Kontener Warna Biru Daerah Jembatan Merah, Jayapura (Seberang Pos Polisi Jembatan Merah)
                        <br><br>
                        <strong>Jam Buka:</strong> Setiap Hari | 5 Sore  - 10 Malam
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
                    <a href="<?= BASE_URL ?>home/how_to_order" class="footer-link">Cara Pesan</a>
                    <a href="<?= BASE_URL ?>home/about" class="footer-link">Tentang Kami</a>
                    <a href="https://wa.me/6282198211806" class="footer-link" target="_blank">Kontak</a>
                </div>
                <div class="col-lg-3">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="d-flex gap-3 mb-3">
                        <i class="bx bx-map text-primary fs-4"></i>
                        <span class="text-muted small">Kota Jayapura, Papua, Indonesia</span>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <i class="bx bx-phone text-primary fs-4"></i>
                        <span class="text-muted small">+62 821-9821-1806</span>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="bx bx-envelope text-primary fs-4"></i>
                        <span class="text-muted small">TBJ@gmail.com</span>
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

        var menuBtn = document.querySelector('.navbar-toggler');
        if (menuBtn) {
            var menuIcon = menuBtn.querySelector('i');
            var navbarNav = document.getElementById('navbarNav');
            if (menuIcon && navbarNav) {
                navbarNav.addEventListener('shown.bs.collapse', function() {
                    menuIcon.classList.remove('bx-menu');
                    menuIcon.classList.add('bx-x');
                    menuIcon.style.transform = 'rotate(0deg)';
                });

                navbarNav.addEventListener('hidden.bs.collapse', function() {
                    menuIcon.classList.remove('bx-x');
                    menuIcon.classList.add('bx-menu');
                    menuIcon.style.transform = 'rotate(0deg)';
                });
            }
        }

        // Global Custom Alert / Toast (Micro Interaction)
        function showGlobalToast(message, type = 'success') {
            const toast = document.getElementById('global-toast');
            const icon = document.getElementById('global-toast-icon');
            const text = document.getElementById('global-toast-text');
            
            toast.className = '';
            
            if (type === 'error') {
                toast.classList.add('toast-error');
                icon.className = 'bx bx-x-circle bx-tada';
            } else if (type === 'success') {
                toast.classList.add('toast-success');
                icon.className = 'bx bx-check-circle bx-burst';
            } else {
                toast.style.background = '#212529';
                icon.className = 'bx bx-info-circle bx-flashing';
            }
            
            text.textContent = message;
            toast.classList.add('show');
            
            // Haptic feedback for mobile devices (micro interaction)
            if (window.navigator && window.navigator.vibrate) {
                navigator.vibrate(type === 'error' ? [50, 50, 50] : 50);
            }
            
            if (window.toastTimeout) clearTimeout(window.toastTimeout);
            window.toastTimeout = setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
        
        // Override default window.alert globally
        window.alert = function(msg) {
            showGlobalToast(msg, 'error');
        };

        // Custom Confirm Dialog (Micro Interaction) - Vanilla JS
        let confirmCallback = null;

        window.showCustomConfirm = function(msg, callback) {
            document.getElementById('customConfirmText').textContent = msg;
            confirmCallback = callback;
            if (window.navigator && window.navigator.vibrate) navigator.vibrate([30, 30, 30]);
            document.getElementById('vanillaConfirmOverlay').classList.add('show');
        };

        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('vanillaConfirmOverlay');

            document.getElementById('customConfirmBtnCancel').addEventListener('click', () => {
                overlay.classList.remove('show');
            });

            document.getElementById('customConfirmBtn').addEventListener('click', () => {
                overlay.classList.remove('show');
                if (confirmCallback) confirmCallback();
            });

            // Override native confirms on links and buttons
            document.querySelectorAll('[onclick*="confirm("]').forEach(el => {
                const clickText = el.getAttribute('onclick');
                const match = clickText.match(/confirm\(['"]([^'"]+)['"]\)/);
                if (match) {
                    el.removeAttribute('onclick');
                    el.addEventListener('click', function(e) {
                        e.preventDefault();
                        showCustomConfirm(match[1], () => {
                            if (el.tagName === 'A') {
                                window.location.href = el.href;
                            } else if (el.tagName === 'BUTTON' && el.type === 'submit') {
                                el.closest('form').submit();
                            }
                        });
                    });
                }
            });

            // Override native confirms on forms
            document.querySelectorAll('form[onsubmit*="confirm("]').forEach(form => {
                const submitText = form.getAttribute('onsubmit');
                const match = submitText.match(/confirm\(['"]([^'"]+)['"]\)/);
                if (match) {
                    form.removeAttribute('onsubmit');
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        showCustomConfirm(match[1], () => {
                            form.submit();
                        });
                    });
                }
            });
        });
    </script>
    <?= $pageScripts ?? '' ?>
</body>

</html>
