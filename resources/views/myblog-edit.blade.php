<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - KataKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* Override wajib untuk Quill library — tidak dapat diganti dengan class Bootstrap */
        .ql-toolbar.ql-snow { border: none; border-bottom: 1px solid #dee2e6; padding: 12px 0; }
        .ql-container.ql-snow { border: none; font-size: 1.1rem; }
        .ql-editor { min-height: 300px; line-height: 1.8; padding: 16px 0; }
        .ql-editor.ql-blank::before { color: #adb5bd; font-style: normal; left: 0; }
    </style>
</head>

<body class="bg-white">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg text-bg-dark sticky-top border-bottom border-warning border-4"
        data-bs-theme="dark">
        <div class="container-fluid px-4 py-1">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fw-bold fs-3 text-warning animate__animated animate__fadeIn"
                    href="{{ url('/') }}">KataKita</a>
                <span class="ms-3 ps-3 border-start border-secondary text-secondary d-none d-md-inline small">
                    Mode Revisi
                </span>
            </div>

            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="{{ url('/myblog') }}"
                    class="btn btn-link text-white text-decoration-none d-none d-sm-inline-block small">
                    Batalkan Perubahan
                </a>
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-light rounded-circle p-0 d-flex align-items-center
                            justify-content-center" style="width:38px;height:38px;"
                            type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><span class="dropdown-item-text fw-bold small text-secondary">MASUK SEBAGAI</span></li>
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
                <div class="sticky-top pt-4" style="top:80px;">
                    <h6 class="fw-bold text-uppercase text-secondary small mb-4"
                        style="letter-spacing:1px;">Detail Artikel</h6>

                    <div class="mb-4">
                        <label class="small text-muted d-block mb-1">ID Artikel</label>
                        <div class="fw-medium text-dark">#{{ $blog->id_blog }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted d-block mb-1">Terakhir Diperbarui</label>
                        <div class="fw-medium text-dark small">
                            <i class="bi bi-clock-history me-1 text-warning"></i>
                            {{ $blog->updated_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted d-block mb-1">Estimasi Baca</label>
                        <div id="readTime" class="fw-medium text-dark">0 Menit</div>
                    </div>

                    <hr class="my-4">

                    <div class="p-3 bg-warning-subtle rounded-3 border border-warning border-opacity-25 small text-dark">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Perubahan yang Anda simpan akan langsung terlihat oleh pembaca.
                    </div>
                </div>
            </div>

            <!-- Editor -->
            <div class="col-lg-9 col-xl-10 p-0">
                <form method="POST" action="{{ route('myblog.update', $blog->id_blog) }}"
                    enctype="multipart/form-data" id="articleForm">
                    @csrf
                    @method('PUT')

                    <!-- Cover Upload -->
                    <div class="bg-light border-bottom position-relative">

                        <div id="imagePreviewContainer" class="w-100 {{ $blog->cover ? '' : 'd-none' }}">
                            <img id="coverPreview"
                                src="{{ $blog->cover ? asset('storage/' . $blog->cover) : '#' }}"
                                class="w-100 object-fit-cover d-block"
                                style="height:350px;">
                        </div>

                        @if(!$blog->cover)
                            <div id="placeholderText"
                                class="d-flex flex-column align-items-center justify-content-center py-5 text-secondary">
                                <i class="bi bi-image fs-1 mb-2"></i>
                                <p class="small mb-0">Belum ada gambar cover</p>
                            </div>
                        @endif

                        <div class="position-absolute bottom-0 end-0 p-4">
                            <label for="coverInput" class="btn btn-dark btn-sm rounded-pill px-3 shadow"
                                role="button">
                                <i class="bi bi-camera me-2"></i>
                                {{ $blog->cover ? 'Ganti Cover' : 'Tambah Cover' }}
                            </label>
                            <input type="file" name="cover" id="coverInput" class="d-none" accept="image/*">
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="p-4 p-md-5 border-bottom">
                        <div class="mx-auto" style="max-width:850px;">
                            <label class="text-uppercase small fw-bold text-secondary mb-2 d-block"
                                style="letter-spacing:1px;">Judul Artikel</label>
                            <input type="text" name="judul_artikel"
                                class="form-control border-0 fs-1 fw-bold p-0 shadow-none bg-transparent
                                    @error('judul_artikel') is-invalid @enderror"
                                placeholder="Masukkan Judul Disini..."
                                value="{{ old('judul_artikel', $blog->judul_artikel) }}"
                                style="letter-spacing:-1px;">
                            @error('judul_artikel')
                                <div class="invalid-feedback d-block mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Konten Quill -->
                    <div class="p-4 p-md-5 mb-5">
                        <div class="mx-auto" style="max-width:850px;">
                            <label class="text-uppercase small fw-bold text-secondary mb-3 d-block"
                                style="letter-spacing:1px;">Isi Konten</label>

                            <textarea name="content" id="editorContent"
                                class="d-none">{{ old('content', $blog->content) }}</textarea>

                            <div id="quillEditor"></div>

                            @error('content')
                                <div class="text-danger mt-3 small">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Floating Action Bar -->
                    <div class="fixed-bottom bg-white border-top p-3 shadow-lg
                        animate__animated animate__slideInUp">
                        <div class="container d-flex justify-content-between align-items-center">
                            <div class="d-none d-md-flex align-items-center">
                                <span class="badge text-bg-warning me-2">Editor Mode</span>
                                <span class="text-secondary small">Draf tersimpan secara lokal</span>
                            </div>
                            <div class="ms-auto d-flex gap-2">
                                <a href="{{ url('/myblog') }}"
                                    class="btn btn-outline-dark rounded-pill px-4 fw-medium">Batal</a>
                                <button type="submit"
                                    class="btn btn-warning rounded-pill px-5 fw-bold shadow">
                                    Simpan Perubahan <i class="bi bi-cloud-upload ms-1"></i>
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

        const existingContent = document.getElementById('editorContent').value;
        if (existingContent) quill.root.innerHTML = existingContent;

        const readTimeDisplay = document.getElementById('readTime');

        function updateReadTime() {
            const text = quill.getText().trim();
            if (!text) { readTimeDisplay.innerText = '0 Menit'; return; }
            readTimeDisplay.innerText = `${Math.ceil(text.split(/\s+/).length / 200)} Menit`;
        }

        quill.on('text-change', updateReadTime);
        updateReadTime();

        document.getElementById('articleForm').addEventListener('submit', function () {
            document.getElementById('editorContent').value = quill.root.innerHTML;
        });

        const coverInput            = document.getElementById('coverInput');
        const coverPreview          = document.getElementById('coverPreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const placeholderText       = document.getElementById('placeholderText');

        coverInput.onchange = () => {
            const [file] = coverInput.files;
            if (!file) return;
            coverPreview.src = URL.createObjectURL(file);
            imagePreviewContainer.classList.remove('d-none');
            if (placeholderText) placeholderText.classList.add('d-none');
        };
    </script>
</body>

</html>