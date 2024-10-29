<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
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
                $clearPassword  = Str::random(12);
                $user->password  = bcrypt($clearPassword);
            }

            $userName = $user->name;
            $userFirstName = $user->firstname;

            // $user->save();
            $subject = "Your Password";
            $message = "Your Password is :";

            Mail::to($user->email)->send(new GeneratedPasswordMail($subject, $message, $clearPassword, $userName, $userFirstName));
        });
    }
}
