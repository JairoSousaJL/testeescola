<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'student',
            'atributes' => [
                'name_student' =>$this->name_student,
                'email_student' =>$this->email_student,
                'birth_date_student' =>$this->birth_date_student,
            ]
            
        ];
    }
}
