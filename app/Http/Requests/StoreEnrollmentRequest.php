<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
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
            'teams_id' => 'required',
            'students_id' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'teams_id.required' => 'O nome(id) da turma e obrigatorio',
            'students_id.required' => 'O nome(id) do aluno e obrigatorio',
        ];
        
    }
}
