<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {

        $teacher = Teacher::all();
        return TeacherResource::collection($teacher);

    }

    public function store(StoreTeacherRequest $request)
    {

        try { 
            $teacher = Teacher::create($request->all());
            return response()->json([
                'type' => 'teacher',
                'atributes' => [
                    'name_teacher' =>$teacher->name_teacher,
                ]
            ], 200);
        } catch (\Exception $e) {
            
            return response()->json([
                'status' => 'error 500',
                'message' => 'Não foi possível cadastrar o professor',
                //'error' => $e->getMessage(),
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
