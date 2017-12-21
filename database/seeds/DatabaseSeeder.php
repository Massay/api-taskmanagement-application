<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CategoryTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(UserTableSeeder::class);

    }
}
