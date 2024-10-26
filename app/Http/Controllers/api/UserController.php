<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{


    public function user() {

        if(Auth::check())
        {
            $user = Auth::user();
            return parent::success($user);
        }
    }


}