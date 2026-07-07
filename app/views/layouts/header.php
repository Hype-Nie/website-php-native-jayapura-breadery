<!DOCTYPE html>

<html
    lang="id"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?= BASE_URL ?>assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= $title ?? APP_NAME ?> - <?= APP_NAME ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/img/logo/logo.png" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/demo.css" />
    
    <style>
        :root {
            --primary-color: #1B4571;
            --secondary-color: #197B9B;
        }
        /* Override primary colors in admin dashboard */
        .bg-primary { background-color: var(--primary-color) !important; }
        .btn-primary { background-color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-primary:hover { background-color: #1a82e6 !important; border-color: #1a82e6 !important; }
        .btn-outline-primary { color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-outline-primary:hover { background-color: var(--primary-color) !important; color: #fff !important; }
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

        /* Layout/Menu active state override */
        .menu-inner .active > .menu-link { color: var(--primary-color) !important; background-color: rgba(30, 144, 255, 0.08) !important; }
        .menu-inner .active > .menu-link:before { background-color: var(--primary-color) !important; }
        
        /* Dropdown/Other UI */
        .dropdown-item:active, .dropdown-item.active { background-color: var(--primary-color) !important; }
        
        body { font-family: 'Poppins', sans-serif !important; }

        /* Fix sidebar brand overlapping */
        .layout-menu .app-brand {
            position: sticky;
            top: 0;
            z-index: 20;
            background-color: #fff;
            padding-bottom: 10px;
        }

        .brand-text-3d {
            font-family: "Bookman Old Style", Georgia, serif !important;
            font-size: 28px !important;
            font-weight: 900 !important;
            color: #f8f9fa !important;
            letter-spacing: 2px;
            text-shadow:
                0 -1px 1px #ffffff,
                0 1px 1px #b0b8c4,
                -1px -1px 0 #133458, 1px -1px 0 #133458,
                -1px  1px 0 #133458, 1px  1px 0 #133458,
                1px 1px 0 #2f9eb0, 2px 2px 0 #278696,
                3px 3px 0 #217382, 4px 4px 0 #1c616e,
                5px 5px 0 #17505b, 6px 6px 0 #124049,
                6px 6px 8px rgba(0,0,0,0.5),
                8px 12px 20px rgba(0,0,0,0.3);
            line-height: 1;
            display: inline-block;
        }
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
            z-index: 9999;
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

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <?= $pageStyles ?? '' ?>

    <!-- Helpers -->
    <script src="<?= BASE_URL ?>assets/vendor/js/helpers.js"></script>

    <script src="<?= BASE_URL ?>assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include 'navbar.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php if (isset($_SESSION['flash'])): ?>
                            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible" role="alert">
                                <?= $_SESSION['flash']['message'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['flash']); ?>
                        <?php endif; ?>
                        <?= $content ?? '' ?>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'footer.php'; ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

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

    <!-- Core JS -->
    <script src="<?= BASE_URL ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= BASE_URL ?>assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>

    <script>
        const BASE_URL = '<?= BASE_URL ?>';
        
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