<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'type' => 'team',
            'atributes' => [
                'name_team' =>$this->name_team,
                'time_team' =>$this->time_team,
            ]
        ];

    }
}
