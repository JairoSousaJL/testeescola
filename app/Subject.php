<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'name_subject',
        'description_subject',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'subjects_id', 'id');
    }
}
