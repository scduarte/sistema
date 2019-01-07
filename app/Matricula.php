<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'turmas_id', 
        'alunos_id', 
        'data_matricula'
    ];

    protected $table = 'matriculas';

    public function turma()
  	{
    	return $this->belongsTo(Turma::class, 'turmas_id');
  	}

  	public function aluno()
  	{
    	return $this->belongsTo(Aluno::class, 'alunos_id');
  	}
}
