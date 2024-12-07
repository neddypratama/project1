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
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 2,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 3,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 4,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 5,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 6,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '6',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 7,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '7',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apars')->insert([
            'apar_id' => 8,
            'bulan' => 'Januari',
            'tahun' => '2024',
            'apar_hasil' => '',
            'sub_uraian_id' => '8',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
