<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'authenticate']);
Route::post('/cadastrar/professor', [\App\HTTP\Controllers\Api\TeacherController::class, 'store']);

Route::group(['middleware' => 'apiJWT'], function() {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    //ROUTE STUDENTS
    Route::post('/cadastrar/aluno', [\App\HTTP\Controllers\Api\StudentController::class, 'store']);
    Route::get('/alunos/{id}', [\App\Http\Controllers\Api\StudentController::class, 'index']);
    Route::post('/matricular/aluno', [\App\Http\Controllers\Api\EnrollmentController::class, 'enrollment']);

    //ROUTE SUBJECTS
    Route::post('/cadastrar/disciplina', [\App\HTTP\Controllers\Api\SubjectController::class, 'store']);
    Route::resource('/disciplina', 'Api\SubjectController');
    Route::get('/disciplina/{id}', [\App\Http\Controllers\Api\SubjectController::class, 'show']);
    Route::put('/atualizar/disciplina/{id}', [\App\Http\Controllers\Api\SubjectController::class, 'update']);
    Route::delete('/deletar/disciplina/{id}', [\App\Http\Controllers\Api\SubjectController::class, 'destroy']);

    //ROUTE TEACHERS
    Route::get('/professores', [\App\Http\Controllers\Api\TeacherController::class, 'index']);
    Route::get('/perfil', [\App\Http\Controllers\Api\AuthController::class, 'me']);

    //ROUTE TEAMS
    Route::post('/cadastrar/turma', [\App\HTTP\Controllers\Api\TeamController::class, 'store']);
    Route::get('/turma/{id}', [\App\Http\Controllers\Api\TeamController::class, 'show']);
    Route::get('/turmas', [\App\Http\Controllers\Api\TeamController::class, 'showTeams']);

});

