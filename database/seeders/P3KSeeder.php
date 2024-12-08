<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class P3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('p3ks')->insert([
            'p3k_id' => 1,
            'tanggal' => '2024-12-07',
            'status' => 'Revisi',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('p3ks')->insert([
            'p3k_id' => 2,
            'tanggal' => '2024-12-14',
            'status' => 'Revisi',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
