<?php

//namespace app\Http\Controllers\Api;
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        echo "Login Endpoint Requested";
    }

    public function register(Request $request){
//        $request->validate([
//           'name' => 'required|string',
//            'email' => 'required|string|unique:users,email,',
//            'password' => 'required|string|min:8',
//            'role' => 'required|exists:roles,id',
//        ]);

        $user =new User([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role' => $request->role
        ]);
        $user->save();
        return response()->json([
           "message" => "User registred successfully"
        ], 201);
    }

    public function index(){
        echo "Hello World";
    }
}
