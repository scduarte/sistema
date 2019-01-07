<?php

namespace App\Http\Controllers;
use App\Turma;
use App\Matricula;
use App\Aluno;
use App\Instrutor;
use App\Curso;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SistemaController extends Controller
{

//============= TURMAS ========================================//
    public function cadastrarTurma(Request $request){
    	
    	$curso = Curso::where('id',$request->curso)->first();

	    	 	Turma::create([
			    		'cursos_id' 	 => $request->curso,
			    		'instrutores_id' => $request->instrutor,
			    		'data_inicio' 	 => date('Y-m-d', strtotime($request->data_ini)),
			    		'data_final'	 => date('Y-m-d', strtotime($request->data_fim)),
			    		'carga_horaria'  => $curso->carga_horaria
			    	]);

    }

    public function mostrarTurmas(){
    	
    	$turmas = DB::table('turmas')
    	->join('cursos', 'turmas.cursos_id', '=', 'cursos.id')
    	->select('turmas.*', 'cursos.nome','cursos.carga_horaria')
    	->orderBy('id','asc')
    	->paginate(8);

		return response()->json($turmas);
    }

    public function editarTurma(Request $request){
    	$turma = Turma::where('id',$request->id)->first();
    	$turma['data_inicio'] = date('d-m-Y', strtotime($turma->data_inicio));
    	$turma['data_final'] = date('d-m-Y', strtotime($turma->data_final));

    	$instrutores = Instrutor::all();
    	$cursos = Curso::all();

    	$dados = [$turma,$instrutores,$cursos];
		return response()->json($dados);
    }

    public function atualizarTurma(Request $request){
    	$curso = Curso::where('id',$request->curso)->first();
	 	Turma::where('id',$request->turma_id)->update([
    		'cursos_id' 	 => $request->curso,
    		'instrutores_id' => $request->instrutor,
    		'data_inicio' 	 => date('Y-m-d', strtotime($request->data_ini)),
    		'data_final'	 => date('Y-m-d', strtotime($request->data_fim)),
    		'carga_horaria'  => $curso->carga_horaria
    	]);

    }

    public function apagarTurma(Request $request){
    	Turma::where('id',$request->id)->delete();

    	$turmas = DB::table('turmas')
    	->join('cursos', 'turmas.cursos_id', '=', 'cursos.id')
    	->select('turmas.*', 'cursos.nome','cursos.carga_horaria')
    	->orderBy('id','asc')
    	->paginate(8);

		return response()->json($turmas);
    }
//============= TURMAS ========================================//

//============= ALUNOS ========================================//
    public function cadastrarAluno(Request $request){
    $aluno = Aluno::create([
    		'cpf' => $request->cpf,
    		'nome' => $request->nome,
    		'email' => $request->email,
    		'fone' => $request->telefone,
    		'data_nascimento' => date('Y-m-d', strtotime($request->data_nascimento))
    	]);

    	Matricula::create([
    		'turmas_id' => $request->cod_turma,
    		'alunos_id' => $aluno->id,
    		'data_matricula' => date('Y-m-d')
    	]);

    	return response()->json($request->cod_turma);
    }

    public function listarAlunos($id){
    	$alunos = DB::table('matriculas')
    	->join('alunos','matriculas.alunos_id','=','alunos.id')
    	->where('matriculas.turmas_id',$id)
    	->select('alunos.*','matriculas.turmas_id')
    	->paginate(8);

    	return response()->json($alunos);
    }

    public function apagarAluno(Request $request){
    	Aluno::where('id',$request->id)->delete();

    	return response()->json($request->cod_turma);
    }
//============= ALUNOS ========================================//

//============= INSTRUTORES ========================================//
    public function listarInstrutores($id){
    	$instrutores = DB::table('turmas')
    	->join('instrutores','turmas.instrutores_id','=','instrutores.id')
    	->where('turmas.id',$id)
    	->select('instrutores.*')
    	->get();

    	return response()->json($instrutores);
    }

    public function apagarInstrutor(Request $request){
    	Turma::where('id',$request->cod_turma)->update(['instrutores_id' => null]);

    	return response()->json($request->cod_turma);
    }

    public function cadastrarInstrutor(Request $request){
    $instrutor = Instrutor::create([
    		'nome'       => $request->nome,
    		'email'      => $request->email,
    		'valor_hora' => $request->valor_hora,
    		'certificados'  => $request->certificados,
    	]);

    	return response()->json($request->cod_turma);
    }

    public function listarInstrutoresGeral(){
    	$instrutores = Instrutor::paginate(8);

    	return response()->json($instrutores);
    }

    public function apagarInstrutores(Request $request){
    	Instrutor::where('id',$request->id)->delete();
    }

    
//============= INSTRUTORES ========================================//

    public function listarCursos(){
    	$cursos = Curso::paginate(8);

    	return response()->json($cursos);
    }

    public function cadastrarCurso(Request $request){
    	
	 	Curso::create([
    		'nome' 	 => $request->nome,
    		'requisito' => $request->requisito,
    		'carga_horaria' => $request->carga_horaria,
    		'preco'	 => $request->preco
    	]);

    }

    public function apagarCurso(Request $request){
    	Curso::where('id',$request->id)->delete();
    }

}
