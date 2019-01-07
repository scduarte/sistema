<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = [
        'instrutores_id', 
        'cursos_id', 
        'data_inicio',
        'data_final',
        'carga_horaria'
    ];

    protected $table = 'turmas';

    public function instrutor()
  	{
    	return $this->belongsTo(Instrutor::class, 'instrutores_id');
  	}

  	public function curso()
  	{
    	return $this->belongsTo(Curso::class, 'cursos_id');
  	}

  	public function matricula()
  	{
    	return $this->hasMany(Matricula::class, 'turmas_id');
  	}

}
