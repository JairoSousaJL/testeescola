<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Subset;

class SubjectController extends Controller
{

    public function index()
    {

        $subject = Subject::all();
        return SubjectResource::collection($subject);

    }

    public function store(StoreSubjectRequest $request)
    {
        
        try {
            $subject = Subject::create($request->all());
            return response()->json([
                'type' => 'subject',
                'atributes' => [
                    'name_subject' => $subject->name_subject,
                    'description_subject' => $subject->description_subject,
                ]
            ], 200);
        } catch (\Exception $e) {
            
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível cadastrar a disciplina!.',
                //'error' => $e->getMessage(),
            ], 500);

        }
    }

    public function show($id)
    {
        $subject = Subject::findOrFail($id);

        if ($subject) {
            return new SubjectResource($subject);
        }else{
            return response()->json([
                    'message' => 'Disciplina não encontrada', 404
                ]
            );
        }
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->name = $request->name;
        $subject->description = $request->description;

        try {
            $subject->save();
            return response()->json($subject, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível atualizar a disciplina!.',
                //'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        if ($subject) {
            $subject->delete();
            return response()->json([
                    'message' => 'Disciplina Deletada', 200
                ]
            );
        }else{
            return response()->json([
                    'message' => 'Disciplina não encontrada', 404
                ]
            );
        }
    }
}
