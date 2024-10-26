<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\user\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{


    public function user() {

        if(Auth::check())
        {
            $user = Auth::user();
            return parent::success($user);
        }
    }

    public function userUpdate(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user=Auth::user();
        $validation=$request->validated();
        if (isset($validation['password'])) {
            $validation['password'] = bcrypt($validation['password']);
        }
        $user->update($validation);
        $message='update successfuly';
        return parent::success($message);

    }

    public function userDelete()
    {
        if(Auth::check())
        {
            $userId = Auth::user()->id;
            $user=User::find($userId);
            // dd($user);
            $user->delete();
            return parent::success($user);
        }
    }
}
