<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turmas_id')->unsigned()->nullable();
            $table->foreign('turmas_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->integer('alunos_id')->unsigned()->nullable();
            $table->foreign('alunos_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->date('data_matricula')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
