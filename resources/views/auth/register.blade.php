<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - UTS Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container text-center">
        <div class="card shadow-sm mx-auto" style="max-width: 400px;">
            <div class="card-body mt-3 mb-3">
                <h4 class="mb-4">Halaman Register</h4>
                
                <form action="javascript:void(0);">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-4">
                        <select class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>