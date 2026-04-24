<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Perpustakaan Digital') ?> &mdash; LibraCI</title>
    <meta name="description" content="Sistem Peminjaman Buku Digital - LibraCI">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #818cf8;
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-active: #4f46e5;
        }

        * { font-family: 'Inter', sans-serif; }

        body { background: #f1f5f9; }

        /* ===== SIDEBAR ===== */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-brand h5 {
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
        }

        .sidebar-brand span {
            color: var(--primary-light);
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #475569;
            padding: 0.75rem 1.5rem 0.25rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.5rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.2s;
        }

        .sidebar-menu a:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }

        .sidebar-menu a.active {
            color: #fff;
            background: var(--sidebar-active);
            border-right: 3px solid var(--primary-light);
        }

        .sidebar-menu a i {
            font-size: 1rem;
            width: 1.25rem;
            text-align: center;
        }

        /* ===== MAIN CONTENT ===== */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar .page-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.75rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            font-size: 0.8rem;
            color: #475569;
        }

        .user-badge .avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* ===== CONTENT AREA ===== */
        .content-area {
            padding: 1.5rem;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* ===== CARDS ===== */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: none;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #1e293b;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* ===== TABLE ===== */
        .table th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            background: #f8fafc;
        }

        .table td {
            font-size: 0.875rem;
            vertical-align: middle;
        }

        /* ===== BADGE ===== */
        .badge-available { background: #dcfce7; color: #15803d; }
        .badge-unavailable { background: #fef2f2; color: #dc2626; }
        .badge-borrowed { background: #fef9c3; color: #854d0e; }
        .badge-returned { background: #dcfce7; color: #15803d; }
        .badge-admin { background: #ede9fe; color: #7c3aed; }
        .badge-user { background: #e0f2fe; color: #0369a1; }

        /* ===== ALERTS ===== */
        .alert { border-radius: 10px; font-size: 0.875rem; }

        /* ===== BOOK CARDS (User) ===== */
        .book-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem;
            height: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .book-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .book-cover-placeholder {
            height: 120px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<nav id="sidebar">
    <div class="sidebar-brand">
        <h5><i class="bi bi-book-half me-2"></i>Libra<span>CI</span></h5>
        <small style="color: #475569; font-size: 0.7rem;">Sistem Peminjaman Buku</small>
    </div>

    <div class="sidebar-menu">
        <?php if (session()->get('role') === 'admin'): ?>
            <div class="sidebar-label">Admin Menu</div>
            <a href="<?= base_url('admin/dashboard') ?>" class="<?= (uri_string() === 'admin/dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/buku') ?>" class="<?= str_starts_with(uri_string(), 'admin/buku') ? 'active' : '' ?>">
                <i class="bi bi-journals"></i> Kelola Buku
            </a>
            <a href="<?= base_url('admin/users') ?>" class="<?= str_starts_with(uri_string(), 'admin/users') ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Kelola Pengguna
            </a>
            <a href="<?= base_url('admin/pinjam') ?>" class="<?= str_starts_with(uri_string(), 'admin/pinjam') ? 'active' : '' ?>">
                <i class="bi bi-arrow-left-right"></i> Peminjaman
            </a>
        <?php else: ?>
            <div class="sidebar-label">Menu</div>
            <a href="<?= base_url('user/dashboard') ?>" class="<?= (uri_string() === 'user/dashboard') ? 'active' : '' ?>">
                <i class="bi bi-house"></i> Beranda
            </a>
            <a href="<?= base_url('user/history') ?>" class="<?= str_starts_with(uri_string(), 'user/history') ? 'active' : '' ?>">
                <i class="bi bi-clock-history"></i> Riwayat Pinjam
            </a>
        <?php endif; ?>

        <div class="sidebar-label mt-2">Akun</div>
        <a href="<?= base_url('logout') ?>">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div id="main-content">
    <!-- TOPBAR -->
    <div class="topbar">
        <h1 class="page-title"><?= esc($title ?? 'Dashboard') ?></h1>
        <div class="user-badge">
            <div class="avatar"><?= strtoupper(substr(session()->get('name') ?? 'U', 0, 1)) ?></div>
            <span><?= esc(session()->get('name')) ?></span>
            <span class="badge rounded-pill <?= session()->get('role') === 'admin' ? 'badge-admin' : 'badge-user' ?> ms-1">
                <?= ucfirst(session()->get('role')) ?>
            </span>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content-area">
        <!-- Alert Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Periksa kembali isian Anda:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach ((array) session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- PAGE CONTENT -->
        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
