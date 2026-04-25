<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKategoriToBuku extends Migration
{
    public function up()
    {
        $this->forge->addColumn('buku', [
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // Add foreign key
        $this->db->query('ALTER TABLE buku ADD CONSTRAINT fk_buku_category FOREIGN KEY (category_id) REFERENCES kategori(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        // Drop foreign key first
        $this->db->query('ALTER TABLE buku DROP FOREIGN KEY fk_buku_category');
        $this->forge->dropColumn('buku', 'category_id');
    }
}
