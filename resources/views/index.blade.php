@extends('layouts.app')

@section('content')
	<div class="container">

		<div class="row" style="border: 7px outset #011238;">
			<div class="col-12 my-3">
				<h3>Informaçoes da Instituição</h3>
				<h5><strong>Nome da Instituição:</strong> {{$escola->nome}}</h5>
				<h5><strong>Endereço:</strong> {{$escola->endereco}}</h5>
				<h5><strong>Razão Social:</strong> {{$escola->razao_social}}</h5>
				<h5><strong>Telefone:</strong> {{$escola->telefone}}</h5>
			</div>
			<listar-turmas></listar-turmas>
		</div>
	</div>
@stop
