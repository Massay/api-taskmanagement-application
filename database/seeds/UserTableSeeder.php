<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_simple = Role::where('name', 'simple')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $company_simple  = Company::where('name', 'alaTest')->first();

        $company_admin  = Company::where('name', 'ZeebasTech')->first();
        
        $simple_user = new User();
        $simple_user->name = 'Ndey Astou Jaiteh';
        $simple_user->email = 'ndey@alatest.com';
        $simple_user->password = bcrypt('secret');
        $simple_user->company_id = $company_simple->id;
        $simple_user->save();
        $simple_user->roles()->attach($role_simple);

        $admin = new User();
        $admin->name = 'Massay Bah';
        $admin->email = 'mbah@gmail.com';
        $admin->password = bcrypt('secret');
        $admin->company_id = $company_admin->id;
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
