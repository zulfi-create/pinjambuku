<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Fiksi',
                'deskripsi'     => 'Buku-buku fiksi, novel, dan cerita pendek.',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Non-Fiksi',
                'deskripsi'     => 'Buku-buku berdasarkan kenyataan dan informasi faktual.',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Sains',
                'deskripsi'     => 'Buku-buku tentang ilmu pengetahuan alam dan teknologi.',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Teknologi',
                'deskripsi'     => 'Buku-buku tentang pemrograman, perangkat keras, dan dunia IT.',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Sejarah',
                'deskripsi'     => 'Buku-buku tentang peristiwa masa lalu dan tokoh sejarah.',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        // Simple Queries
        foreach ($data as $item) {
            $this->db->table('kategori')->insert($item);
        }

        // Assign first category to all existing books as a default
        $firstCategory = $this->db->table('kategori')->limit(1)->get()->getRow();
        if ($firstCategory) {
            $this->db->table('buku')->update(['category_id' => $firstCategory->id]);
        }
    }
}
