<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UraianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('uraians')->insert([
            'uraian_id' => 1,
            'uraian_nama' => 'Posisi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('uraians')->insert([
            'uraian_id' => 2,
            'uraian_nama' => 'Kondisi Tabung',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('uraians')->insert([
            'uraian_id' => 3,
            'uraian_nama' => 'Keadaan Segel',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('uraians')->insert([
            'uraian_id' => 4,
            'uraian_nama' => 'Manomater',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('uraians')->insert([
            'uraian_id' => 5,
            'uraian_nama' => 'kebersihan Tabung PMK',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('uraians')->insert([
            'uraian_id' => 6,
            'uraian_nama' => 'Selang Tabung APAR',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('uraians')->insert([
            'uraian_id' => 7,
            'uraian_nama' => 'Handle Tabung APAR',
            'created_at' => now(),
            'updated_at' => now()
        ]);DB::table('uraians')->insert([
            'uraian_id' => 8,
            'uraian_nama' => 'Pen Tabung APAR',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
