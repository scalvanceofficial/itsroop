<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $request->validate([
            'mobile' => 'required|numeric|digits:10',
        ]);

        $is_production = env('APP_ENV') === 'production';
        $otp = $is_production ? rand(1000, 9999) : 1234;

        $user = User::updateOrCreate(
            ['mobile' => $request->mobile],
            ['password' => Hash::make($otp)]
        );

        if ($is_production) {
            $message_id = $user->wasRecentlyCreated ? 184302 : 184301;
            send_sms($user->mobile, $otp, $message_id);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully.',
            'mobile' => $user->mobile
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:4'
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 400);
        }

        if (Hash::check($request->otp, $user->password)) {

            if ($user->is_registered == 1) {
                Auth::login($user);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully.',
                'is_registered' => $user->is_registered,
                'user_id' => $user->id
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid OTP'
        ], 400);
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email'
        ]);

        $user = User::find($request->user_id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'is_registered' => 1
        ]);

        $data = [
            'subject' => 'Welcome to ' . config('app.name'),
            'name' => $user->full_name,
            'email' => $user->email,
        ];

        EmailService::sendEmail($user->email, 'emails.registration', $data);

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Registered successfully.',
        ]);
    }
}
