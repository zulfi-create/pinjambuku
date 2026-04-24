<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $table            = 'pinjam';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'book_id', 'borrow_date', 'due_date', 'return_date', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil semua data peminjaman beserta detail user dan buku.
     */
    public function getBorrowingsWithDetails(): array
    {
        return $this->select('pinjam.*, users.name as user_name, users.username, buku.title as book_title, buku.author')
                    ->join('users', 'users.id = pinjam.user_id')
                    ->join('buku', 'buku.id = pinjam.book_id')
                    ->orderBy('pinjam.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Ambil riwayat peminjaman untuk user tertentu.
     */
    public function getUserHistory(int $userId): array
    {
        return $this->select('pinjam.*, buku.title as book_title, buku.author')
                    ->join('buku', 'buku.id = pinjam.book_id')
                    ->where('pinjam.user_id', $userId)
                    ->orderBy('pinjam.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Cek apakah user sedang meminjam buku tertentu.
     */
    public function isAlreadyBorrowed(int $userId, int $bookId): bool
    {
        return $this->where('user_id', $userId)
                    ->where('book_id', $bookId)
                    ->where('status', 'borrowed')
                    ->countAllResults() > 0;
    }

    /**
     * Hitung total peminjaman aktif.
     */
    public function countActive(): int
    {
        return $this->where('status', 'borrowed')->countAllResults();
    }
}
