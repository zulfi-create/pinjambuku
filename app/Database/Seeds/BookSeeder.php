<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'       => 'Laskar Pelangi',
                'author'      => 'Andrea Hirata',
                'isbn'        => '978-979-1231-00-1',
                'description' => 'Novel tentang perjuangan anak-anak Belitung dalam menggapai mimpi mereka.',
                'stock'       => 3,
                'status'      => 'available',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Bumi Manusia',
                'author'      => 'Pramoedya Ananta Toer',
                'isbn'        => '978-979-22-0572-5',
                'description' => 'Novel sejarah yang mengisahkan kehidupan Minke di era kolonialisme Belanda.',
                'stock'       => 2,
                'status'      => 'available',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Negeri 5 Menara',
                'author'      => 'Ahmad Fuadi',
                'isbn'        => '978-979-22-5017-7',
                'description' => 'Kisah enam santri yang bermimpi menggapai menara-menara dunia.',
                'stock'       => 4,
                'status'      => 'available',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Dilan 1990',
                'author'      => 'Pidi Baiq',
                'isbn'        => '978-602-6682-00-1',
                'description' => 'Kisah cinta remaja di Bandung tahun 1990-an yang penuh kenangan.',
                'stock'       => 5,
                'status'      => 'available',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Perahu Kertas',
                'author'      => 'Dee Lestari',
                'isbn'        => '978-979-78-0433-2',
                'description' => 'Novel tentang perjalanan cinta dan mimpi dua anak muda Indonesia.',
                'stock'       => 2,
                'status'      => 'available',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('buku')->insertBatch($data);
    }
}
