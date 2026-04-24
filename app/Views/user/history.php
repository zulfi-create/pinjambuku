<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman Saya
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($history)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox" style="font-size:2.5rem;"></i>
                                <p class="mt-2 mb-0">Anda belum pernah meminjam buku.</p>
                                <a href="<?= base_url('user/dashboard') ?>" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-book me-1"></i> Cari Buku
                                </a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($history as $i => $item): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td class="fw-semibold"><?= esc($item['book_title']) ?></td>
                                <td class="text-muted"><?= esc($item['author']) ?></td>
                                <td><?= date('d/m/Y', strtotime($item['borrow_date'])) ?></td>
                                <td>
                                    <?php
                                        $due = strtotime($item['due_date']);
                                        $isLate = $item['status'] === 'borrowed' && $due < time();
                                    ?>
                                    <span class="<?= $isLate ? 'text-danger fw-semibold' : '' ?>">
                                        <?= date('d/m/Y', $due) ?>
                                        <?php if ($isLate): ?>
                                            <span class="badge bg-danger ms-1" style="font-size:0.65rem;">Terlambat!</span>
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $item['return_date']
                                        ? date('d/m/Y', strtotime($item['return_date']))
                                        : '<span class="text-muted">Belum dikembalikan</span>' ?>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 badge-<?= $item['status'] ?>">
                                        <?= $item['status'] === 'borrowed' ? '<i class="bi bi-book me-1"></i>Dipinjam' : '<i class="bi bi-check2 me-1"></i>Dikembalikan' ?>
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
