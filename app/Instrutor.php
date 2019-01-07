<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    protected $fillable = [
        'nome', 
        'email', 
        'valor_hora',
        'certificados'
    ];

    protected $table = 'instrutores';

    public function turma()
  	{
    	return $this->hasMany(Turma::class, 'instrutores_id');
  	}
}
