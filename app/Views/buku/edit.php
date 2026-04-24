<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil me-2"></i>Edit Buku
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/buku/update/' . $book['id']) ?>" method="POST" id="formEditBuku">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="<?= old('title', $book['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label fw-semibold">Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="author" name="author"
                               value="<?= old('author', $book['author']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label fw-semibold">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn"
                               value="<?= old('isbn', $book['isbn']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Jumlah Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock" name="stock"
                               min="0" value="<?= old('stock', $book['stock']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="4"><?= old('description', $book['description']) ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnUpdateBuku">
                            <i class="bi bi-check-circle me-1"></i> Update Buku
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
