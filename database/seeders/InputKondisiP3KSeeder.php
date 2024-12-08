<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputKondisiP3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'input_kondisi_p3ks')->insert([
            'input_kondisi_id' => 1,
            'kondisi_id' => 1,
            'hasil_check' => 'Sesuai',
            'tindakan_perbaikan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_kondisi_p3ks')->insert([
            'input_kondisi_id' => 2,
            'kondisi_id' => 2,
            'hasil_check' => 'Sesuai',
            'tindakan_perbaikan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_kondisi_p3ks')->insert([
            'input_kondisi_id' => 3,
            'kondisi_id' => 3,
            'hasil_check' => 'Sesuai',
            'tindakan_perbaikan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_kondisi_p3ks')->insert([
            'input_kondisi_id' => 4,
            'kondisi_id' => 4,
            'hasil_check' => 'Sesuai',
            'tindakan_perbaikan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
