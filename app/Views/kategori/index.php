<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-tag me-2"></i>Daftar Kategori Buku</span>
        <a href="<?= base_url('admin/kategori/create') ?>" class="btn btn-primary btn-sm" id="btnTambahKategori">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kategori)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-tag" style="font-size:2.5rem;"></i>
                                <p class="mt-2 mb-0">Belum ada kategori. <a href="<?= base_url('admin/kategori/create') ?>">Tambah kategori sekarang</a></p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($kategori as $i => $k): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($k['nama_kategori']) ?></div>
                                </td>
                                <td>
                                    <small class="text-muted"><?= esc($k['deskripsi'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?= base_url('admin/kategori/edit/' . $k['id']) ?>"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('admin/kategori/delete/' . $k['id']) ?>"
                                           class="btn btn-sm btn-danger" title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus kategori \"<?= esc($k['nama_kategori']) ?>\"?')">
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
