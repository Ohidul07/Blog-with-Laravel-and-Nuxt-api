<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(RegisterRequest $request)
    {
        $request['user_type'] = 'admin';
        $user = User::create($request->only('name', 'email', 'user_type', 'password'));
        event(new Registered($user));
        return [
            "message" => "User registered successfully.",
            "data" => new UserResource($user)
        ];       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function verifyEmail()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        if(!auth()->attempt($request->only("email","password"))) {
            throw new AuthenticationException("Invalid credentials");
        }

        return [
            "message" => "Login Successfull.",
            "token" => auth()->user()->createToken('access-token')->plainTextToken
        ];
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return [
            "message" => "Successfully logout."
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function user()
    {
        return new UserResource(auth()->user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
