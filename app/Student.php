<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $table = 'students';

    protected $fillable = [
        'name_student',
        'email_student',
        'birth_date_student',
    ];

    
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'teams_students', 'students_id', 'teams_id');
    }
}
