<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (empty($email) or empty($password))
            return response()->json(['success' => false, 'message' => 'you should pass required parameters']);

        $client = new Client();
        try {
            $response = $client->post(config('service.passport.login_endpoint'), [
                "form_params" => [
                    "client_secret" => config('service.passport.client_secret'),
                    "grant_type" => "password",
                    "client_id" => config('service.passport.client_id'),
                    "username" => $email,
                    "password" => $password
                ]
            ]);
            if ($response->getStatusCode() == 200) {
                return response()->json(['success' => true, 'message' => json_decode($response->getBody())],200);
            } else {
                return response()->json(['success' => false, 'message' => json_decode($response->getBody())], 400);
            }
        } catch (BadRequestException $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        // check if empty
        if (empty($name) or empty($email) or empty($password)) {
            return response()->json(['success' => false, 'message' => 'You must fill all the fields'], 400);
        }

        // check email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'message' => 'You must enter valid email'], 400);
        }

        // check if password is less than 5 characters
        if (strlen($password) < 5) {
            return response()->json(['success' => false, 'message' => 'Password must be greater than five character'], 422);
        }

        // check if email already exists
        if (User::where('email', $email)->exists()) {
            return response()->json(['success' => false, 'message' => 'Email address already found'], 400);
        }

        // create new user
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            if ($user->wasRecentlyCreated) {
                return $this->login($request);
            } else {
                return response()->json(['success' => false, 'message' => 'User already found'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 400);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::user()->tokens->each(function ($token) {
                $token->delete();
            });
            return response()->json(['success' => true, 'message' => 'Loggout successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 400);
        }
    }
}
