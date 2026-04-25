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
                            <td colspan="8" class="text-center py-5 text-muted">
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
                                        <!-- Tombol Detail -->
                                        <button type="button" class="btn btn-sm btn-info text-white" 
                                                title="Detail"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#bookDetailModal"
                                                data-title="<?= esc($b['title']) ?>"
                                                data-author="<?= esc($b['author']) ?>"
                                                data-category="<?= esc($b['nama_kategori'] ?? 'Tanpa Kategori') ?>"
                                                data-isbn="<?= esc($b['isbn'] ?? '-') ?>"
                                                data-stock="<?= $b['stock'] ?>"
                                                data-status="<?= $b['status'] === 'available' ? 'Tersedia' : 'Tidak Tersedia' ?>"
                                                data-description="<?= esc($b['description'] ?? 'Tidak ada deskripsi') ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>

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

<!-- Modal Detail Buku -->
<div class="modal fade" id="bookDetailModal" tabindex="-1" aria-labelledby="bookDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="bookDetailModalLabel"><i class="bi bi-info-circle me-2"></i>Detail Buku</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-4 text-center border-end">
                        <div class="book-cover-placeholder mb-3" style="height: 200px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff;">
                            <i class="bi bi-book" style="font-size: 5rem;"></i>
                        </div>
                        <span id="modal-book-status" class="badge rounded-pill px-3 py-2"></span>
                    </div>
                    <div class="col-md-8">
                        <h3 id="modal-book-title" class="fw-bold text-dark mb-1"></h3>
                        <p id="modal-book-author" class="text-muted mb-3"></p>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="text-muted small fw-bold text-uppercase d-block">Kategori</label>
                                <span id="modal-book-category" class="fw-semibold text-dark"></span>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small fw-bold text-uppercase d-block">ISBN</label>
                                <span id="modal-book-isbn" class="fw-semibold text-dark"></span>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small fw-bold text-uppercase d-block">Stok Tersedia</label>
                                <span id="modal-book-stock" class="fw-semibold text-dark"></span>
                            </div>
                        </div>
                        
                        <hr class="my-4 text-muted opacity-25">
                        
                        <label class="text-muted small fw-bold text-uppercase d-block mb-2">Sinopsis / Deskripsi</label>
                        <p id="modal-book-description" class="text-secondary small mb-0" style="line-height: 1.6;"></p>
                    </div>
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
    const bookDetailModal = document.getElementById('bookDetailModal');
    if (bookDetailModal) {
        bookDetailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            
            const title = button.getAttribute('data-title');
            const author = button.getAttribute('data-author');
            const category = button.getAttribute('data-category');
            const isbn = button.getAttribute('data-isbn');
            const stock = button.getAttribute('data-stock');
            const status = button.getAttribute('data-status');
            const description = button.getAttribute('data-description');
            
            document.getElementById('modal-book-title').textContent = title;
            document.getElementById('modal-book-author').textContent = 'Oleh: ' + author;
            document.getElementById('modal-book-category').textContent = category;
            document.getElementById('modal-book-isbn').textContent = isbn;
            document.getElementById('modal-book-stock').textContent = stock + ' Buku';
            document.getElementById('modal-book-description').textContent = description;
            
            const statusBadge = document.getElementById('modal-book-status');
            statusBadge.textContent = status;
            statusBadge.className = 'badge rounded-pill px-3 py-2 ' + 
                                   (status === 'Tersedia' ? 'bg-success' : 'bg-danger');
        });
    }
});
</script>

<?= $this->endSection() ?>
