<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Notifications\ContactStudents;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{

    public function index($id)
    {
        $id_team = $id;
        $teacher  = Auth::user()->id;

        try {
            
            $student = DB::table('teams_students')
            ->join('students', 'teams_students.students_id', '=','students.id')
            ->join('teams', 'teams_students.teams_id', '=', 'teams.id')
            ->join('teachers', 'teams.teacher_id', '=', 'teachers.id')
            ->where('teams.id', '=', $id_team)
            ->where('teams.teacher_id', '=', $teacher)
            ->select('students.name_student', 'teams.name_team', 'teams.time_team','teachers.name_teacher')
            ->get();
 
            if($student->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Não foi possível encontrar os alunos',
                ]);
                
            }else{
                return new StudentResource($student);
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

        echo $request->name_student;

        try {

            $student = Student::create([
                'name_student' => $request->name_student,
                'email_student' => $request->email_student,
                'birth_date_student' => $birth_date,
            ]);

            //Mail::to($request->email_student)->send(new ContactStudent);

            Notification::route('mail', $request->email_student)
                        ->notify(new ContactStudents($student));

            return new StudentResource($student);

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


    public function destroy(Request $request)
    {
        
        try {

            $student = Student::where('id', $request->id)->delete();
            if ($student) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Aluno Excluido',
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Aluno não encontrado',
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível excluir o aluno',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
