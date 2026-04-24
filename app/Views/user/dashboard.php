<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Info Card -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1" style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Buku Sedang Dipinjam</p>
                    <h2 class="fw-700 mb-0" style="font-size:2rem; color:#1e293b;"><?= $activeBorrowings ?></h2>
                </div>
                <div class="stat-icon" style="background:#fef9c3;">
                    <i class="bi bi-book" style="color:#854d0e;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-8">
        <div class="stat-card h-100 d-flex align-items-center">
            <div>
                <p class="text-muted mb-1" style="font-size:0.8rem;">Selamat datang,</p>
                <h5 class="fw-700 mb-1" style="color:#1e293b;"><?= esc(session()->get('name')) ?></h5>
                <p class="mb-0 text-muted" style="font-size:0.825rem;">Temukan buku favoritmu dan pinjam sekarang. Masa peminjaman 7 hari.</p>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Buku Tersedia -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-journals me-2"></i>Buku Tersedia untuk Dipinjam
    </div>
    <div class="card-body">
        <?php if (empty($availableBooks)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-book-x" style="font-size:3rem;"></i>
                <p class="mt-3 mb-0 fs-6">Tidak ada buku yang tersedia saat ini.</p>
                <small>Silakan cek kembali nanti.</small>
            </div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($availableBooks as $book): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="book-card">
                            <!-- Cover Placeholder -->
                            <div class="book-cover-placeholder">
                                <i class="bi bi-book-fill"></i>
                            </div>

                            <h6 class="fw-700 mb-1" style="font-size:0.9rem; color:#1e293b; line-height:1.4;">
                                <?= esc($book['title']) ?>
                            </h6>
                            <p class="text-muted mb-2" style="font-size:0.8rem;">
                                <i class="bi bi-person-fill me-1"></i><?= esc($book['author']) ?>
                            </p>

                            <?php if ($book['description']): ?>
                                <p class="text-muted mb-3" style="font-size:0.78rem; line-height:1.5;">
                                    <?= esc(substr($book['description'], 0, 100)) ?>...
                                </p>
                            <?php endif; ?>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge badge-available px-2 py-1" style="font-size:0.72rem;">
                                    <i class="bi bi-check-circle me-1"></i>Tersedia
                                </span>
                                <span class="text-muted" style="font-size:0.78rem;">
                                    <i class="bi bi-stack me-1"></i>Stok: <strong><?= $book['stock'] ?></strong>
                                </span>
                            </div>

                            <form action="<?= base_url('user/pinjam/' . $book['id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-primary btn-sm w-100"
                                        id="btnPinjam<?= $book['id'] ?>"
                                        onclick="return confirm('Pinjam buku \"<?= esc($book['title']) ?>\"? Batas pengembalian 7 hari.')">
                                    <i class="bi bi-hand-index me-1"></i> Pinjam Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
