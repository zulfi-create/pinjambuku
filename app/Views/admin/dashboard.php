<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1" style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Total Buku</p>
                    <h2 class="fw-700 mb-0" style="font-size:2rem; color:#1e293b;"><?= $totalBooks ?></h2>
                </div>
                <div class="stat-icon" style="background:#ede9fe;">
                    <i class="bi bi-journals" style="color:#7c3aed;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1" style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Total Pengguna</p>
                    <h2 class="fw-700 mb-0" style="font-size:2rem; color:#1e293b;"><?= $totalUsers ?></h2>
                </div>
                <div class="stat-icon" style="background:#dcfce7;">
                    <i class="bi bi-people" style="color:#15803d;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1" style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Sedang Dipinjam</p>
                    <h2 class="fw-700 mb-0" style="font-size:2rem; color:#1e293b;"><?= $totalBorrowed ?></h2>
                </div>
                <div class="stat-icon" style="background:#fef9c3;">
                    <i class="bi bi-arrow-left-right" style="color:#854d0e;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-lightning-charge me-2"></i>Aksi Cepat</span>
            </div>
            <div class="card-body d-flex gap-2 flex-wrap">
                <a href="<?= base_url('admin/buku/create') ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Buku
                </a>
                <a href="<?= base_url('admin/users/create') ?>" class="btn btn-success btn-sm">
                    <i class="bi bi-person-plus me-1"></i> Tambah Pengguna
                </a>
                <a href="<?= base_url('admin/pinjam') ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-arrow-left-right me-1"></i> Lihat Peminjaman
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Borrowings Table -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</span>
        <a href="<?= base_url('admin/pinjam') ?>" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recentBorrowings)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox" style="font-size:2rem;"></i>
                                <p class="mt-2 mb-0">Belum ada data peminjaman.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach (array_slice($recentBorrowings, 0, 8) as $i => $b): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($b['user_name']) ?></div>
                                    <small class="text-muted"><?= esc($b['username']) ?></small>
                                </td>
                                <td>
                                    <div><?= esc($b['book_title']) ?></div>
                                    <small class="text-muted"><?= esc($b['author']) ?></small>
                                </td>
                                <td><?= date('d/m/Y', strtotime($b['borrow_date'])) ?></td>
                                <td>
                                    <?php
                                        $due = strtotime($b['due_date']);
                                        $now = time();
                                        $isLate = $b['status'] === 'borrowed' && $due < $now;
                                    ?>
                                    <span class="<?= $isLate ? 'text-danger fw-semibold' : '' ?>">
                                        <?= date('d/m/Y', $due) ?>
                                        <?= $isLate ? '<i class="bi bi-exclamation-circle-fill"></i>' : '' ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 badge-<?= $b['status'] ?>">
                                        <?= $b['status'] === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
