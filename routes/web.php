<?php
use App\Turma;
use App\Curso;
use App\Instrutor;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $turma = Turma::all();
    $escola = DB::table('escola')->first();

    return view('index',compact('turma','escola'));
})->middleware('auth');

Route::get('dados',function(){
	$cursos = Curso::all();
	$instrutores = Instrutor::all();

	$dados = [$cursos,$instrutores];
	return response()->json($dados);
});

Auth::routes();

