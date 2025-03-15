<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Log;
use Storage;

class AuthController extends Controller
{

    public function login(Request $request) {
        
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required', 
        ]);
    

        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Невірний логін або пароль'], 401);
        }
    

        $user = User::where('email', $request->email)->first();    

        return response()->json([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function register(Request $request) {
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users,email', 
            'phone' => 'required|string|unique:users,phone', 
            'password' => 'required|string|min:6|confirmed', 
            'gender' => 'required|string|in:male,female', 
        ]);
    
        
        $validated['password'] = bcrypt($validated['password']);
    
        
        $user = User::create([
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => $validated['password'],
            'gender' => $validated['gender'],
        ]);
    
        
        $token = $user->createToken('API Token')->plainTextToken;
    
        
        return response()->json([
            'token' => $token
        ]);
    }

    public function update(UserUpdateRequest $request) {
        
        $user = auth()->user();

        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos');
            $user->photo = $path;
        }

        $user->update($validatedData);
    
        return response()->json([
            'message' => 'Profile updated successfully',
        ], 201);
    }

    public function updatePhoto(Request $request) {

        $request->validate([
            'photo' => 'nullable|file|max:4096', 
        ]);
        $file = $request->has('photo');
        // $user = auth()->user();

        // if ($request->hasFile('photo')) {
            
        //     $path = $request->file('photo')->store('photos');
    
           
        //     $user->photo = $path;
        // }
        // $user->update($request->except('photo'));

        return response()->json([
            'message' => $file,
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Вы успешно вышли из системы.'
        ]);
    }
}
