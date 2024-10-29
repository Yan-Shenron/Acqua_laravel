<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $userFirstName;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $userFirstName, $code)
    {
        $this->userName = $userName;
        $this->userFirstName = $userFirstName;
        $this->code = $code;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->from(config('mail.username'))
            ->subject('Lien de réinitialisation de mot de passe')
            ->view('emails.forgotpassword')
            ->with([
            'userName' => $this->userName,
            'userFirstName' => $this->userFirstName,
            'code' => $this->code
        ]);
    }
}
