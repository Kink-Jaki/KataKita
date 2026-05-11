<!doctype html>
<html lang="id" data-bs-theme="light">

<head>
    <title>Blog Saya - KataKita</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- DataTables CSS (Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        :root {
            --bs-warning-rgb: 255, 193, 7;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Customizing DataTables Appearance */
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .pagination {
            --bs-pagination-active-bg: #212529;
            --bs-pagination-active-border-color: #212529;
            --bs-pagination-color: #212529;
            --bs-pagination-hover-color: #ffc107;
            font-size: 0.85rem;
        }

        table.dataTable thead th {
            border-bottom: none !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(var(--bs-warning-rgb), 0.03);
            transition: background-color 0.2s ease;
        }

        /* Custom Search Focus */
        .custom-search-wrapper .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.2);
            border-color: #ffc107;
        }
        
        #artikelTable_filter { display: none; }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-warning animate__animated animate__fadeInLeft" href="/">
                <i class="bi bi-feather me-2"></i>KataKita
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-white opacity-75" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-warning border-bottom border-warning border-2" href="/myblog">Blog Saya</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-warning rounded-pill px-4 dropdown-toggle fw-semibold" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Page Header -->
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4 border-start border-4 border-warning ps-4">
                    <div>
                        <h1 class="display-6 fw-bold text-dark mb-1">Manajemen Artikel</h1>
                        <p class="text-muted mb-0">Atur dan pantau perkembangan tulisan Anda di sini.</p>
                    </div>
                    <a href="{{ route('myblog.create') }}" class="btn btn-dark btn-lg rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i>Tulis Artikel Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="row animate__animated animate__fadeInUp">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white py-4 px-4 border-bottom-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-7">
                                <h5 class="fw-bold mb-0 text-dark">
                                    <i class="bi bi-stack me-2 text-warning"></i>Koleksi Tulisan
                                </h5>
                            </div>
                            <div class="col-md-5 custom-search-wrapper">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 ps-3 rounded-start-pill text-muted">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input id="customSearch" class="form-control border-0 bg-light rounded-end-pill py-2" 
                                           type="search" placeholder="Cari judul artikel...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="artikelTable" class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="py-3 ps-4" style="width: 50px;">No</th>
                                    <th class="py-3">Informasi Artikel</th>
                                    <th class="py-3" style="width: 180px;">Rilis</th>
                                    <th class="py-3 pe-4 text-end" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blog as $item)
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ $loop->count - $loop->iteration + 1 }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $item->judul_artikel }}</div>
                                            <div class="text-muted" style="font-size: 0.75rem;">ID: #KT-{{ $item->id_blog }}</div>
                                        </td>
                                        <td data-order="{{ $item->created_at->timestamp }}">
                                            <div class="d-flex align-items-center small">
                                                <i class="bi bi-calendar-check me-2 text-warning"></i>
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('myblog.edit', $item->id_blog) }}" class="btn btn-sm btn-light border rounded-pill px-3 shadow-sm" title="Edit">
                                                    <i class="bi bi-pencil-square text-dark"></i>
                                                </a>
                                                <form action="{{ route('myblog.destroy', $item->id_blog) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm"
                                                            onclick="return confirm('Hapus artikel ini?')">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                            
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="small mb-0 opacity-50">&copy; 2024 <span class="text-warning fw-bold">KataKita</span>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#artikelTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                    paginate: {
                        previous: "<i class='bi bi-chevron-left'></i>",
                        next: "<i class='bi bi-chevron-right'></i>"
                    }
                },
                pageLength: 10,
                order: [[2, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [0, 3] }
                ],
                dom: '<"d-flex flex-wrap justify-content-between align-items-center p-4"li>t<"d-flex justify-content-center py-4"p>',
            });

            $('#customSearch').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
</body>
</html>