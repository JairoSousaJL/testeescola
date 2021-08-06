<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Student;
use App\Team;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function enrollment(StoreEnrollmentRequest $request)
    {
        
        $team_id = $request->teams_id;
        $student_id = $request->students_id;

        try {
            $student = Student::find($student_id);
            $team = Team::find($team_id);

            $search_enrollment = DB::table('teams')
            ->join('teams_students', 'teams.id', '=', 'teams_id')
            ->join('students', 'students.id', '=', 'students_id')
            ->where('students.name_student', '=', $student->name_student)
            ->where('teams.time_team', '=', $team->time_team)
            ->select('students.name_student', 'teams.time_team')
            ->get();

            if ($search_enrollment->isEmpty()) {
                $student->teams()->attach($team_id);
                return response()->json([
                    'status' => 'OK',
                    'message' => 'Matricula realizada com sucesso',
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Aluno ja matriculado nesse horario',
                ]);
            }

            //return response()->json($search_enrollment);

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível realizar a matricula',
                'error' => $e->getMessage(),
            ], 500);
        }            

        /*try {
            
            $student->teams()->attach($team_id);
            return response()->json([
                'status' => 'OK',
                'message' => 'Matricula realizada com sucesso',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível realizar a matricula',
                'error' => $e->getMessage(),
            ], 500);
        }*/
        
    }
}
