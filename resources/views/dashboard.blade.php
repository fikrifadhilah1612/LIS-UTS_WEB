<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lab System Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .hover-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 12px;
        }
        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 15px;
        }
        .bg-gradient-primary { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
        .bg-gradient-success { background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); }
        .bg-gradient-warning { background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%); }
        .bg-gradient-info { background: linear-gradient(135deg, #36b9cc 0%, #258391 100%); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-droplet-half me-2"></i>TerasLIS - Lab System
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->username }} 
                        <span class="badge bg-primary ms-1">{{ Auth::user()->status }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-bold">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-5 position-relative bg-white">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="fw-bold text-dark mb-2">Selamat Datang, {{ Auth::user()->username }}! 👋</h2>
                                <p class="text-muted fs-5 mb-0">Laboratorium Information System. Pilih dibawah untuk mengelola data pasien dan pemeriksaan lab.</p>
                            </div>
                            <div class="col-lg-4 text-end d-none d-lg-block">
                                <i class="bi bi-activity text-primary" style="font-size: 6rem; opacity: 0.2; position: absolute; right: 50px; top: 10px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $totalPasien = \App\Models\Pasien::count();
            $totalPemeriksaan = \App\Models\Pemeriksaan::count();
        @endphp
        <div class="row mb-5">
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-box bg-gradient-primary me-4 mb-0 shadow">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold mb-1">Total Pasien Terdaftar</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalPasien }} <span class="fs-6 fw-normal text-muted">Orang</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-box bg-gradient-success me-4 mb-0 shadow">
                            <i class="bi bi-file-earmark-medical-fill"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold mb-1">Total Pemeriksaan Lab</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalPemeriksaan }} <span class="fs-6 fw-normal text-muted">Dokumen</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-grid-1x2-fill me-2"></i>Menu Utama Aplikasi</h5>
        @php
            $colClass = Auth::user()->status == 'Admin' ? 'col-lg-4 col-md-6' : 'col-md-6';
        @endphp

        <div class="row justify-content-center">
            
            <div class="{{ $colClass }} mb-4">
                <div class="card hover-card shadow-sm h-100 p-2 border-0">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-gradient-info mx-auto shadow-sm">
                            <i class="bi bi-person-vcard"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Manajemen Pasien</h4>
                        <p class="text-muted">Kelola identitas rekam medis pasien meliputi penambahan data baru, edit profil, dan penghapusan data.</p>
                        <a href="{{ route('pasien.index') }}" class="btn btn-outline-info rounded-pill px-4 mt-2 fw-bold">
                            Buka Modul Pasien <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="{{ $colClass }} mb-4">
                <div class="card hover-card shadow-sm h-100 p-2 border-0">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-gradient-warning mx-auto shadow-sm">
                            <i class="bi bi-clipboard2-pulse"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Hasil Pemeriksaan Lab</h4>
                        <p class="text-muted">Kelola pencatatan parameter hasil uji laboratorium yang terintegrasi langsung dengan data pasien.</p>
                        <a href="{{ route('pemeriksaan.index') }}" class="btn btn-outline-warning rounded-pill px-4 mt-2 fw-bold text-dark">
                            Buka Modul Pemeriksaan <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            @if(Auth::user()->status == 'Admin')
            <div class="{{ $colClass }} mb-4">
                <div class="card hover-card shadow-sm h-100 p-2 border-0">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-gradient-success mx-auto shadow-sm">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h4 class="fw-bold mt-3">Kelola Akun User</h4>
                        <p class="text-muted">Modul khusus administrator untuk menambah, mengubah *password*, dan mengatur akses pengguna aplikasi.</p>
                        <a href="{{ route('user.index') }}" class="btn btn-outline-success rounded-pill px-4 mt-2 fw-bold">
                            Buka Pengaturan Akun <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <div class="text-center mt-5 mb-4 text-muted">
            <small>&copy; 2026 TerasLIS - Project UTS Pemrograman Web. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> menggunakan Laravel & Bootstrap 5.</small>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>