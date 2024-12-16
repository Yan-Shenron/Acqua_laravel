<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;
use App\Models\ForgotPassword;
// use Illuminate\Support\Str;
use App\Mail\GeneratedPasswordMail;
use App\Models\User;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        User::creating(function($user){
            if($user->password === "" || empty($user->password)){
                $clearPassword  = strtolower($user->name);
                # $clearPassword = bcrypt(strtolower($user->name)); A faire en production
                $user->password  = bcrypt($clearPassword);
            }


        $userName = $user->name;
        $userFirstname = $user->firstname;

        $email = $user->email;
        $code = Str::random(8);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://acquagest-api.acquaprocess.eu/api/forgot-password");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'email' => $email,
            'code' => $code
        ]));

        $response = curl_exec($ch);
        curl_close($ch);

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

            // $userName = $user->name;
            // $userFirstName = $user->firstname;

            // // $user->save();
            // $subject = "Your Password";
            // $message = "Your Password is :";

            // Mail::to($user->email)->send(new GeneratedPasswordMail($subject, $message, $clearPassword, $userName, $userFirstName));
        });
    }
}
