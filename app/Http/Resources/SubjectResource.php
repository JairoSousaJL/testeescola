<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'type' => 'subject',
            'atributes' => [
                'name_subject' =>$this->name_subject,
                'description_subject' =>$this->description_subject,
            ]
            
        ];

    }
}
