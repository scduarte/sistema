<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instrutores_id')->unsigned()->nullable();
            $table->foreign('instrutores_id')->references('id')->on('instrutores')->onDelete('set null');
            $table->integer('cursos_id')->unsigned()->nullable();
            $table->foreign('cursos_id')->references('id')->on('cursos')->onDelete('set null');
            $table->date('data_inicio')->nullable();
            $table->date('data_final')->nullable();
            $table->integer('carga_horaria')->nullable();
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
        Schema::dropIfExists('turmas');
    }
}
