<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Peminjaman aktif -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-arrow-left-right me-2"></i>Data Peminjaman</span>
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
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pinjam)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox" style="font-size:2rem;"></i>
                                <p class="mt-2 mb-0">Belum ada data peminjaman.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pinjam as $i => $b): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($b['user_name']) ?></div>
                                    <small class="text-muted">@<?= esc($b['username']) ?></small>
                                </td>
                                <td>
                                    <div><?= esc($b['book_title']) ?></div>
                                    <small class="text-muted"><?= esc($b['author']) ?></small>
                                </td>
                                <td><?= date('d/m/Y', strtotime($b['borrow_date'])) ?></td>
                                <td>
                                    <?php $isLate = $b['status'] === 'borrowed' && strtotime($b['due_date']) < time(); ?>
                                    <span class="<?= $isLate ? 'text-danger fw-semibold' : '' ?>">
                                        <?= date('d/m/Y', strtotime($b['due_date'])) ?>
                                        <?php if ($isLate): ?><i class="bi bi-exclamation-circle-fill"></i><?php endif; ?>
                                    </span>
                                </td>
                                <td><?= $b['return_date'] ? date('d/m/Y', strtotime($b['return_date'])) : '<span class="text-muted">-</span>' ?></td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 badge-<?= $b['status'] ?>">
                                        <?= $b['status'] === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($b['status'] === 'borrowed'): ?>
                                        <a href="<?= base_url('admin/pinjam/return/' . $b['id']) ?>"
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Konfirmasi pengembalian buku ini?')">
                                            <i class="bi bi-check2-circle me-1"></i> Kembalikan
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">Selesai</span>
                                    <?php endif; ?>
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
