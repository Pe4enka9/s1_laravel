<?php

namespace App\Http\Requests;

class BookingRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => ['nullable', 'string', 'min:18'],
            'date' => ['required', 'date'],
            'duration' => ['required', 'integer', 'min:1'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.string' => 'Поле должно быть строкой',
            '*.integer' => 'Поле должно быть числом',
            '*.date' => 'Поле должно быть датой',
            '*.max' => 'Максимальная длина поля :max символов',
            'phone_number.min' => 'Минимальная длина поля :min символов',
            'duration.min' => 'Минимальная длина поля :min символ',
            'number_of_people.min' => 'Минимальная длина поля :min символ',
        ];
    }
}
