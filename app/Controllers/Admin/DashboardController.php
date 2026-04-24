<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\UserModel;
use App\Models\PinjamModel;

class DashboardController extends BaseController
{
    protected BukuModel $bukuModel;
    protected UserModel $userModel;
    protected PinjamModel $pinjamModel;

    public function __construct()
    {
        $this->bukuModel     = new BukuModel();
        $this->userModel     = new UserModel();
        $this->pinjamModel = new PinjamModel();
    }

    /**
     * Tampilkan dashboard admin dengan ringkasan statistik.
     */
    public function index(): string
    {
        $data = [
            'title'          => 'Dashboard Admin',
            'totalBooks'     => $this->bukuModel->countAll(),
            'totalUsers'     => $this->userModel->where('role', 'user')->countAllResults(),
            'totalBorrowed'  => $this->pinjamModel->countActive(),
            'recentBorrowings' => $this->pinjamModel->getBorrowingsWithDetails(),
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Tampilkan semua data peminjaman.
     */
    public function pinjam(): string
    {
        $data = [
            'title'      => 'Kelola Peminjaman',
            'pinjam' => $this->pinjamModel->getBorrowingsWithDetails(),
        ];

        return view('admin/pinjam', $data);
    }

    /**
     * Konfirmasi pengembalian buku.
     */
    public function returnBook(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $borrowing = $this->pinjamModel->find($id);

        if (!$borrowing) {
            return redirect()->to('/admin/pinjam')->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Update status peminjaman menjadi returned
        $this->pinjamModel->update($id, [
            'status'      => 'returned',
            'return_date' => date('Y-m-d'),
        ]);

        // Tambah kembali stok buku
        $book = $this->bukuModel->find($borrowing['book_id']);
        $newStock = $book['stock'] + 1;
        $this->bukuModel->update($borrowing['book_id'], [
            'stock'  => $newStock,
            'status' => 'available',
        ]);

        return redirect()->to('/admin/pinjam')->with('success', 'Buku berhasil dikembalikan.');
    }
}
