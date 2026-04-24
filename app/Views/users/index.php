<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people me-2"></i>Daftar Pengguna</span>
        <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary btn-sm" id="btnTambahUser">
            <i class="bi bi-person-plus me-1"></i> Tambah Pengguna
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-people" style="font-size:2.5rem;"></i>
                                <p class="mt-2 mb-0">Belum ada pengguna.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $i => $user): ?>
                            <tr>
                                <td class="ps-3 text-muted"><?= $i + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width:34px;height:34px;background:<?= $user['role'] === 'admin' ? '#4f46e5' : '#0ea5e9' ?>;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.8rem;">
                                            <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                        </div>
                                        <span class="fw-semibold"><?= esc($user['name']) ?></span>
                                    </div>
                                </td>
                                <td><code><?= esc($user['username']) ?></code></td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 badge-<?= $user['role'] ?>">
                                        <?= ucfirst($user['role']) ?>
                                    </span>
                                </td>
                                <td><small class="text-muted"><?= date('d/m/Y', strtotime($user['created_at'])) ?></small></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <?php if ($user['id'] != session()->get('user_id')): ?>
                                            <a href="<?= base_url('admin/users/delete/' . $user['id']) ?>"
                                               class="btn btn-sm btn-danger" title="Hapus"
                                               onclick="return confirm('Yakin ingin menghapus pengguna \"<?= esc($user['name']) ?>\"?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php else: ?>
                                            <span class="btn btn-sm btn-outline-secondary disabled" title="Tidak bisa hapus akun sendiri">
                                                <i class="bi bi-shield-lock"></i>
                                            </span>
                                        <?php endif; ?>
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
