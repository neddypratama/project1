<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([AparSeeder::class]); 
        $this->call([UraianSeeder::class]);
        $this->call([SubUraianSeeder::class]);
        $this->call([InputAparSeeder::class]);
        $this->call([P3KSeeder::class]);
        $this->call([KotakP3KSeeder::class]);
        $this->call([IsiP3KSeeder::class]);
        $this->call([KondisiP3KSeeder::class]);
        $this->call([InputIsiP3KSeeder::class]);
        $this->call([InputKondisiP3KSeeder::class]);
    }
}
