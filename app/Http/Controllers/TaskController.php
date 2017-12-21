<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use Validator;
use App\Status;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all()->groupBy('status.name');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->only([
            'subject','user_id','status_id','important','category_id','due','start'
        ]);
        $validator = Validator::make($data,[
            'subject' => 'required',
            'user_id' => 'required',
            'status_id'=>'required',
            'important'=>'boolean',
            'category_id'=> 'required',
            'start' => 'date',
            'due' => 'date'
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'status' => false,
                    'msg' => 'validation failed',
                    'errors' => $validator->errors()
                ], 422);
        }

        $task = Task::create([
            'subject' => $data['subject'],
            'user_id' => $data['user_id'],
            'status_id' => $data['status_id'],
            'important' =>  ( isset($data['important'])) ? $data['important']: false ,
            'category_id' => $data['category_id'],
            'start'=> $data['start'],
            'due' => $data['due']
        ]);
        return response()
        ->json([
            'status' => true,
            'msg' => 'task created',
            'errors' => false,
            'data' => $task 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }


    public function changeCategory(Request $request,Task $task){
        if(JWTAuth::parseToken()->authenticate()){
            $data = $request->only(['category_id']);
            $task->category_id = $data['category_id'];
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task category changed',
                'errors' => false,
                'data' => $task 
            ], 201);
        }

    }

    public function markComplete(Request $request,Task $task){
        if(JWTAuth::parseToken()->authenticate()){
	    $status = Status::where('name','done')->first();
            $task->status_id = $status->id;
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task completed',
                'errors' => false,
                'data' => $task 
            ], 201);
        }   
       
    }
	 public function markOpen(Task $task){
        if(JWTAuth::parseToken()->authenticate()){
	    $status = Status::where('name','open')->first();
            $task->status_id = $status->id;
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task is open',
                'errors' => false,
                'data' => $task 
            ], 201);
        }   
       
    }

	 public function markHold(Task $task){
        if(JWTAuth::parseToken()->authenticate()){
	    $status = Status::where('name','hold')->first();
            $task->status_id = $status->id;
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task is hold',
                'errors' => false,
                'data' => $task 
            ], 201);
        }   
       
    }

	 public function markIdeas(Task $task){
        if(JWTAuth::parseToken()->authenticate()){
	    $status = Status::where('name','ideas')->first();
            $task->status_id = $status->id;
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task in ideas mode',
                'errors' => false,
                'data' => $task 
            ], 201);
        }   
       
    }

 public function markCancelled(Task $task){
        if(JWTAuth::parseToken()->authenticate()){
	    $status = Status::where('name','cancel')->first();
            $task->status_id = $status->id;
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task cancelled',
                'errors' => false,
                'data' => $task 
            ], 201);
        }   
       
    }

	 public function markOngoing(Task $task){
        if(JWTAuth::parseToken()->authenticate()){
	    $status = Status::where('name','on going')->first();
            $task->status_id = $status->id;
            $task->save();
            return response()
            ->json([
                'status' => true,
                'msg' => 'task completed',
                'errors' => false,
                'data' => $task 
            ], 201);
        }   
       
    }

    public function markImportant(Request $request,Task $task){
        if(JWTAuth::parseToken()->authenticate()){
        //$data = $request->only(['important']);
        $task->important = true;
        $task->save();
        return response()
        ->json([
            'status' => true,
            'msg' => 'task important marked',
            'errors' => false,
            'data' => $task 
        ], 201);
    }
    }
	
     public function markUnImportant(Request $request,Task $task){
        if(JWTAuth::parseToken()->authenticate()){
        //$data = $request->only(['important']);
        $task->important = false;
        $task->save();
        return response()
        ->json([
            'status' => true,
            'msg' => 'task unimportant marked',
            'errors' => false,
            'data' => $task 
        ], 201);
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if(JWTAuth::parseToken()->authenticate()){
        $task -> subject = $request->subject;
        $task -> user_id = $request->user_id;
        $task -> category_id = $request->category_id;
        $task -> status_id = $request->status_id;
        return response()
        ->json([
            'status' => true,
            'msg' => 'task updated',
            'errors' => false,
            'data' => $task 
        ], 201);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
