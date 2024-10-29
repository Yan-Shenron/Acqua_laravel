<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        // dd($this->request->all());

        return [
            'name' => ['required', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'max:255'],
            // 'password_confirmed' => ['required', 'same:password'],
            'phone1' => ['required', 'max:255'],
            'phone2' => ['max:255'],
            'markerLat' => ['required'],
            'markerLng' => ['required'],
            'address' => ['required', 'max:255'],
            'postcode' => ['max:255'],
            'city' => ['max:255'],
            'country' => ['max:255'],
            'company' => ['max:255'],
            'website' => ['max:255'],
            'siret' => ['max:255'],
            'tva' => ['max:255'],
            'state' => ['max:255'],
            'maintenance' => ['max:255'],
            'comment' => ['max:25500'],
            'role_id' => ['required', 'max:255'],
            'user_id' => ['max:255'],
        ];
    }
}