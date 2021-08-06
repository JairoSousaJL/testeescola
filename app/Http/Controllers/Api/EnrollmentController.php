<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Student;
use App\Team;

class EnrollmentController extends Controller
{
    public function enrollment(StoreEnrollmentRequest $request){

        $team_id = $request->teams_id;
        $student = Student::find($request->students_id);
        $student->teams()->attach($team_id);
        
    }
}
