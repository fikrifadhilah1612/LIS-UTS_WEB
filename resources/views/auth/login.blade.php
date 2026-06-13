<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - UTS Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container text-center">
        <div class="card shadow-sm mx-auto" style="max-width: 400px;">
            <div class="card-body mt-3 mb-3">
                <h4 class="mb-4">Halaman Login</h4>
                
                @if($errors->any())
                    <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-4">
                        <select name="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('register') }}" class="text-decoration-none">Belum punya akun? Ke Halaman Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>