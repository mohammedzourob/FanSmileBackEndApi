<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;
class UserController extends Controller
{


    public function users() {

        $user=User::All();

        return parent::success($user);

    }
}