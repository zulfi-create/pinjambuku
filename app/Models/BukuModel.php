<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'title', 'author', 'isbn', 'description', 'stock', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'title'  => 'required|min_length[3]|max_length[200]',
        'author' => 'required|min_length[3]|max_length[150]',
        'stock'  => 'required|integer|greater_than_equal_to[0]',
    ];

    /**
     * Ambil semua buku yang tersedia (status = available dan stock > 0).
     */
    public function getAvailableBooks(): array
    {
        return $this->where('status', 'available')
                    ->where('stock >', 0)
                    ->findAll();
    }
}
