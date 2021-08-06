<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name_team',
        'time_team',
        'subject_id',
        'teacher_id',
    ];

    public function subjects()
    {
        return $this->belongsTo(Subjects::class, 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'teams_students', 'teams_id', 'students_id',);
    }

}
