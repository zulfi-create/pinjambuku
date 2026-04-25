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
                                        <!-- Tombol Detail (Pop-up) -->
                                        <button type="button" class="btn btn-sm btn-info text-white" 
                                                title="Detail"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal"
                                                data-nama="<?= esc($k['nama_kategori']) ?>"
                                                data-deskripsi="<?= esc($k['deskripsi'] ?? 'Tidak ada deskripsi') ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        
                                        <!-- Tombol Edit -->
                                        <a href="<?= base_url('admin/kategori/edit/' . $k['id']) ?>"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
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

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white border-0">
                <h5 class="modal-title" id="detailModalLabel"><i class="bi bi-info-circle me-2"></i>Detail Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase mb-1 d-block">Nama Kategori</label>
                    <p id="modal-nama" class="h5 fw-bold text-dark mb-0"></p>
                </div>
                <hr class="text-muted opacity-25">
                <div>
                    <label class="text-muted small fw-bold text-uppercase mb-1 d-block">Deskripsi</label>
                    <p id="modal-deskripsi" class="text-secondary mb-0"></p>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailModal = document.getElementById('detailModal');
    if (detailModal) {
        detailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const nama = button.getAttribute('data-nama');
            const deskripsi = button.getAttribute('data-deskripsi');
            
            document.getElementById('modal-nama').textContent = nama;
            document.getElementById('modal-deskripsi').textContent = deskripsi;
        });
    }
});
</script>

<?= $this->endSection() ?>
