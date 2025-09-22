<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;

class LoginRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'string', 'min:18'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.string' => 'Поле должно быть строкой',
            '*.min' => 'Минимальная длина поля :min символов',
        ];
    }
}
