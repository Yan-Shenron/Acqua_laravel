<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;
use App\Models\User;
use App\Models\ForgotPassword;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'This email is not registered in our system.'], 404);
        }
        
        $userName = $user->name;
        $userFirstname = $user->firstname;

        $email = $request->email;
        $code = Str::random(8);

        $forgotPassword = ForgotPassword::where('email', $email)->first();
        if ($forgotPassword) {
            $forgotPassword->code = $code;
            $forgotPassword->save();
        } else {
            ForgotPassword::create([
                'email' => $email,
                'code' => $code,
            ]);
        }

        Mail::to($email)->send(new ForgotMail($userName, $userFirstname, $code));

        return response()->json(['message' => 'Reset code has been sent to your email!']);
    }
 
    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $forgot = ForgotPassword::where('code', $request->code)->first();
        $email = $forgot->email;
        if (!$forgot) {
            return response()->json(['message' => 'Code is not registered in our system'], 404);
        }

        $user = User::where('email', $email)->first();

        // Update the user's password
        $encryption = bcrypt($request->password);
        $user->password = $encryption;
        $user->password_changed = true;
        $user->save();

        return response()->json([
            'message' => $request->password,
        ]);
    }
}