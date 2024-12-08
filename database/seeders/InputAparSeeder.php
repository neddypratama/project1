<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputAparSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('input_apars')->insert([
            'input_apar_id' => 1,
            'sub_uraian_id' => 1,
            'hasil_apar' => 'tabung-001',
            'revisi' => '',
            'apar_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 2,
            'sub_uraian_id' => 2,
            'hasil_apar' => '1',
            'revisi' => '',
            'apar_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 3,
            'sub_uraian_id' => 3,
            'hasil_apar' => '0',
            'revisi' => '',
            'apar_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 4,
            'sub_uraian_id' => 4,
            'hasil_apar' => 'tabung-002',
            'revisi' => '',
            'apar_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 5,
            'sub_uraian_id' => 5,
            'hasil_apar' => '1',
            'revisi' => '',
            'apar_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 6,
            'sub_uraian_id' => 6,
            'hasil_apar' => '0',
            'revisi' => '',
            'apar_id' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 7,
            'sub_uraian_id' => 7,
            'hasil_apar' => 'tabung-001',
            'revisi' => '',
            'apar_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 8,
            'sub_uraian_id' => 8,
            'hasil_apar' => '1',
            'revisi' => '',
            'apar_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('input_apars')->insert([
            'input_apar_id' => 9,
            'sub_uraian_id' => 9,
            'hasil_apar' => '0',
            'revisi' => '',
            'apar_id' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 4,
        //     'sub_uraian_id' => 4,
        //     'hasil_apar' => '0',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 5,
        //     'sub_uraian_id' => 5,
        //     'hasil_apar' => '1',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 6,
        //     'sub_uraian_id' => 6,
        //     'hasil_apar' => '0',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 7,
        //     'sub_uraian_id' => 7,
        //     'hasil_apar' => '1',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 8,
        //     'sub_uraian_id' => 8,
        //     'hasil_apar' => '1',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 9,
        //     'sub_uraian_id' => 9,
        //     'hasil_apar' => '0',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 10,
        //     'sub_uraian_id' => 10,
        //     'hasil_apar' => '1',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 11,
        //     'sub_uraian_id' => 11,
        //     'hasil_apar' => '0',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 12,
        //     'sub_uraian_id' => 12,
        //     'hasil_apar' => '1',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 13,
        //     'sub_uraian_id' => 13,
        //     'hasil_apar' => '0',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 14,
        //     'sub_uraian_id' => 14,
        //     'hasil_apar' => '0',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // DB::table('input_apars')->insert([
        //     'input_apar_id' => 15,
        //     'sub_uraian_id' => 15,
        //     'hasil_apar' => '1',
        //     'revisi' => '',
        //     'apar_id' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }
    
}
