<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index($id)
    {
        $id_team = $id;

        try {
            
            $student = DB::table('teams_students')
            ->join('students', 'teams_students.students_id', '=','students.id')
            ->join('teams', 'teams_students.teams_id', '=', 'teams.id')
            ->join('teachers', 'teams.teacher_id', '=', 'teachers.id')
            ->where('teams.id', '=', $id_team)
            ->select('students.name_student', 'teams.name_team', 'teams.time_team','teachers.name_teacher')
            ->get();
 
            if($student){
                return response()->json($student);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Não foi possível encontrar os alunos',
                ], 500);
            }

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível mostra a turma',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    
    public function store(StoreStudentRequest $request)
    {
        $birth_date = str_replace("/", "-", $request->birth_date_student);
        $birth_date = date('Y-m-d', strtotime($birth_date));

        try {

            $student = Student::create([
                'name_student' => $request->name_student,
                'email_student' => $request->email_student,
                'birth_date_student' => $birth_date,
            ]);
            return response()->json([
                'type' => 'student',
                'atributes' => [
                    'name_student' => $student->name_subject,
                    'email_student' => $student->email_student,
                    'birth_date_student' => $student->birth_date_student,
                ]
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível cadastrar o aluno',
                'error' => $e->getMessage(),
            ], 500);

        }
    }

  
    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
