<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRegister extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|max:20|unique:users',
            'name' => 'required',
            'email_address' => 'required|unique:users_profiles',
            'phonenumber' => 'required|min:11',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ];
    }
}