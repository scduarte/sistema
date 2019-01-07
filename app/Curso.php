<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nome', 
        'requisito', 
        'carga_horaria',
        'preco'
    ];

    protected $table = 'cursos';

    public function turma()
  	{
    	return $this->hasMany(Turma::class, 'cursos_id');
  	}
}
