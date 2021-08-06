<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
        return [
            'name_teacher' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name_teacher.required' => 'O nome do professor e obrigatorio',
            'email.required' => 'O email e obrigatorio',
            'email.email' => 'email invalido',
            'email.unique' => 'email ja esta cadastrado',
            'password.required' => 'A SENHA e obrigatoria',
        ];
        
    }
}
