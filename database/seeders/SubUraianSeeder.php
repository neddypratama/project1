<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubUraianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 1,
            'sub_uraian_nama' => 'No tabung sesuai tempat',
            'sub_uraian_tipe' => 'text',
            'uraian_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 2,
            'sub_uraian_nama' => 'Tabung telah terpakai/Tabung belum terpakai',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 3,
            'sub_uraian_nama' => 'Putus/Baik',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 4,
            'sub_uraian_nama' => 'Menunjukkan warna merah/Menunjukkan warna hijau',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 5,
            'sub_uraian_nama' => 'Tabung kotor/Tabung bersih',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 6,
            'sub_uraian_nama' => 'Baik/Rusak',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '6',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 7,
            'sub_uraian_nama' => 'Baik/Rusak',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '7',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sub_uraians')->insert([
            'sub_uraian_id' => 8,
            'sub_uraian_nama' => 'Ada/Tidak ada',
            'sub_uraian_tipe' => 'select',
            'uraian_id' => '8',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
