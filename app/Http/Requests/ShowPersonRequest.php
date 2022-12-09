<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowPersonRequest extends FormRequest
{
    public function rules()
    {
        return [
            'person' => ['required', 'int', 'exists:persons,id'],
        ];
    }
}
