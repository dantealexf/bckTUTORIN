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
        $rules = [
            'name'                  =>'required|string|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore( $this->route('user')->id )
            ],
            'gender'                => 'required',
            'mobile' => [
                'required',
                Rule::unique('users')->ignore( $this->route('user')->id )
            ],
            'state'                 => 'required',
            'city'                  => 'required',
            'address'               => 'required',
            'avatar'                 => 'mimes:jpeg,jpg,png,gif|max:2048',
            'tags'                  => 'array|max:7',
            'categories'            => 'array|max:3',
        ];

        if ($this->filled('password'))
        {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        return $rules;
    }
}
