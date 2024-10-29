<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\AlertBoitier;
use App\Mail\AlertMail;
use App\Models\Boitier;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendAlerts($id)
    {
        // retrieve the alert boitier by id
        $alertBoitier = AlertBoitier::find($id);
        
        // check if the mail should be sent
        if ($alertBoitier->alertBoitierList->mailed == 1 && $alertBoitier->sended == 0) {
            $boitier = $alertBoitier->boitier;
            $user = $boitier->user;
            $title = $alertBoitier->alertBoitierList->title;
            $userName = $user->name;
            $userFirstName = $user->firstname;
            $boitierId = $boitier->id;
            $alertBoitierValue = $alertBoitier->value;
            $alertBoitierDate = $alertBoitier->datetime;

            // Update the sended to 1
            $alertBoitier->sended = 1;
            $alertBoitier->save();

            // Split the mail_alerte field into an array of email addresses
            $emails = explode(',', $boitier->mail_alerte);

            // Send an email to each address
            foreach ($emails as $email) {
                Mail::to(trim($email))->send(new AlertMail($userName, $userFirstName, $title, $boitierId, $alertBoitierValue, $alertBoitierDate, $boitier));
            }
        }
    }
}
