<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-plus-circle me-2"></i>Tambah Buku Baru
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/buku/store') ?>" method="POST" id="formTambahBuku">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Contoh: Laskar Pelangi"
                               value="<?= old('title') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label fw-semibold">Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="author" name="author"
                               placeholder="Contoh: Andrea Hirata"
                               value="<?= old('author') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label fw-semibold">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn"
                               placeholder="Contoh: 978-979-1231-00-1"
                               value="<?= old('isbn') ?>">
                        <small class="text-muted">Opsional.</small>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Jumlah Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock" name="stock"
                               min="1" placeholder="Masukkan jumlah stok"
                               value="<?= old('stock', 1) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="4" placeholder="Masukkan deskripsi singkat buku..."><?= old('description') ?></textarea>
                        <small class="text-muted">Opsional.</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnSimpanBuku">
                            <i class="bi bi-check-circle me-1"></i> Simpan Buku
                        </button>
                        <a href="<?= base_url('admin/buku') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
