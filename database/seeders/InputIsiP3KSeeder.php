<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputIsiP3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'input_isi_p3ks')->insert([
            'input_isi_id' => 1,
            'isi_id' => 1,
            'jumlah_aktual' => 6,
            'tanggal_kadaluarsa' => '2024-12-30',
            'keterangan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_isi_p3ks')->insert([
            'input_isi_id' => 2,
            'isi_id' => 2,
            'jumlah_aktual' => 6,
            'tanggal_kadaluarsa' => '2024-12-30',
            'keterangan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_isi_p3ks')->insert([
            'input_isi_id' => 3,
            'isi_id' => 3,
            'jumlah_aktual' => 6,
            'tanggal_kadaluarsa' => '2024-12-30',
            'keterangan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_isi_p3ks')->insert([
            'input_isi_id' => 4,
            'isi_id' => 4,
            'jumlah_aktual' => 6,
            'tanggal_kadaluarsa' => '2024-12-30',
            'keterangan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_isi_p3ks')->insert([
            'input_isi_id' => 5,
            'isi_id' => 5,
            'jumlah_aktual' => 6,
            'tanggal_kadaluarsa' => '2024-12-30',
            'keterangan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(table: 'input_isi_p3ks')->insert([
            'input_isi_id' => 6,
            'isi_id' => 6,
            'jumlah_aktual' => 6,
            'tanggal_kadaluarsa' => '2024-12-30',
            'keterangan' => '',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
