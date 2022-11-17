<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PinValidateController extends Controller
{
    public function pinVal($adminId, $pass){

        $user = User::where(['id'=>$adminId])->first();
        if(Hash::check($pass, $user->password))
            return true;
        return false;
    }
}
