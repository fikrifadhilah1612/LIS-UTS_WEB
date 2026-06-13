<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemeriksaan - Lab System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Lab System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pasien.index') }}">Data Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('pemeriksaan.index') }}">Data Pemeriksaan</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">{{ Auth::user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Kelola Data Pemeriksaan Hasil Lab</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Hasil Lab</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Nama Tes / Parameter</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>Tanggal Periksa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemeriksaans as $key => $pm)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pm->pasien->nama }}</td>
                            <td>{{ $pm->nama_tes }}</td>
                            <td><span class="badge bg-secondary fs-6">{{ $pm->hasil }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($pm->tanggal)->format('d-m-Y') }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $pm->id }}">Edit</button>
                                
                                <form action="{{ route('pemeriksaan.destroy', $pm->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data pemeriksaan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit{{ $pm->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('pemeriksaan.update', $pm->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Pemeriksaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Pilih Pasien</label>
                                                <select name="pasien_id" class="form-select" required>
                                                    @foreach($pasiens as $pasien)
                                                        <option value="{{ $pasien->id }}" {{ $pm->pasien_id == $pasien->id ? 'selected' : '' }}>
                                                            {{ $pasien->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Nama Tes / Parameter</label>
                                                <input type="text" name="nama_tes" class="form-control" value="{{ $pm->nama_tes }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Hasil Pemeriksaan</label>
                                                <input type="text" name="hasil" class="form-control" value="{{ $pm->hasil }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Tanggal Periksa</label>
                                                <input type="date" name="tanggal" class="form-control" value="{{ $pm->tanggal }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data pemeriksaan lab.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pemeriksaan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Hasil Pemeriksaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Pilih Pasien</label>
                            <select name="pasien_id" class="form-select" required>
                                <option value="">-- Cari Nama Pasien --</option>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nama Tes / Parameter</label>
                            <input type="text" name="nama_tes" class="form-control" placeholder="Contoh: Hemoglobin, Kolesterol" required>
                        </div>
                        <div class="mb-3">
                            <label>Hasil Pemeriksaan</label>
                            <input type="text" name="hasil" class="form-control" placeholder="Contoh: 14.2 g/dL, Normal" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Periksa</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>