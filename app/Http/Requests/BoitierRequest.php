<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoitierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

                'noSerie' => ['required', 'max:255'],
                'dateActivation' => ['required', 'date', 'max:255'],
                'firstConnect' => ['required', 'date' , 'max:255'],
                'lastUpdate' => ['required', 'date' , 'max:255'],
                'lastMoved' => ['required', 'date' , 'max:255'],
                'ConnectionTimeLimit' => ['required', 'integer' , 'max:255'],
                'versionSoftware' => ['required', 'max:255'],
                'language' => ['required', 'max:255'],
                'comment' => ['required', 'max:255'],
                'state' => ['required', 'max:255'],
                'isOpen' => ['required', 'max:255'],
                'phModule' => ['required', 'max:255'],
                'hasGsm' => ['required', 'max:255'],
                'user_id' => ['required', 'max:255'],
        ];
    }
}
