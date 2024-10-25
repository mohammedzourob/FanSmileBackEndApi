<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request){

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

        if ($request->has('fcm_token')) {
            Token_firebase::create(['fcm_token' => $request->get('fcm_token'), 'user_id' => $user->id]);
        }
        $success['token'] =  $user->createToken($user->name)->plainTextToken;
        return parent::success($success);

    }
}