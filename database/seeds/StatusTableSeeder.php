<?php

use Illuminate\Database\Seeder;
use App\Status;
class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->name='done';
        $status->slut='done';
        $status->about='Task is completed';
        $status->save();

        $status = new Status();
        $status->name='open';
        $status->slut='open';
        $status->about='Task is open';
        $status->save();

        $status = new Status();
        $status->name='on going';
        $status->slut='on-going';
        $status->about='Task is on-going';
        $status->save();

        $status = new Status();
        $status->name='ideas';
        $status->slut='ideas';
        $status->about='Task needs ideas';
        $status->save();

    }
}
