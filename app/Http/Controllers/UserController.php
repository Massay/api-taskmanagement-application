<?php

namespace App\Http\Controllers;
use JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Company;
use App\Role;
use Storage;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($user= JWTAuth::parseToken()->authenticate()){
                $token = $request->token;
                JWTAuth::setToken($token);
                $user = JWTAuth::toUser();
                $user['token']=$token;
                $user['tasks'] = $user->tasks;
                $user['comments'] = $user->comments;
                $user['roles'] = $user->roles;
                $user['company'] = $user->company;
                return response()->json([
                            'msg'=>'login successfull',
                            'data'=>$user

                ],200);

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(JWTAuth::parseToken()->authenticate()){

            $data = $request->only([
                'email','name','password','avatar','company_id'
            ]);
            $validator = Validator::make($data, [
               'email' => 'required|email|unique:users',
               'password' => 'required',
               'name'=>'required',
                'company_id'=> 'required '
            ]);

            if ($validator->fails()) {
                return response()
                    ->json([
                        'status' => false,
                        'msg' => 'validation failed',
                        'errors' => $validator->errors()
                    ], 422);
            }
            
            if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
                $originalName=$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->store('public');
                $path = explode('/',$path)[1];
                $originalName=   $path;
            }
            $user = User::create([
                'name' => $data['name'],
                'email'=> $data['email'],
                'password'=> bcrypt($data['password']),
                'avatar' =>$originalName,
                'company_id'=>$data['company_id']
            ]);
            return response()->json([
                'msg'=>'user created',
                'user' => $user
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            if(JWTAuth::parseToken()->authenticate()){
                $user = User::find($id);
                if(!$user){
                    return 'user does not exist';
                }
                $user['tasks'] = $user->tasks;
                $user['comments'] = $user->comments;
                $user['roles'] = $user->roles;
                $user['company'] = $user->company;
                return response()->json([
                            'msg'=>'showing user information',
                            'data'=>$user

                ],200);
            }else{
                return 'token issue';
            }
        }
        catch(JWTAuthException  $e){
            return response()->json([
                'msg'=>'we have an exception',
                'status'=>false
            ],400);
        }


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'email','name',
        ]);
           // return $data;

        if(JWTAuth::parseToken()->authenticate()){
            $user = User::find($id);
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->save();
            return response()->json([
                'msg'=> 'user updated successfully',
                'user'=>$user
            ],200);
        }
    }
    public function updateEmail(Request $request, $id)
    {
        $data = $request->only([
            'email',
        ]);
           // return $data;

        if(JWTAuth::parseToken()->authenticate()){
            $user = User::find($id);
            $user->email = $data['email'];
            $user->save();
            return response()->json([
                'msg'=> 'user updated successfully',
                'user'=>$user
            ],200);
        }
    }


    public function assignRole(Request $request, User $user)
    {
        $data = $request->only([
            'role_id',
        ]);

        $roles = Role::whereIn('id',$data)->get();

        // if($roles.length > 1){
        //     return $roles . 'does not exists';
        // }
        // return $data;

        if(JWTAuth::parseToken()->authenticate()){
            $user->roles()->attach($data);
            $user['roles'] = $user->roles;
            return response()->json([
                'msg'=> 'user successfully assigned',
                'user'=>$user
            ],200);
        }
    }



    public function updateAvatar(Request $request, $id)
    {
        $data = $request->only([
            'avatar',
        ]);
        if(JWTAuth::parseToken()->authenticate()){
            $user = User::find($id);
            if($request->hasFile('avatar') && $request->file('avatar')->isValid()){

                $originalName=$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->store('public');
                $path = explode('/',$path)[1];
                $originalName=   $path;
            }
            $user->avatar =  $originalName;
            $user->save();
            return response()->json([
                'msg'=> 'user updated successfully',
                'user'=>$user
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($user= JWTAuth::parseToken()->authenticate()){
            return 'destroying..';
        }
    }
}
