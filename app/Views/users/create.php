<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-plus me-2"></i>Tambah Pengguna Baru
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/users/store') ?>" method="POST" id="formTambahUser">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Contoh: Budi Santoso"
                               value="<?= old('name') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="Contoh: budi123"
                               value="<?= old('username') ?>" required>
                        <small class="text-muted">Username harus unik, minimal 3 karakter.</small>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Minimal 6 karakter" required>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user" <?= old('role') === 'user' ? 'selected' : '' ?>>User (Peminjam)</option>
                            <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnSimpanUser">
                            <i class="bi bi-check-circle me-1"></i> Simpan Pengguna
                        </button>
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
