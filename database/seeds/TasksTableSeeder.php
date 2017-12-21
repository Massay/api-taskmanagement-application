<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\User;
use App\Category;
use App\Status;
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_simple  = User::where('email', 'ndey@alatest.com')->first();
        $user_admin  = User::where('email', 'mbah@gmail.com')->first();
        
        $task = new Task();
        $task->subject = 'Make a video for africell';
        $task->user_id = $user_simple->id;
        $task->status_id = 1;
        $task->category_id = 4;
        $task->save();

                
        $task = new Task();
        $task->subject = 'Prepare content for monthly sharing on facebook';
        $task->user_id = $user_simple->id;
        $task->status_id = 2;
        $task->category_id = 1;
        $task->save();

                
        $task = new Task();
        $task->subject = 'Arrange demo review with the client';
        $task->user_id = $user_simple->id;
        $task->status_id = 2;
        $task->category_id = 4;
        $task->save();

                
        $task = new Task();
        $task->subject = 'Run the database script to migrate all the data from dev to test';
        $task->user_id = $user_simple->id;
        $task->status_id = 3;
        $task->category_id = 3;
        $task->save();


    }
}
