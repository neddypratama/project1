<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotakP3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kotak_p3ks')->insert([
            'kotak_id' => 1,
            'lokasi' => 'Divisi Keuangan',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('kotak_p3ks')->insert([
            'kotak_id' => 2,
            'lokasi' => 'Divisi Pabrik',
            'p3k_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
