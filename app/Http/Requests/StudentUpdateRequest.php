<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        /*return [
            'name'                  =>'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,'. $this->request->get('email'),
            'gender'                =>'required',
            'password'              =>'required|string|confirmed',
            'mobile'                =>'required|unique:users,mobile,' . $this->request->get('mobile'),
            'state'                 =>'required',
            'city'                  =>'required',
            'address'               =>'required',
        ];*/


    }
}
