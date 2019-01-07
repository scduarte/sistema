<?php

use Illuminate\Http\Request;
use App\Turma;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('listar_turmas','SistemaController@mostrarTurmas');
Route::post('cadastrar_turma','SistemaController@cadastrarTurma');
Route::post('apagar_turma','SistemaController@apagarTurma');
Route::post('editar_turma','SistemaController@editarTurma');
Route::post('atualizar_turma','SistemaController@atualizarTurma');

Route::get('listar_alunos/{id}','SistemaController@listarAlunos');
Route::post('cadastrar_aluno','SistemaController@cadastrarAluno');
Route::post('apagar_aluno','SistemaController@apagarAluno');

Route::get('listar_instrutores/{id}','SistemaController@listarInstrutores');
Route::post('apagar_instrutor','SistemaController@apagarInstrutor');
Route::post('apagar_instrutores','SistemaController@apagarInstrutores');
Route::post('cadastrar_instrutor','SistemaController@cadastrarInstrutor');
Route::get('listar_instrutores','SistemaController@listarInstrutoresGeral');

Route::get('listar_cursos','SistemaController@listarCursos');
Route::post('cadastrar_curso','SistemaController@cadastrarCurso');
Route::post('apagar_curso','SistemaController@apagarCurso');






