<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $userFirstName;
    public $title;
    public $boitierId;
    public $alertBoitierValue;
    public $alertBoitierDate;
    public $boitier;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $userFirstName, $title, $boitierId, $alertBoitierValue, $alertBoitierDate, $boitier)
    {
        $this->userName = $userName;
        $this->userFirstName = $userFirstName;
        $this->title = $title;
        $this->boitierId = $boitierId;
        $this->alertBoitierValue = $alertBoitierValue;
        $this->alertBoitierDate = $alertBoitierDate;
        $this->boitier = $boitier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->from('yan@shenron.fr')
            ->subject('Alert for Boitier '.$this->boitier->noSerie)
            ->view('emails.alertMail')
            ->with([
            'userName' => $this->userName,
            'userFirstName' => $this->userFirstName,
            'title' => $this->title,
            'boitierId' => $this->boitierId,
            'alertBoitierValue' => $this->alertBoitierValue,
            'alertBoitierDate' => $this->alertBoitierDate
        ]);
    }
}
