<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'password' => 'required',
        ]);
        $data['password'] = Hash::make($req->password);
        User::create($data);
        return response()->json($data, 200);
    }

    public function login(Request $req)
    {
        $data = $req->only('email','password');
        if (Auth::attempt($data)) {
            $data['name'] = Auth::user()->name;
            $data['msg'] = "Login SuccessFull";
            return response()->json($data,200);
        }
        else{
            return response()->json(['msg' => 'Username and apssword is incorrect']);
        }
    }
}
