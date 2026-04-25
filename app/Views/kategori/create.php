<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/kategori/store') ?>" method="POST" id="formTambahKategori">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                               placeholder="Contoh: Fiksi"
                               value="<?= old('nama_kategori') ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                  rows="4" placeholder="Masukkan deskripsi singkat kategori..."><?= old('deskripsi') ?></textarea>
                        <small class="text-muted">Opsional.</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnSimpanKategori">
                            <i class="bi bi-check-circle me-1"></i> Simpan Kategori
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
