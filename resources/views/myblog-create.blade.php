<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Cerita Baru - KataKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border: none;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 0;
        }
        .ql-container.ql-snow {
            border: none;
            font-size: 1.25rem;
        }
        .ql-editor {
            min-height: 300px;
            line-height: 1.8;
            padding: 16px 0;
        }
        .ql-editor.ql-blank::before {
            color: #adb5bd;
            font-style: normal;
            left: 0;
        }
    </style>
</head>

<body class="bg-white">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg text-bg-dark sticky-top border-bottom border-warning border-4" data-bs-theme="dark">
        <div class="container-fluid px-4 py-1">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fw-bold fs-3 text-warning animate__animated animate__fadeIn" href="{{ url('/') }}">KataKita</a>
                <span class="ms-3 ps-3 border-start border-secondary text-secondary d-none d-md-inline small">Mode Penulis</span>
            </div>

            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="{{ url('/myblog') }}" class="btn btn-link text-white text-decoration-none d-none d-sm-inline-block small">Batal</a>
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-light rounded-circle p-0 d-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px;" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><span class="dropdown-item-text fw-bold">{{ Auth::user()->name }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3 col-xl-2 bg-light border-end min-vh-100 d-none d-lg-block p-4">
                <div class="sticky-top" style="top: 100px;">
                    <h6 class="fw-bold text-uppercase text-secondary small mb-4">Informasi Penulisan</h6>

                    <div class="mb-4">
                        <label class="small text-muted d-block mb-2">Status</label>
                        <span class="badge bg-warning text-dark rounded-pill px-3">Draf Baru</span>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted d-block mb-2">Estimasi Baca</label>
                        <div id="readTime" class="fw-medium text-dark">0 Menit</div>
                    </div>

                    <div class="p-3 bg-white rounded-3 border shadow-sm small text-secondary">
                        <i class="bi bi-lightbulb-fill text-warning me-1"></i> Gunakan gambar cover dengan resolusi minimal 1200x630 agar terlihat profesional.
                    </div>
                </div>
            </div>

            <!-- Editor -->
            <div class="col-lg-9 col-xl-10 p-0">
                <form method="POST" action="{{ route('myblog.store') }}" enctype="multipart/form-data" id="articleForm">
                    @csrf

                    <!-- Cover Upload -->
                    <div class="position-relative bg-light border-bottom text-center" style="height: 350px; overflow: hidden;">
                        <img id="coverPreview" class="w-100 h-100 object-fit-cover d-none animate__animated animate__fadeIn">

                        <div id="uploadPlaceholder" class="position-absolute top-50 start-50 translate-middle w-100">
                            <label for="coverInput" style="cursor: pointer;" class="text-secondary">
                                <i class="bi bi-image-fill display-1 text-secondary opacity-25"></i>
                                <h5 class="mt-3 fw-bold">Tambah Cover Artikel</h5>
                                <p class="small">Klik atau seret gambar ke sini (JPG, PNG, WEBP)</p>
                            </label>
                        </div>

                        <div id="changeCoverBtn" class="position-absolute bottom-0 end-0 m-4 d-none">
                            <label for="coverInput" class="btn btn-dark btn-sm rounded-pill px-3 opacity-75 shadow-sm">
                                <i class="bi bi-camera-fill me-2"></i>Ganti Cover
                            </label>
                        </div>

                        <input type="file" name="cover" id="coverInput" accept="image/*" class="d-none">
                    </div>

                    <!-- Judul -->
                    <div class="p-4 p-md-5 border-bottom">
                        <div class="mx-auto" style="max-width: 800px;">
                            <input type="text" name="judul_artikel"
                                class="form-control form-control-lg border-0 fs-1 fw-bold p-0 shadow-none @error('judul_artikel') is-invalid @enderror"
                                placeholder="Masukkan Judul Disini..."
                                value="{{ old('judul_artikel') }}"
                                style="letter-spacing: -1px;">
                            @error('judul_artikel')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Konten Quill -->
                    <div class="p-4 p-md-5 mb-5">
                        <div class="mx-auto" style="max-width: 800px;">

                            {{-- Textarea hidden, diisi saat submit --}}
                            <textarea name="content" id="editorContent" class="d-none">{{ old('content') }}</textarea>

                            {{-- Quill Editor --}}
                            <div id="quillEditor"></div>

                            @error('content')
                                <div class="text-danger mt-3 small">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Floating Action Bar -->
                    <div class="fixed-bottom bg-white border-top p-3 shadow-lg animate__animated animate__slideInUp">
                        <div class="container d-flex justify-content-between align-items-center">
                            <div class="ms-auto d-flex gap-2">
                                <a href="{{ url('/myblog') }}" class="btn btn-outline-dark rounded-pill px-4 fw-medium">Batal</a>
                                <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold shadow">
                                    Terbitkan Artikel <i class="bi bi-check2-circle ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        // Inisialisasi Quill
        const quill = new Quill('#quillEditor', {
            theme: 'snow',
            placeholder: 'Tuliskan cerita inspiratifmu secara detail...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'header': [1, 2, 3, false] }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['blockquote', 'code-block'],
                    ['clean']
                ]
            }
        });

        // Isi dari old() jika validasi gagal
        const oldContent = document.getElementById('editorContent').value;
        if (oldContent) quill.root.innerHTML = oldContent;

        // Estimasi waktu baca
        const readTimeDisplay = document.getElementById('readTime');
        quill.on('text-change', function () {
            const text = quill.getText().trim();
            if (!text) { readTimeDisplay.innerText = '0 Menit'; return; }
            const words = text.split(/\s+/).length;
            readTimeDisplay.innerText = `${Math.ceil(words / 200)} Menit`;
        });

        // Salin isi Quill ke textarea saat submit
        document.getElementById('articleForm').addEventListener('submit', function () {
            document.getElementById('editorContent').value = quill.root.innerHTML;
        });

        // Preview cover
        const coverInput = document.getElementById('coverInput');
        const coverPreview = document.getElementById('coverPreview');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const changeCoverBtn = document.getElementById('changeCoverBtn');

        coverInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    coverPreview.src = e.target.result;
                    coverPreview.classList.remove('d-none');
                    uploadPlaceholder.classList.add('d-none');
                    changeCoverBtn.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>