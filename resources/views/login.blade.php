<!doctype html>
<html lang="id" data-bs-theme="light">

<head>
    <title>Login - KataKita</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                
                <!-- Logo / Brand Title -->
                <div class="text-center mb-4">
                    <a href="index.html" class="text-decoration-none">
                        <h1 class="fw-bold display-4 text-dark">Kata<span class="text-warning">Kita</span></h1>
                    </a>
                    <p class="text-secondary">Silakan masuk untuk melanjutkan</p>
                </div>

                <!-- Login Card -->
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <!-- Top Accent Bar -->
                    <div class="border-top border-5 border-warning"></div>
                    
                    <div class="card-body p-4 p-md-5">
                        <form>
                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" class="form-control form-control-lg rounded-3 border-secondary-subtle focus-ring-warning" id="email" placeholder="nama@email.com" required>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                                    <a href="#" class="text-warning text-decoration-none small fw-bold">Lupa Sandi?</a>
                                </div>
                                <input type="password" class="form-control form-control-lg rounded-3 border-secondary-subtle focus-ring-warning" id="password" placeholder="••••••••" required>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label text-secondary" for="remember">Ingat saya di perangkat ini</label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg fw-bold rounded-pill shadow-sm">
                                    Masuk Sekarang
                                </button>
                            </div>
                        </form>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p class="text-secondary mb-0">Belum punya akun? 
                                <a href="#" class="text-dark fw-bold text-decoration-none border-bottom border-2 border-warning">Daftar Gratis</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Back to Home -->
                <div class="text-center mt-4">
                    <a href="index.html" class="btn btn-link text-secondary text-decoration-none small">
                        &larr; Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmxc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>