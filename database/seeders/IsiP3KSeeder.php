<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IsiP3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'isi_p3ks')->insert([
            'isi_id' => 1,
            'isi_nama' => 'Kasa steril (isi 10)',
            'jumlah_standar' => '4',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('isi_p3ks')->insert([
            'isi_id' => 2,
            'isi_nama' => 'Perban (4 5 cm) isi 10',
            'jumlah_standar' => '5',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('isi_p3ks')->insert([
            'isi_id' => 3,
            'isi_nama' => 'Plester (lebar 1,25 cm) ',
            'jumlah_standar' => '5',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('isi_p3ks')->insert([
            'isi_id' => 4,
            'isi_nama' => 'Kapas (25 gram)',
            'jumlah_standar' => '5',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('isi_p3ks')->insert([
            'isi_id' => 5,
            'isi_nama' => 'Kain segitiga (Mitela)',
            'jumlah_standar' => '5',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('isi_p3ks')->insert([
            'isi_id' => 6,
            'isi_nama' => 'Gunting',
            'jumlah_standar' => '5',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
