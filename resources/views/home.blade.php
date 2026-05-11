<!doctype html>
<html lang="id" data-bs-theme="light">

<head>
    <title>KataKita - Setiap Cerita Punya Makna</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-light">
    <!-- Navbar Baru (Navigasi Gabungan) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-warning animate__animated animate__fadeInLeft" href="/">
                <i class="bi bi-feather me-2"></i>KataKita
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Menu Utama -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-2">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-warning border-bottom border-warning border-2" href="/">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white opacity-75" href="/myblog">
                            <i class="bi bi-journal-text me-1"></i> Blog Saya
                        </a>
                    </li>
                </ul>

                <!-- Fitur Pencarian & Auth -->
                <div class="d-flex flex-column flex-lg-row align-items-center gap-3">
                    <form class="d-flex" role="search" method="GET" action="{{ route('home') }}">
                        <div class="input-group">
                            <input class="form-control border-0 bg-light text-white rounded-start-pill px-3" 
                                   type="search" placeholder="Cari inspirasi..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-warning rounded-end-pill px-3" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-warning rounded-pill px-4 dropdown-toggle fw-semibold" 
                                    type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-5">
        
        <!-- Hero Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-11">
                <div class="card border-0 bg-dark text-white rounded-5 shadow-lg overflow-hidden animate__animated animate__fadeIn">
                    <div class="card-body p-5 position-relative z-1 text-center text-lg-start">
                        <!-- Aksesori Visual Tanpa CSS (Hanya Border Utility) -->
                        <div class="position-absolute top-0 start-0 h-100 border-start border-5 border-warning opacity-75"></div>
                        
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">KOMUNITAS PENULIS</span>
                                <h1 class="display-4 fw-black mb-3">Selamat Datang di <span class="text-warning">KataKita</span></h1>
                                <p class="lead opacity-75 mb-4">Tempat di mana setiap kata memiliki jiwa dan setiap cerita menemukan pembacanya. Tuangkan ide Anda sekarang.</p>
                                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                                    <a href="/myblog" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow">
                                        Mulai Menulis <i class="bi bi-pencil-square ms-2"></i>
                                    </a>
                                    <a href="#feed" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                        Jelajahi Cerita
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 d-none d-lg-block text-center animate__animated animate__pulse animate__infinite">
                                <i class="bi bi-chat-heart text-warning" style="font-size: 10rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div id="feed" class="row mb-4 align-items-center">
            <div class="col">
                <h2 class="fw-bold border-start border-4 border-warning ps-3">Artikel Terbaru</h2>
                @if (request('search'))
                    <p class="text-muted mt-2">
                        Ditemukan cerita dengan kata kunci: <span class="badge bg-light text-dark border">"{{ request('search') }}"</span>
                        <a href="{{ route('home') }}" class="ms-2 text-danger small text-decoration-none">✕ Hapus Pencarian</a>
                    </p>
                @endif
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="row g-4">
            @foreach ($blog as $item)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 bg-white shadow-sm hover-shadow transition animate__animated animate__fadeInUp">
                        <!-- Cover Image with Badge -->
                        <div class="position-relative">
                            <a href="{{ route('blog.show', $item->id_blog) }}">
                                <div class="ratio ratio-16x9">
                                    @if($item->cover)
                                        <img src="{{ asset('storage/' . $item->cover) }}" class="rounded-top-4 object-fit-cover" alt="Cover">
                                    @else
                                        <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center rounded-top-4 border-bottom">
                                            <i class="bi bi-image text-secondary opacity-25" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <span class="position-absolute top-0 end-0 m-3 badge bg-dark bg-opacity-75 rounded-pill">
                                5 Menit Baca
                            </span>
                        </div>

                        <div class="card-body p-4">
                            <!-- Header Konten: Avatar & Nama -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                     style="width: 38px; height: 38px; font-size: 0.8rem;">
                                    {{ substr($item->penulis, 0, 1) }}
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold small">{{ $item->penulis }}</h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">{{ $item->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            <h5 class="card-title fw-bold mb-3">
                                <a href="{{ route('blog.show', $item->id_blog) }}" class="text-dark text-decoration-none text-truncate d-block">
                                    {{ $item->judul_artikel }}
                                </a>
                            </h5>
                            
                            <p class="card-text text-secondary small mb-4 opacity-75 line-clamp-2">
                                Klik tombol di bawah untuk menyelami seluruh kisah dan inspirasi dari tulisan ini...
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top border-light">
                                <a href="{{ route('blog.show', $item->id_blog) }}" class="btn btn-dark rounded-pill px-4 btn-sm fw-bold shadow-sm">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($blog->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-journal-x display-1 text-muted opacity-25"></i>
                <p class="lead text-muted mt-3">Belum ada cerita yang dibagikan.</p>
                <a href="/myblog" class="btn btn-warning rounded-pill mt-2 px-4">Jadilah yang Pertama</a>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container text-center">
            <h4 class="fw-bold text-warning mb-3">KataKita</h4>
            <p class="opacity-50 small mb-4 px-lg-5">Setiap cerita punya makna. Terima kasih telah menjadi bagian dari komunitas literasi digital kami.</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="#" class="text-white opacity-75 fs-4"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white opacity-75 fs-4"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-white opacity-75 fs-4"><i class="bi bi-linkedin"></i></a>
            </div>
            <hr class="opacity-25">
            <p class="small mb-0 opacity-25">&copy; 2024 KataKita. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>