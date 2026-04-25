<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Kelola Kategori Buku',
            'kategori' => $this->kategoriModel->findAll()
        ];

        return view('kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori Buku'
        ];

        return view('kategori/create', $data);
    }

    public function store()
    {
        $rules = $this->kategoriModel->getValidationRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to(route_to('admin.kategori'))->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->to(route_to('admin.kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        $data = [
            'title'    => 'Edit Kategori Buku',
            'kategori' => $kategori
        ];

        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $rules = $this->kategoriModel->getValidationRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kategoriModel->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to(route_to('admin.kategori'))->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to(route_to('admin.kategori'))->with('success', 'Kategori berhasil dihapus.');
    }
}
