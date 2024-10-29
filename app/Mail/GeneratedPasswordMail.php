<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneratedPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $clearPassword;
    public $userName;
    public $userFirstName;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $clearPassword, $userName, $userFirstName)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->clearPassword = $clearPassword;
        $this->userName = $userName;
        $this->userFirstName = $userFirstName;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.initPasswordMail')
                    ->with([
                        'clearPassword' => $this->clearPassword,
                        'userName' => $this->userName,
                        'userFirstName' => $this->userFirstName,
                    ]);
    }
}
