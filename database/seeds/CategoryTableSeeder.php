<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name='Hiring';
        $category->slut='hiring';
        $category->about='all the task the involves company hiring';
        $category->save();
        $category = new Category();
        $category->name='Payments';
        $category->slut='payments';
        $category->about='all company payments';
        $category->save();
        $category = new Category();
        $category->name='Web Development';
        $category->slut='web-development';
        $category->about='web development tasks';
        $category->save();
        $category = new Category();
        $category->name='Personal';
        $category->slut='personal';
        $category->about='personal tasks';
        $category->save();

    }
}
