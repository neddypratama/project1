<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role_id' => 1,
            'role_name' => 'Admin',
            'role_description' => 'Berperan sebagai administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'role_id' => 2,
            'role_name' => 'Member',
            'role_description' => 'Berperan sebagai member dan bisa membuat website',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'role_id' => 3,
            'role_name' => 'User',
            'role_description' => 'Berperan sebagai user yang tidak bisa apa-apa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
