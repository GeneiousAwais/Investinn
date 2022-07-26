<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use DB;
use Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $messages = [
            //
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'messages'=>$validation->errors(),
                'status'=> 400
            ], 400);

        }

        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('web-'.$user->email)->plainTextToken;
        return response()->json([
            'status' => 200,
            'message' => 'Login successful',
            'data' => $user,
            'access_token' => $token,
        ], 200);
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email'=> 'required|email|max:255|unique:users',
            'password'=> 'required|min:6',
        ]);
        if($validation->fails())
        {
            return response()->json([
                'message'=>$validation->errors()->first(),
                'status'=> 400
            ], 400);
        }
        $request->request->add([
            'password' => Hash::make($request->password),
        ]);
        DB::beginTransaction();
            try {
                $user = User::create($request->all());
                
                $user = User::with(['userTypes'])->find($user->id);
                DB::commit(); // all good
                return response()->json([
                    'message' => 'User registered successfully.',
                ]);
            }
            catch (\Exception $e) {
                DB::rollback(); // something went wrong
                return response()->json([
                    'message'=> $e->getMessage(),
                ], 400);
        }
    }
}
