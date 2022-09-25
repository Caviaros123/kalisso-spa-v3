<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';

        return [
            'email' => $emailValidation,
            'name' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Vous avez deja un compte avec cette adresse email. S\'il vous plaît <a class="btn btn-primary" href="/login">Connectez vous </a> pour continuer.',
        ];
    }
}
