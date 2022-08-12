<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * auth user
     *
     * @throws ValidationException
     */
    public function authenticate(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate(
                $request, [
                'email' => 'required',
                'password' => 'required',
            ]
            );
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), 422);
        }
        $user = User::where('email', $request->input('email'))->first();

        if(Hash::check($request->input('password'), $user->password)){
            return response()->json(['status' => 'success','api_key' => $user->api_token]);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
    }

    /**
     * register new user
     *
     * @throws ValidationException
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate(
                $request, [
                'first_name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]
            );
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), 422);
        }

        $data = $request->all();
        $data['api_token'] = Str::random(60);
        $data['password'] = Hash::make($data['password']);

        try {
            User::create($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }

        return response()->json(['success'], 201);
    }

    /**
     * recovery user password
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function recoverPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate(
                $request, [
                'email' => 'required',
            ]
            );
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), 422);
        }

//        some method to recover password, send email or send message to telegram bot

        return response()->json(['success'], 201);
    }
}
