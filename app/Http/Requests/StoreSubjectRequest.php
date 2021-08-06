<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'name_subject' => 'required',
            'description_subject' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name_subject.required' => 'O nome da disciplina e obrigatorio',
            'description_subject.required' => 'A descrição da disciplina e obrigatoria',
        ];
        
    }
}
