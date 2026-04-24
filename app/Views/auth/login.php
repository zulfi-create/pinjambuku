<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &mdash; pinjamBukuTJG Sistem Peminjaman Buku</title>
    <meta name="description" content="Login ke sistem peminjaman buku digital pinjamBukuTJG">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background circles */
        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: 0.07;
            animation: float 8s ease-in-out infinite;
        }

        body::before {
            width: 500px; height: 500px;
            background: #818cf8;
            top: -150px; left: -100px;
        }

        body::after {
            width: 350px; height: 350px;
            background: #4f46e5;
            bottom: -100px; right: -80px;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #4f46e5, #818cf8);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #fff;
            margin: 0 auto 1.25rem;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
        }

        .login-title {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.25rem;
        }

        .login-subtitle {
            color: #94a3b8;
            font-size: 0.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-label {
            color: #cbd5e1;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.4rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25);
            color: #fff;
        }

        .form-control::placeholder { color: #475569; }

        .input-group-text {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #94a3b8;
            border-radius: 10px 0 0 10px;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #fff;
            width: 100%;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #3730a3, #4f46e5);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.5);
            color: #fff;
        }
       
        .alert {
            border-radius: 10px;
            font-size: 0.825rem;
            border: none;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <!-- Brand -->
        <div class="brand-icon">
            <i class="bi bi-book-half"></i>
        </div>
        <h1 class="login-title">pinjamBukuTJG</h1>
        <p class="login-subtitle">Sistem Peminjaman Buku Digital</p>

        <!-- Alerts -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?= esc($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Form -->
        <form action="<?= base_url('login') ?>" method="POST" id="loginForm">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="username" class="form-label">
                    <i class="bi bi-person me-1"></i> Username
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Masukkan username"
                    value="<?= old('username') ?>"
                    required
                    autocomplete="username">
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">
                    <i class="bi bi-lock me-1"></i> Password
                </label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    autocomplete="current-password">
            </div>

            <button type="submit" class="btn btn-login" id="btnLogin">
                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Sistem
            </button>
        </form>

        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
