<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>['required','string','min:8','confirmed']
        ];

        $validation=Validator::make($request->all(),$rules);

        if($validation->fails())
        {
            return parent::error($validation->errors());
        }
        $request['password']=Hash::make($request->input('password'));
        $user = User::create($request->all());

        $success =  $user->createToken($user->name)->plainTextToken;

        $token=$user->tokens->first()->token;
        return parent::success($success);

    }

    public function login(Request $request)
    {

        $validation=Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);

        if($validation->fails()){
            return parent::error($validation->errors());
        }

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password ]))
        {
            $user=$request->user();
            $token=$user->createToken($user->name)->plainTextToken;
            $user->update();

            return parent::success($token);

        }else
        {
            $message='The Account is deleted ';
            return parent::success($message);
        }

    }
}
