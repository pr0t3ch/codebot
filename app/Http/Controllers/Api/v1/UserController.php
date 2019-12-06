<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\User;


class UserController extends Controller
{
    public function me()
    {
        $result = \Auth::user();
        $user = [];

        if ($result) {
            $user = User::find($result->id);
        }

        return response()->json($user);
    }
}
