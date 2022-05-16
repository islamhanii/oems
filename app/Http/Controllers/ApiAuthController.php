<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request) {
        // validate data
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|min:5|max:100',
            'email'     => 'required|email:filter|max:100|unique:users,email',
            'role'      => 'required|integer|exists:roles,id',
            'password'  => 'required|string|min:8|max:25',
            'image'     => 'required_if:role,1|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        // store image file
        $path = Storage::putFile("users", $request->file("image"));

        // store new user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role_id'      => $request->role,
            'password'  => Hash::make($request->password),
            'image'     => $path
        ]);

        // generate token of type 'auth_token'
        $token = $user->createToken('auth_token');

        return Response::json([
            'token' => $token->plainTextToken
        ]);
    }

    /********************************************************************************************/

    public function login(Request $request) {
        // validate data
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email:filter|max:100',
            'password'  => 'required|string|min:8|max:25'
        ]);

        if($validator->fails()) {
            return Response::json(['validation-errors' => $validator->errors()]);
        }

        // validate creditionals
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return Response::json([
                'validation-errors' => 'invalid email or password'
            ]);
        }

        // generate token of type 'auth_token'
        $token = $user->createToken('auth_token');

        return Response::json([
            'token' => $token->plainTextToken
        ]);
    }

    /********************************************************************************************/

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return Response::json([
            'message' => 'you logged out successfully'
        ]);
    }
}
