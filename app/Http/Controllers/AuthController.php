<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginToGetToken(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'password' => 'required'
            ]);

            $credentials = request(['name', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = User::where('name', $request->name)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

    public function getalltoken() {
        $user = User::where('email','jennybo@gmail.com')->first();
        $arr = [];
        foreach ($user->tokens as $token) {
            array_push($arr, $token);
        }
        return response()->json([
            "token" => $arr,
            "Hash 123456" => Hash::make(123456)
        ]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'password' => 'required'
            ]);
            $credentials = request(['name', 'password']);
            if (!Auth::attempt($credentials)) {
                return redirect()->route('login_panel')->with('error','Sai thông tin đăng nhập!');
            } else {
                return view('server.mainpanel');
            }            
        } catch (\Exception $error) {
            return redirect()->route('login_panel')->with('error','Vui lòng nhập đầy đủ thông tin!');
        }
    }

}
