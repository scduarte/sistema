<template>
	<div id="novoInstrutor" class="modal fade" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content" style="border-radius: 0px;background-color: #022b38">
	      <div class="modal-header" style="background-color: #022b38;color: white;border: none;">
	        <h5 class="modal-title ml-auto mr-auto"><strong>Cadastrar novo Instrutor</strong></h5>
	      </div>
	      <div class="modal-body" style="border: 15px solid #022b38;border-top: none;background-color: white;">
	        <p v-if="errors.length" class="c-erros">
	          <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
	          <ul>
	            <li v-for="error in errors">{{error}}</li>
	          </ul>
	        </p>
	      <form action="./api/cadastrar_instrutor" method="POST" @submit.prevent="cadastrarInstrutor">
	      <p>
	        <strong>Nome:</strong>
	        <span><input v-model="nome" class="input form-control"></input></span>
	      </p>
	      
	      <p>
	        <strong>E-mail:</strong> 
	        <span><input v-model="email" class="input form-control"></span>
	      </p>

	      <p>
	        <strong>Valor da hora:</strong> 
	        <span><input v-model="valor_hora" class="input form-control"></span>
	      </p>
	      
	      <p>
	        <strong>Certificados:</strong> 
	        <span><input v-model="certificados" class="input form-control"></span>
	      </p>

	      <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button>
	      <button @click="limparDados" type="button" class="btn btn-primary btn-sm pull-right mr-2" data-dismiss="modal">Sair</button>
	      </form>

	      </div>
	    </div>
	  </div>
	</div>
</template>

<style>
.c-erros {
  color: red;
}
</style>

<script>
	export default {
		props:['turma'],
		data(){
			return {
				nome:null,
				email:null,
				valor_hora:null,
				certificados:null,
				errors:[]
			}
		},
		methods:{
			limparDados(){
		        this.nome = ""
		        this.email = ""
		        this.valor_hora = ""
		        this.certificados = ""
		        this.erros = []
			},

			cadastrarInstrutor(){
				if (this.nome && 
					this.email && 
					this.valor_hora &&
					this.certificados) {
		          axios
		              .post('./api/cadastrar_instrutor', {
		                nome: this.nome,
		                email: this.email,
		                valor_hora: this.valor_hora,
		                certificados: this.certificados
		                //cod_turma: this.turma
		              })
		              .then(response => {
		                this.$emit('cadastroOk',response.data)
		                $('#novoInstrutor').modal('hide')
		                this.limparDados()
		              })    
		        }

		        this.errors = [];

		        if (!this.nome) {
		          this.errors.push('Prencha o campo Nome.');
		        }
		        if (!this.email) {
		          this.errors.push('Prencha o campo E-mail.');
		        }
		        if (!this.valor_hora) {
		          this.errors.push('Prencha o campo Valor da hora.');
		        }
		        if (!this.certificados) {
		          this.errors.push('Prencha o campo Certificados.');
		        }
		        return;
				
			}
		}
	}
</script>