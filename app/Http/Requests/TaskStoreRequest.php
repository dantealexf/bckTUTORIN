<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category' => 'required',
            'level'    => 'required',
            'tags'        => 'required',
            'title'       => 'required|string|max:255',
            'delivery'    => 'required',
            'price'       => 'required|numeric',
            'body'        => 'required',
            'document'    => 'mimes:doc,docx,pdf,txt|max:2048',
            'photo'       => 'mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}
