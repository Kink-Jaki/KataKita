<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke KataKita - Setiap Cerita Punya Makna</title>
    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-light">

    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center py-5">
            <div class="col-md-6 col-lg-5 col-xl-4">
                
                <!-- Logo & Brand -->
                <div class="text-center mb-4 animate__animated animate__fadeInDown">
                    <a href="/" class="text-decoration-none">
                        <h1 class="fw-bold display-4 text-dark mb-0">Kata<span class="text-warning">Kita</span></h1>
                    </a>
                    <p class="text-secondary small">Silakan masuk untuk melanjutkan kreativitasmu</p>
                </div>

                <!-- Login Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeInUp">
                    <!-- Top Accent Line -->
                    <div class="bg-warning" style="height: 5px;"></div>
                    
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Session Status (Laravel) -->
                        @if (session('status'))
                            <div class="alert alert-success border-0 small mb-4 shadow-sm" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-secondary"></i></span>
                                    <input id="email" type="email" name="email" 
                                        class="form-control bg-light border-0 shadow-none @error('email') is-invalid @enderror" 
                                        placeholder="nama@email.com"
                                        value="{{ old('email') }}" required autofocus autocomplete="username">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1 animate__animated animate__headShake">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label small fw-bold text-secondary">Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-secondary"></i></span>
                                    <input id="password" type="password" name="password" 
                                        class="form-control bg-light border-0 shadow-none @error('password') is-invalid @enderror" 
                                        placeholder="••••••••"
                                        required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1 animate__animated animate__headShake">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 d-flex align-items-center">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input border-secondary-subtle shadow-none">
                                    <label for="remember_me" class="form-check-label small text-secondary">Ingat saya di perangkat ini</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning w-100 py-2 fw-bold rounded-pill shadow-sm mb-4">
                                Masuk Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
                            </button>

                            <!-- Register Link -->
                            <div class="text-center pt-2 border-top">
                                <p class="small text-secondary mb-0">Belum punya akun? 
                                    <a href="{{ route('register') }}" class="text-dark fw-bold text-decoration-none border-bottom border-warning border-2 ms-1">Daftar Gratis</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer Text -->
                <div class="text-center mt-5 animate__animated animate__fadeIn animate__delay-1s">
                    <p class="text-muted small">&copy; 2024 KataKita Team. All rights reserved.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>