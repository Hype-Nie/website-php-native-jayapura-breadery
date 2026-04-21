<!DOCTYPE html>
<html lang="id" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="<?= BASE_URL ?>assets/">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - <?= APP_NAME ?></title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>assets/img/favicon/favicon.ico" />
    <link rel="preload" as="image" href="<?= BASE_URL ?>assets/img/logo/logo-96.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/demo.css" />
    <script src="<?= BASE_URL ?>assets/vendor/js/helpers.js"></script>
    <script src="<?= BASE_URL ?>assets/js/config.js"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="<?= BASE_URL ?>" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="<?= BASE_URL ?>assets/img/logo/logo-96.png" alt="Logo <?= APP_NAME ?>" width="42" height="42" loading="eager" fetchpriority="high" decoding="async" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder"><?= APP_NAME ?></span>
                                <div class="small text-secondary" style="font-size:0.95em;line-height:1.1;">By : Cicipung</div>
                            </a>
                        </div>

                        <h4 class="mb-2">Selamat Datang!</h4>
                        <p class="mb-4">Silakan login untuk mengakses sistem kasir</p>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <?= htmlspecialchars($error) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= BASE_URL ?>auth/login">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                                    placeholder="Masukkan username" autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        required />
                                    <span class="input-group-text cursor-pointer" onclick="togglePw(this)">
                                        <i class="bx bx-hide"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    <i class="bx bx-log-in me-1"></i> Masuk
                                </button>
                            </div>
                        </form>

                        <p class="text-center mt-3">
                            <small class="text-muted">Default: admin / password</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>
    <script>
        function togglePw(el) {
            var input = el.parentElement.querySelector('input');
            var icon = el.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bx-hide', 'bx-show');
            } else {
                input.type = 'password';
                icon.classList.replace('bx-show', 'bx-hide');
            }
        }
    </script>
</body>

</html>