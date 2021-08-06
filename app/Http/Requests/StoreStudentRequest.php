<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name_student' => 'required',
            'email_student' => 'required|email|unique:students,email_student',
            'birth_date_student' => 'required|date_format:"d/m/Y"',
        ];
    }

    public function messages()
    {
        return[
            'name_student.required' => 'O nome do aluno e obrigatorio',
            'email_student.required' => 'O email do aluno e obrigatorio',
            'email_student.email' => 'email invalido',
            'email_student.unique' => 'email ja esta cadastrado',
            'birth_date_student.required' => 'A Data de Nascimento do aluno e obrigatoria',
            'birth_date_student.date_format' => 'Formato da data incorreto. Exemplo: 00/00/0000',
        ];
        
    }
}
