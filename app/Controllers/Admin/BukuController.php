<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;

class BukuController extends BaseController
{
    protected BukuModel $bukuModel;
    protected KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
    }

    /** Daftar semua buku */
    public function index(): string
    {
        $data = [
            'title' => 'Kelola Buku',
            'buku' => $this->bukuModel->select('buku.*, kategori.nama_kategori')
                                      ->join('kategori', 'kategori.id = buku.category_id', 'left')
                                      ->orderBy('buku.created_at', 'DESC')
                                      ->findAll(),
        ];
        return view('buku/index', $data);
    }

    /** Form tambah buku */
    public function create(): string
    {
        $data = [
            'title'      => 'Tambah Buku',
            'categories' => $this->kategoriModel->findAll()
        ];
        return view('buku/create', $data);
    }

    /** Simpan buku baru */
    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $rules = [
            'title'  => 'required|min_length[3]|max_length[200]',
            'author' => 'required|min_length[3]|max_length[150]',
            'stock'  => 'required|integer|greater_than_equal_to[1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->bukuModel->insert([
            'category_id' => $this->request->getPost('category_id'),
            'title'       => $this->request->getPost('title'),
            'author'      => $this->request->getPost('author'),
            'isbn'        => $this->request->getPost('isbn'),
            'description' => $this->request->getPost('description'),
            'stock'       => (int) $this->request->getPost('stock'),
            'status'      => 'available',
        ]);

        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    /** Form edit buku */
    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $buku = $this->bukuModel->find($id);
        if (!$buku) {
            return redirect()->to('/admin/buku')->with('error', 'Buku tidak ditemukan.');
        }
        $data = [
            'title'      => 'Edit Buku',
            'book'       => $buku,
            'categories' => $this->kategoriModel->findAll()
        ];
        return view('buku/edit', $data);
    }

    /** Update data buku */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $rules = [
            'title'  => 'required|min_length[3]|max_length[200]',
            'author' => 'required|min_length[3]|max_length[150]',
            'stock'  => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $stock = (int) $this->request->getPost('stock');
        $this->bukuModel->update($id, [
            'category_id' => $this->request->getPost('category_id'),
            'title'       => $this->request->getPost('title'),
            'author'      => $this->request->getPost('author'),
            'isbn'        => $this->request->getPost('isbn'),
            'description' => $this->request->getPost('description'),
            'stock'       => $stock,
            'status'      => $stock > 0 ? 'available' : 'unavailable',
        ]);

        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil diperbarui.');
    }

    /** Hapus buku */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->bukuModel->delete($id);
        return redirect()->to('/admin/buku')->with('success', 'Buku berhasil dihapus.');
    }
}
