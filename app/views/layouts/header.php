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
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/demo.css" />
    
    <style>
        :root {
            --primary-color: #1E90FF;
            --secondary-color: #F39C12;
        }
        /* Override primary colors in admin dashboard */
        .bg-primary { background-color: var(--primary-color) !important; }
        .btn-primary { background-color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-primary:hover { background-color: #1a82e6 !important; border-color: #1a82e6 !important; }
        .btn-outline-primary { color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-outline-primary:hover { background-color: var(--primary-color) !important; color: #fff !important; }
        .text-primary { color: var(--primary-color) !important; }
        .bg-label-primary { background-color: rgba(30, 144, 255, 0.1) !important; color: var(--primary-color) !important; }
        
        /* Layout/Menu active state override */
        .menu-inner .active > .menu-link { color: var(--primary-color) !important; background-color: rgba(30, 144, 255, 0.08) !important; }
        .menu-inner .active > .menu-link:before { background-color: var(--primary-color) !important; }
        
        /* Dropdown/Other UI */
        .dropdown-item:active, .dropdown-item.active { background-color: var(--primary-color) !important; }
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
    </script>
    <?= $pageScripts ?? '' ?>
</body>

</html>