<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->judul_artikel }} - KataKita</title>
    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .article-cover-wrapper {
            width: 100%;
            border-radius: 24px;
            overflow: hidden;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .article-cover {
            width: 100%;
            height: 450px;
            object-fit: cover;
            display: block;
        }
        @media (max-width: 768px) {
            .article-cover {
                height: 250px;
            }
            .article-cover-wrapper {
                border-radius: 16px;
            }
        }
        .content-text {
            line-height: 1.8;
            font-size: 1.15rem;
            color: #2d3436;
        }
        .meta-divider {
            width: 4px;
            height: 4px;
            background-color: #dee2e6;
            border-radius: 50%;
            margin: 0 12px;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg text-bg-dark shadow-sm sticky-top mb-4" data-bs-theme="dark">
        <div class="container-fluid px-4 py-1">
            <a class="navbar-brand fw-bold fs-3 text-warning animate__animated animate__zoomIn" href="{{ url('/') }}">KataKita</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <div class="d-flex">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-warning fw-semibold rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="{{ url('/myblog') }}">Blog Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-warning fw-semibold rounded-pill px-4">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item small"><a href="{{ url('/') }}" class="text-decoration-none text-secondary">Beranda</a></li>
                        <li class="breadcrumb-item active small text-dark fw-medium" aria-current="page">Detail Artikel</li>
                    </ol>
                </nav>

                <!-- Menampilkan Gambar Cover -->
                @if($blog->cover)
                    <div class="article-cover-wrapper animate__animated animate__fadeIn">
                        <img src="{{ asset('storage/' . $blog->cover) }}" alt="{{ $blog->judul_artikel }}" class="article-cover">
                    </div>
                @endif

                <!-- Article Header -->
                <header class="mb-5">
                    <h1 class="display-5 fw-bold text-dark mb-4">{{ $blog->judul_artikel }}</h1>

                    <!-- Author & Meta Info Modern -->
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="d-flex align-items-center me-3">
                            <div class="bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <p class="mb-0 lh-1 small text-secondary">Penulis</p>
                                <span class="fw-bold text-dark">{{ $blog->user->name }}</span>
                            </div>
                        </div>
                        
                        <div class="meta-divider d-none d-md-block"></div>
                        
                        <div class="d-flex align-items-center mt-2 mt-md-0">
                            <i class="bi bi-calendar3 text-warning me-2"></i>
                            <span class="text-secondary small">{{ $blog->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </header>

                <!-- Article Content -->
                <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm mb-5 animate__animated animate__fadeInUp">
                    <div class="content-text text-justify" style="text-align: justify;">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                </article>

                <!-- Footer Action -->
                <div class="d-flex justify-content-between align-items-center border-top pt-4 mb-5">
                    <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-4 fw-medium shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i>Beranda
                    </a>
                    
                    <div class="d-flex gap-2">
                        <button class="btn btn-light text-dark btn-sm rounded-circle shadow-sm border p-2" title="Bagikan"><i class="bi bi-share"></i></button>
                        <button class="btn btn-light text-dark btn-sm rounded-circle shadow-sm border p-2" title="Simpan"><i class="bi bi-bookmark"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>