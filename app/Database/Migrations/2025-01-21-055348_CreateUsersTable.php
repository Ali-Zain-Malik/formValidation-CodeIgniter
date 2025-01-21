<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                "type"  => "INT",
                "constraint" => 11,
                "auto_increment" => true,
                "unsigned" => true,
            ],
            'name' => [
                "type"  => "VARCHAR",
                "constraint" => 128,
                "null" => false,
            ],
            'email' => [
                "type"  => "VARCHAR",
                "constraint" => 128,
                "null" => false,
            ],
            'password' => [
                "type"  => "VARCHAR",
                "constraint" => 128,
                "null" => false,
            ],
            'created_at' => [
                "type"  => "DATETIME",
                "null" => false,
            ],
            'updated_at' => [
                "type"  => "DATETIME",
                "null" => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
