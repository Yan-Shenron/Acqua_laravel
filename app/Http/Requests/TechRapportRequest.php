<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechRapportRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

                'maintenanceDate' => ['required', 'date' , 'max:255'],
                'time' => ['required', 'max:255'],
                'type' => ['required', 'date' , 'max:255'],
                'comment' => ['required', 'date'],
        ];
    }
}