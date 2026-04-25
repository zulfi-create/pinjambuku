<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil me-2"></i>Edit Kategori
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/kategori/update/' . $kategori['id']) ?>" method="POST" id="formEditKategori">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                               value="<?= old('nama_kategori', $kategori['nama_kategori']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                  rows="4"><?= old('deskripsi', $kategori['deskripsi']) ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnUpdateKategori">
                            <i class="bi bi-check-circle me-1"></i> Update Kategori
                        </button>
                        <a href="<?= base_url('admin/kategori') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
