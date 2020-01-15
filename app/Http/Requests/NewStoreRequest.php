<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('GET')) {
            return [];
        }

        return [
            'name' => 'required|max:255',
            'slug' => 'required|unique:stores|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название магазина обязательно для заполнения',
            'name.max' => 'Максимальная длина названия :max',
            'slug.required' => 'Символьный код обязателен для заполнения',
            'slug.max' => 'Максимальная дилина символьного кода',
            'slug.unique' => 'Символьный код должен быть уникальным',
        ];
    }
}
