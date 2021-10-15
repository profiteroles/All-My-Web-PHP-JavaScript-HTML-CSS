<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    /**
     * Register API
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required|min:4',
            'email'=> 'required|email:rfc',
            'password'=> 'required|min:4|confirmed',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $token = $user->createToken('L8-Password-Auth-App')->accessToken;

        return response()->json(['token'=>$token],200);
    }

    /**
     * Handle Login API request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $data = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];


        if (auth()->attempt($data)){
            $token = auth()->user()->createToken('L8-Password-Auth-App')->accessToken;

            return response()->json(['token'=>$token],200);
        }else{
            return response()->json(['error'=>'Unauthorised'],401);
        }
    }
}
