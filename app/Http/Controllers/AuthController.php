<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;
use Laravel\Sanctum\PersonalAccessToken;
use Mail;


class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'nombre' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Mail::to($user->email)->send(new TestMail($user->nombre));

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'nombre' => $user->nombre,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {

            if ($request->email === "admin@gmail.com" && $request->password === "admin") {
                $validateUser = Validator::make(
                    $request->all(),
                    [
                        'email' => 'required|email',
                        'password' => 'required'
                    ]
                );

                if ($validateUser->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

                if (!Auth::attempt($request->only(['email', 'password']))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Email & Password does not match with our record.',
                    ], 401);
                }

                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'Admin Logged In Successfully',
                    'isAdmin' => true,
                    'nombre' => $user->nombre,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {
                $validateUser = Validator::make(
                    $request->all(),
                    [
                        'email' => 'required|email',
                        'password' => 'required'
                    ]
                );

                if ($validateUser->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

                if (!Auth::attempt($request->only(['email', 'password']))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Email & Password does not match with our record.',
                    ], 401);
                }

                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'isAdmin' => false,
                    'nombre' => $user->nombre,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'nombre' => $user->nombre,
            'email' => $user->email,
        ]);
    }

    public function getId(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            $tokenData = PersonalAccessToken::findToken($token);
            if ($tokenData) {
                $user = $tokenData->tokenable;
                return response()->json([
                    'id' => $user->id,
                ]);
            }
        }
        return response()->json([
            'message' => 'Invalid token or user not authenticated',
        ], 401);
    }



    public function getUserProfile(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,          
            'nombre' => $user->nombre,
            'email' => $user->email,
            'password' => $user->password,
        ]);
    }



}
