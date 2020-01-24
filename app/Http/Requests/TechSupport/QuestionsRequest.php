<?php

namespace App\Http\Requests\TechSupport;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'subject' => 'required',
            'email' => 'required|email',
            'text' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Обязательно должна быть указана тема вопроса',
            'email.required' => 'Для получения обратной связи обязательно должен быть указан e-amil',
            'email.email' => 'Указан невалидный e-mail',
            'text.required' => 'Тест вопроса не может быть пустым'
        ];
    }
}
