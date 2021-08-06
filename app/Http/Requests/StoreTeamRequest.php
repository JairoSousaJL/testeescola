<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'name_team' => 'required',
            'time_team' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return[
            'name_team.required' => 'O nome da turma e obrigatorio',
            'time_team.required' => 'O horario da turma e obrigatorio',
            'time_team.date_format' => 'Formato incorreto do horario',
            
        ];
        
    }
}
