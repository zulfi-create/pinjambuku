<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /** Daftar semua user */
    public function index(): string
    {
        $data = [
            'title' => 'Kelola Pengguna',
            'users' => $this->userModel->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('users/index', $data);
    }

    /** Form tambah user */
    public function create(): string
    {
        return view('users/create', ['title' => 'Tambah Pengguna']);
    }

    /** Simpan user baru */
    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'name'     => 'required|min_length[3]|max_length[150]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[admin,user]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username' => $this->request->getPost('username'),
            'name'     => $this->request->getPost('name'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /** Form edit user */
    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }
        return view('users/edit', ['title' => 'Edit Pengguna', 'user' => $user]);
    }

    /** Update data user */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $rules = [
            'username' => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
            'name'     => 'required|min_length[3]|max_length[150]',
            'role'     => 'required|in_list[admin,user]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'username' => $this->request->getPost('username'),
            'name'     => $this->request->getPost('name'),
            'role'     => $this->request->getPost('role'),
        ];

        // Update password hanya jika diisi
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /** Hapus user */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        // Jangan hapus diri sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
