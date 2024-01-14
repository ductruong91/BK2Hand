<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AuthenticateStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                    'success' => false,
                ], 400);
            }
    
            $foundUser = User::where('email', $request->email)
                ->first();
            if (!$foundUser) {
                $foundUser = User::factory()->create([
                    'email'=> $request->email,
                    'password'=> bcrypt('123456'),
                ]);
            }
    
            $randomNumber = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    
            $foundUser->password = bcrypt($randomNumber);
            $foundUser->save();
    
            Mail::to($request->email)->send(new AuthenticateStudent($randomNumber));
    
            return response()->json([
                'success' => true,
                'data' => $foundUser,
            ], 200);
        } catch (Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:6'],
            'email' => ['required', 'string', 'email'],
        ]);

        $user = User::where('email', $request->email)
            ->first();
        
        if (Hash::check($request->code) {
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect()->back()->withErrors([
                'code' => 'Sai mã xác nhận',
            ]);
        }
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:6'],
            'email' => ['required', 'string', 'email'],
        ]);

        $user = User::where('email', $request->email)
            ->first();

        if (Hash::check($request->code, $user->password)) {
            return response()->json(true, 200);
        }
        else {
            return response()->json([
                'message' => 'Sai mã xác nhận',
            ], 400);
        }
    }
}
