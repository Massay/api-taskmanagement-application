<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'simple';
        $role_employee->about = 'A Normal User';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->about = 'An Admin User';
        $role_manager->save();
        $role_manager = new Role();
        $role_manager->name = 'super';
        $role_manager->about = 'An Admin User';
        $role_manager->save();
    }
}
