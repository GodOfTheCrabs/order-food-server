<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Google\Client;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $idToken = $request->input('id_token');

        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));

        try {
            $payload = $client->verifyIdToken($idToken);
            if (!$payload) {
                return response()->json(['message' => 'Неверный ID токен'], 401);
            }

            $googleId = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'];

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'first_name' => $name,
                    'google_id' => $googleId,
                    'password' => bcrypt(uniqid()), 
                ]
            );

            Auth::login($user);

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Успешная аутентификация через Google',
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка аутентификации: ' . $e->getMessage()], 500);
        }
    }
}
