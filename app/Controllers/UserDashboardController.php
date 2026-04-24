<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PinjamModel;

class UserDashboardController extends BaseController
{
    protected BukuModel $bukuModel;
    protected PinjamModel $pinjamModel;

    public function __construct()
    {
        $this->bukuModel     = new BukuModel();
        $this->pinjamModel = new PinjamModel();
    }

    /**
     * Dashboard user: tampilkan buku yang tersedia.
     */
    public function index(): string
    {
        $userId = session()->get('user_id');

        $data = [
            'title'           => 'Dashboard',
            'availableBooks'  => $this->bukuModel->getAvailableBooks(),
            'activeBorrowings'=> $this->pinjamModel->where('user_id', $userId)
                                                       ->where('status', 'borrowed')
                                                       ->countAllResults(),
        ];

        return view('user/dashboard', $data);
    }

    /**
     * Proses peminjaman buku.
     */
    public function borrow(int $bookId): \CodeIgniter\HTTP\RedirectResponse
    {
        $userId = session()->get('user_id');
        $book   = $this->bukuModel->find($bookId);

        if (!$book) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        if ($book['stock'] <= 0 || $book['status'] === 'unavailable') {
            return redirect()->back()->with('error', 'Stok buku sudah habis.');
        }

        if ($this->pinjamModel->isAlreadyBorrowed($userId, $bookId)) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        // Simpan data peminjaman
        $this->pinjamModel->insert([
            'user_id'     => $userId,
            'book_id'     => $bookId,
            'borrow_date' => date('Y-m-d'),
            'due_date'    => date('Y-m-d', strtotime('+7 days')),
            'status'      => 'borrowed',
        ]);

        // Kurangi stok buku
        $newStock = $book['stock'] - 1;
        $this->bukuModel->update($bookId, [
            'stock'  => $newStock,
            'status' => $newStock > 0 ? 'available' : 'unavailable',
        ]);

        return redirect()->back()->with('success', 'Buku "' . $book['title'] . '" berhasil dipinjam. Batas pengembalian: ' . date('d/m/Y', strtotime('+7 days')));
    }

    /**
     * Riwayat peminjaman user.
     */
    public function history(): string
    {
        $userId = session()->get('user_id');

        $data = [
            'title'    => 'Riwayat Peminjaman',
            'history'  => $this->pinjamModel->getUserHistory($userId),
        ];

        return view('user/history', $data);
    }
}
