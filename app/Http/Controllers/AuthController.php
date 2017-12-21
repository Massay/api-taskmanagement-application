<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use JWTAuthException;
use App\User;
use App\Company;

class AuthController extends Controller
{

    public function login(Request $request){
                   

                $credentials= $request->only(['email','password']);

                 $validator = Validator::make($credentials, [
                        'email' => 'required|email',
                        'password' => 'required'
                    ]);

                    if ($validator->fails()) {
                        return response()
                            ->json([
                                'status'=>false,
                                'message' => 'Validation failed.',
                                'errors' => $validator->errors(),
                                'data'=>false
                            ], 422);
                    }

                   try{
                    if(!$token= JWTAuth::attempt($credentials)){
                          return response()->json([
                              'msg'=>'username or password is incorrect',
                              'data'=>false,
                              'status'=>false,
                              'errors' => [
                                   'unknown'=> 'invalid username or password' 
                              ]
                          ],401);
                    }

                   }catch(JWTAuthException  $e){
                        return response()->json([
                            'msg'=>'we have an exception',
                            'status'=>false,
                            'data'=>false,
                            'errors' => $e
                        ],400);
                   }
                  // $user= JWTAuth::toUser($token);
                  // $user['token']=$token;
                  JWTAuth::setToken($token);
                  $user = JWTAuth::toUser();
                  $user['token']=$token;
                  $user['tasks'] = $user->tasks;
                  $user['comments'] = $user->comments;
                  $user['roles'] = $user->roles;
                  $user['company'] = $user->company;
                   return response()->json([
                                'msg'=>'login successfull',
                                'data'=>$user,
                                'status'=>true,
                                'errors' => false

                   ],200);
    }
  
     public function user(Request $request){
        JWTAuth::setToken($request->token);
        $user = JWTAuth::toUser();
        $user['token']=$request->token;
        return response()->json([
            'msg'=>'current user successfull',
            'user'=>$user,
        ]);
       
     }

     public function logout(Request $request){
        JWTAuth::invalidate($request->token);
        return response()->json([
            'msg'=>'token destroyed'
        ]);
     }


    public function register(Request $request){

        $data = $request->only([
            'email','name','password','avatar',
            'company_name','company_logo','company_email'
        ]);
        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name'=>'required',
            'company_name'=>'required',
            'company_email'=>'required',
            'avatar'=>'required | mimes:jpeg,jpg,png,PNG | max:1000'
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'status' => false,
                    'msg' => 'validation failed',
                    'errors' => $validator->errors()
                ], 422);
        }
        $originalName="default.png";
        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            
            $originalName=$request->file('avatar')->getClientOriginalName();
            
            // $pathName=storage_path('app/public/');   
           // $request->file('avatar')->move($pathName,$originalName); 

            $path = $request->file('avatar')->store('public');
            $path = explode('/',$path)[1]; 
            $originalName=   $path;

            
        }

        $data['password']= bcrypt($data['password']);
           
    //  return $request->all();
        $company = new Company();
        $company->name = $data['company_name'];
        $company->email = $data['company_email'];
        $company->logo = $data['company_logo'];
        $company->save();

        $company->users()->create([
                'name' => $data['name'],
                'email'=> $data['email'],
                'password'=> $data['password'],
                'avatar' =>$originalName 
        ]);

         return response()->json([
            'msg'=>'user created'
        ]);
      

    }
}