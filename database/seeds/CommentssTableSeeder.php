<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\User;
use App\Comment;
class CommentssTableSeeder extends Seeder
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

        $comment = new Comment();
        $comment->body ='Please call the admin manager of africell and confirm appointment';
        $comment->task_id = 1;
        $comment->user_id = $user_simple->id;
        $comment->save();

        $comment = new Comment();
        $comment->body ='sample comment';
        $comment->task_id = 1;
        $comment->user_id = $user_simple->id;
        $comment->save();

        $comment = new Comment();
        $comment->body ='sample comment again';
        $comment->task_id = 1;
        $comment->user_id = $user_simple->id;
        $comment->save();

        $comment = new Comment();
        $comment->body ='last and final sample comment';
        $comment->task_id = 1;
        $comment->user_id = $user_simple->id;
        $comment->save();

        $comment = new Comment();
        $comment->body ='ok. last comment. cheers';
        $comment->task_id = 1;
        $comment->user_id = $user_simple->id;
        $comment->save();
    }
}
