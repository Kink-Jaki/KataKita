<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung KataKita - Mulai Bagikan Inspirasimu</title>
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
            <div class="col-md-7 col-lg-6 col-xl-5">
                
                <!-- Logo & Brand -->
                <div class="text-center mb-4 animate__animated animate__fadeInDown">
                    <a href="/" class="text-decoration-none">
                        <h1 class="fw-bold display-4 text-dark mb-0">Kata<span class="text-warning">Kita</span></h1>
                    </a>
                    <p class="text-secondary small">Buat akun untuk mulai menulis dan berbagi makna</p>
                </div>

                <!-- Register Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeInUp">
                    <!-- Top Accent Line -->
                    <div class="bg-warning" style="height: 5px;"></div>
                    
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-person text-secondary"></i></span>
                                    <input id="name" type="text" name="name" 
                                        class="form-control bg-light border-0 shadow-none @error('name') is-invalid @enderror" 
                                        placeholder="Nama Anda"
                                        value="{{ old('name') }}" required autofocus autocomplete="name">
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1 animate__animated animate__headShake">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-secondary"></i></span>
                                    <input id="email" type="email" name="email" 
                                        class="form-control bg-light border-0 shadow-none @error('email') is-invalid @enderror" 
                                        placeholder="nama@email.com"
                                        value="{{ old('email') }}" required autocomplete="username">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1 animate__animated animate__headShake">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label small fw-bold text-secondary">Kata Sandi</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-secondary"></i></span>
                                        <input id="password" type="password" name="password" 
                                            class="form-control bg-light border-0 shadow-none @error('password') is-invalid @enderror" 
                                            placeholder="••••••••"
                                            required autocomplete="new-password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1 animate__animated animate__headShake">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label small fw-bold text-secondary">Konfirmasi</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-shield-check text-secondary"></i></span>
                                        <input id="password_confirmation" type="password" name="password_confirmation" 
                                            class="form-control bg-light border-0 shadow-none" 
                                            placeholder="••••••••"
                                            required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                            <!-- Terms & Condition Placeholder -->
                            <div class="mb-4">
                                <p class="text-muted" style="font-size: 0.75rem;">
                                    Dengan mendaftar, Anda menyetujui <span class="text-dark fw-bold">Ketentuan Layanan</span> dan <span class="text-dark fw-bold">Kebijakan Privasi</span> kami.
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning w-100 py-2 fw-bold rounded-pill shadow-sm mb-4">
                                Daftar Sekarang <i class="bi bi-person-plus-fill ms-1"></i>
                            </button>

                            <!-- Login Link -->
                            <div class="text-center pt-2 border-top">
                                <p class="small text-secondary mb-0">Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none border-bottom border-warning border-2 ms-1">Masuk Saja</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer Text -->
                <div class="text-center mt-5 animate__animated animate__fadeIn animate__delay-1s">
                    <p class="text-muted small">&copy; 2024 KataKita Team. Setiap kata adalah cerita.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>