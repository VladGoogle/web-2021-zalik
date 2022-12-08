<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    public function rules()
    {
        return [
            'person' => ['required', 'int', 'exists:persons,id'],
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
        ];
    }
}
