<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KondisiP3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kondisi_p3ks')->insert([
            'kondisi_id' => 1,
            'item_check' => 'Kotak P3K berwarna dasar putih dengan tanda cross berwarna hijau ',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('kondisi_p3ks')->insert([
            'kondisi_id' => 2,
            'item_check' => 'Kotak P3K dalam kondisi dapat dilihat oleh banyak orang/ tidak tertutup/ terhalangi oleh benda lain',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('kondisi_p3ks')->insert([
            'kondisi_id' => 3,
            'item_check' => 'Kotak P3K dapat dibawa kemana-mana',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('kondisi_p3ks')->insert([
            'kondisi_id' => 4,
            'item_check' => 'Form Pemakaian Obat P3K ada didekat kotak P3K',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
