<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-journals me-2"></i>Daftar Buku</span>
        <a href="<?= base_url('admin/buku/create') ?>" class="btn btn-primary btn-sm" id="btnTambahBuku">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($buku)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-book" style="font-size:2.5rem;"></i>
                                <p class="mt-2 mb-0">Belum ada buku. <a href="<?= base_url('admin/buku/create') ?>">Tambah buku sekarang</a></p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($buku as $i => $b): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($b['title']) ?></div>
                                    <?php if ($b['description']): ?>
                                        <small class="text-muted"><?= esc(substr($b['description'], 0, 60)) ?>...</small>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($b['author']) ?></td>
                                <td><?= esc($b['nama_kategori'] ?? 'Tanpa Kategori') ?></td>
                                <td><small class="text-muted"><?= esc($b['isbn'] ?? '-') ?></small></td>
                                <td>
                                    <span class="fw-semibold <?= $b['stock'] == 0 ? 'text-danger' : 'text-success' ?>">
                                        <?= $b['stock'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 badge-<?= $b['status'] ?>">
                                        <?= $b['status'] === 'available' ? 'Tersedia' : 'Tidak Tersedia' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?= base_url('admin/buku/edit/' . $b['id']) ?>"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/buku/delete/' . $b['id']) ?>"
                                           class="btn btn-sm btn-danger" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus buku \"<?= esc($b['title']) ?>\"?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
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
