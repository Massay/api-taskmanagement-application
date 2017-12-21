<?php

use Illuminate\Database\Seeder;
use App\Company;
class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();
        $company->name='ZeebasTech';
        $company->email='admin@zeebastech.com';
        $company->save();

        $company = new Company();
        $company->name='alaTest';
        $company->email='admin@alaTest.com';
        $company->save();

        $company = new Company();
        $company->name='Prisine Consulting';
        $company->email='admin@pristineconsulting.com';
        $company->save();

        $company = new Company();
        $company->name='AfriMed';
        $company->email='admin@afrimed.gm';
        $company->save();

    }
}
