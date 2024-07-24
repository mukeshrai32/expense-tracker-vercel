<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Login to Proceed Further'
        ]);
    }

    /**
     * Login User via API
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Destroy an authenticated token
     */
    public function destroy(Request $request)
    {
        // return response()->json([
        //     'token' => $request->user()->currentAccessToken(),
        //     'tokens' => json_encode($request->user()->tokens())
        // ]);

        # To revoke the current token (the one used for the request),
        // $request->user()->currentAccessToken()->delete();

        # To revoke all tokens for the authenticated user,
        $request->user()->tokens()->delete();


        return response()->json(['message' => 'Successfully logged out']);
    }
}
