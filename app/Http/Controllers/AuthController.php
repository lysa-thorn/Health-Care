<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function updateProfile($id,Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'role' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string|min:4',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = base64_encode(file_get_contents($request->file('image')));

        $user = User::find($id)->update([
                'phone' => $request->phone,
                'image' => $image,
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
                'role' => $request->role
        ]);

        return response()->json([
            'message' => 'User successfully update',
            'user' => $user
        ], 201);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string|min:4',
            'fullname' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
                'phone' => $request->phone,
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'User Logged In Successfully!',
            'phone' => $request->phone,
            'password' =>
                $request->password,
            'access_token' => $token
        ], 201);
    }

    public function username()
    {
        return 'phone';
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
