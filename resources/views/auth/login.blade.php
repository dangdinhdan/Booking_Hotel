<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống - Quản lý Đào tạo & Giảng viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --c-header: #1e3a5f;
            --c-sidebar: #2c4a7c;
            --c-accent: #f5a623;
            --c-bg: #eef2f7;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c4a7c 50%, #1e293b 100%);
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-header {
            background: #1e3a5f;
            color: #ffffff;
            padding: 32px 28px;
            text-align: center;
            position: relative;
        }

        .login-header .logo-badge {
            display: inline-block;
            background: rgba(245, 166, 35, 0.15);
            border: 1px solid var(--c-accent);
            color: var(--c-accent);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .login-header h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .login-header h2 span {
            color: var(--c-accent);
        }

        .login-header p {
            font-size: 13px;
            color: #94a3b8;
            margin: 0;
        }

        .login-body {
            padding: 32px 28px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
            z-index: 5;
        }

        .input-group-custom .form-control {
            padding-left: 42px;
            height: 46px;
            font-size: 14px;
            border-radius: 8px;
            border: 1.5px solid #cbd5e1;
            transition: all 0.2s;
        }

        .input-group-custom .form-control:focus {
            border-color: var(--c-sidebar);
            box-shadow: 0 0 0 3px rgba(44, 74, 124, 0.15);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            z-index: 5;
            padding: 4px;
        }

        .toggle-password:hover {
            color: #334155;
        }

        .btn-submit {
            background-color: var(--c-header);
            border: none;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            height: 46px;
            border-radius: 8px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #152943;
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.35);
        }

        .quick-accounts {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            padding: 14px;
            margin-top: 24px;
        }

        .quick-accounts-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .account-badge-btn {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.15s;
            text-align: left;
            width: 100%;
            margin-bottom: 6px;
        }

        .account-badge-btn:hover {
            border-color: var(--c-accent);
            background: #fffdfa;
            transform: translateY(-1px);
        }

        .account-role {
            font-size: 12px;
            font-weight: 700;
        }

        .account-role.admin {
            color: #7952b3;
        }

        .account-role.gv {
            color: #0d6efd;
        }

        .account-cred {
            font-size: 12px;
            color: #64748b;
        }

        .click-hint {
            font-size: 11px;
            color: var(--c-accent);
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="logo-badge">Cổng Thông Tin Đào Tạo</div>
            <h2>HUCE<span>.Portal</span></h2>
            <p>Hệ thống Quản lý Giảng viên, Lớp học & Sinh viên</p>
        </div>

        <!-- Body -->
        <div class="login-body">
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-3 py-2 px-3">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-3 py-2 px-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" id="loginForm" novalidate>
                @csrf

                <!-- Email / Số điện thoại -->
                <div class="mb-3">
                    <label for="email" class="form-label">Tài khoản (Email hoặc Số điện thoại)</label>
                    <div class="input-group-custom">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="text" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus
                               placeholder="admin@huce.edu.vn hoặc 0988888888">
                    </div>
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group-custom">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required placeholder="Nhập mật khẩu của bạn">
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility()" title="Ẩn/Hiện mật khẩu">
                            <i class="fa-solid fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Ghi nhớ -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted fs-6" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                </div>

                <!-- Nút Đăng nhập -->
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập hệ thống
                </button>
            </form>

            <!-- Tài khoản mẫu để test nhanh -->
            <div class="quick-accounts">
                <div class="quick-accounts-title">
                    <i class="fa-solid fa-key text-warning"></i> Tài khoản mẫu (Bấm để điền nhanh):
                </div>

                <div class="account-badge-btn" onclick="fillAccount('admin@huce.edu.vn', '12345678')">
                    <div>
                        <div class="account-role admin"><i class="fa-solid fa-shield-halved"></i> Quản trị viên (Admin)</div>
                        <div class="account-cred">admin@huce.edu.vn | Mật khẩu: 12345678</div>
                    </div>
                    <span class="click-hint">Điền <i class="fa-solid fa-arrow-right"></i></span>
                </div>

                <div class="account-badge-btn" onclick="fillAccount('giangvien@huce.edu.vn', '12345678')">
                    <div>
                        <div class="account-role gv"><i class="fa-solid fa-chalkboard-user"></i> Giảng viên</div>
                        <div class="account-cred">giangvien@huce.edu.vn | Mật khẩu: 12345678</div>
                    </div>
                    <span class="click-hint">Điền <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    function fillAccount(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
        document.getElementById('password').focus();
    }
</script>

</body>
</html>
