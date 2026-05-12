<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->judul_artikel }} - KataKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* Override wajib untuk Quill library — tidak dapat diganti dengan class Bootstrap */
        .ql-snow.ql-toolbar { display: none; }
        .ql-snow.ql-container { border: none; }
        .ql-editor { padding: 0 !important; font-size: 1.1rem !important; line-height: 1.9 !important; }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg text-bg-dark shadow-sm sticky-top mb-4" data-bs-theme="dark">
        <div class="container-fluid px-4 py-1">
            <a class="navbar-brand fw-bold fs-3 text-warning animate__animated animate__zoomIn"
                href="{{ url('/') }}">KataKita</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <div class="d-flex">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-warning fw-semibold rounded-pill px-4 dropdown-toggle"
                                type="button" data-bs-toggle="dropdown">
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
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-warning fw-semibold rounded-pill px-4">Login</a>
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
                        <li class="breadcrumb-item small">
                            <a href="{{ url('/') }}"
                                class="text-decoration-none text-secondary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active small fw-medium" aria-current="page">
                            Detail Artikel
                        </li>
                    </ol>
                </nav>

                <!-- Cover -->
                @if($blog->cover)
                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow mb-5 animate__animated animate__fadeIn">
                        <img src="{{ asset('storage/' . $blog->cover) }}"
                            alt="{{ $blog->judul_artikel }}"
                            class="w-100 h-100 object-fit-cover d-block">
                    </div>
                @endif

                <!-- Article Header -->
                <header class="mb-5">
                    <h1 class="display-5 fw-bold text-dark mb-4">{{ $blog->judul_artikel }}</h1>

                    <div class="d-flex align-items-center flex-wrap gap-2">

                        <!-- Penulis -->
                        <div class="d-flex align-items-center">
                            <div class="bg-dark text-warning rounded-circle d-flex align-items-center
                                justify-content-center me-2 shadow-sm flex-shrink-0"
                                style="width:40px;height:40px;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <p class="mb-0 lh-1 small text-secondary">Penulis</p>
                                <span class="fw-bold text-dark">{{ $blog->user->name }}</span>
                            </div>
                        </div>

                        <span class="text-secondary d-none d-md-inline mx-1">·</span>

                        <!-- Tanggal -->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar3 text-warning me-2"></i>
                            <span class="text-secondary small">
                                {{ $blog->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        <span class="text-secondary d-none d-md-inline mx-1">·</span>

                        <!-- Estimasi baca -->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock text-warning me-2"></i>
                            <span class="text-secondary small">
                                {{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} menit baca
                            </span>
                        </div>

                    </div>
                </header>

                <!-- Article Content -->
                <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm mb-5 animate__animated animate__fadeInUp">
                    <div class="ql-snow">
                        <div class="ql-editor">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </article>

                <!-- Footer Action -->
                <div class="d-flex justify-content-between align-items-center border-top pt-4 mb-5">
                    <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-4 fw-medium shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i>Beranda
                    </a>
                    <div class="d-flex gap-2">
                        <button class="btn btn-light border rounded-circle p-2 shadow-sm" title="Bagikan">
                            <i class="bi bi-share"></i>
                        </button>
                        <button class="btn btn-light border rounded-circle p-2 shadow-sm" title="Simpan">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>