<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  =>'required|string|max:255',
            'email'                 =>'required|string|email|max:255|unique:users',
            'gender'                =>'required',
            'password'              =>'required|string|confirmed',
            'mobile'                =>'required|unique:users',
            'state'                 =>'required',
            'city'                  =>'required',
            'address'               =>'required',
            'avatar'                => 'mimes:jpeg,jpg,png,gif|max:2048',
            'tags'                  => 'array|size:7',
            'categories'            => 'array|size:3',
        ];
    }
}
