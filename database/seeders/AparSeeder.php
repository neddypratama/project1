<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AparSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apars')->insert([
            'apar_id' => 1,
            'tanggal' => '2024-12-07',
            'status' => 'Belum Dicek',
            'dokumentasi' => 'apar/logo.png',
            'tanda_tangan' => '',
            'user_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
