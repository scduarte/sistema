<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'cpf', 
        'nome', 
        'email',
        'fone',
        'data_nascimento'
    ];

    protected $table = 'alunos';

    public function matricula()
  	{
    	return $this->hasMany(Matricula::class, 'alunos_id');
  	}
}
