<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'string', 'min:18', Rule::unique(User::class, 'phone_number')],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.string' => 'Поле должно быть строкой',
            '*.min' => 'Минимальная длина поля :min символов',
            'phone_number.unique' => 'Такой номер телефона уже существует',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
