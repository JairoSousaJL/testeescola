<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Resources\TeamResource;
use App\Teacher;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    public function index()
    {

        $team = Team::all();
        return TeamResource::collection($team);

    }

    public function store(StoreTeamRequest $request)
    {
        $name_team = $request->name_team;
        $time = $request->time_team;
        $teacher  = Auth::user()->id;

        $time_exist = DB::table('teams')
                    ->where('name_team', '=', $name_team)
                    ->where('time_team', '=', $time)
                    ->first();
        
        $teacher_exist = DB::table('teams')
                    ->where('time_team', '=', $time)
                    ->where('teacher_id', '=', $teacher)
                    ->first();
        
        if($time_exist){

            return response()->json([
                'status' => 'error',
                'message' => 'Horario indisponivel nessa turma',
            ], 500);

        }elseif ($teacher_exist) {

            return response()->json([
                'status' => 'error',
                'message' => 'Professor ministra aula nesse horario',
            ], 500);

        }else{

            try {
                
                $team = Team::create([
                    'name_team' => $request->name_team,
                    'time_team' => $request->time_team,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $teacher,
                ]);
                return response()->json([
                    'type' => 'team',
                    'atributes' => [
                        'name_team' =>$team->name_team,
                        'time_team' =>$team->time_team,
                    ]
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error 500',
                    'message' => 'Não foi possível cadastrar a turma',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
    }

    public function show($id)
    {

        try {
            $id_teacher = Auth::user()->id;
            $id_team = $id;

            $my_teams = DB::table('teams')
            ->join('subjects', 'teams.subject_id', '=', 'subjects.id')
            ->join('teachers', 'teams.teacher_id', '=', 'teachers.id')
            ->where('teams.teacher_id', '=', $id_teacher)
            ->where('teams.id', '=', $id_team)
            ->select('subjects.name_subject', 'teams.name_team', 'teams.time_team', 'teachers.name_teacher')
            ->first();

            if($my_teams){
                return response()->json($my_teams);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Não foi possível encontrar turma com essa identificacao',
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

    public function showTeams()
    {
        
        try {
            $id_teacher = Auth::user()->id;

            $my_teams = DB::table('teams')
            ->join('subjects', 'teams.subject_id', '=', 'subjects.id')
            ->join('teachers', 'teams.teacher_id', '=', 'teachers.id')
            ->where('teams.teacher_id', '=', $id_teacher)
            ->select('subjects.name_subject', 'teams.name_team', 'teams.time_team', 'teachers.name_teacher')
            ->get();

            return response()->json($my_teams);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível mostrar as turmas',
                'error' => $e->getMessage(),
            ], 500);
        }
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
