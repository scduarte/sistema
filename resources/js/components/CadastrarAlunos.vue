<template>
	<div id="novoAluno" class="modal fade" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content" style="border-radius: 0px;background-color: #022b38">
	      <div class="modal-header" style="background-color: #022b38;color: white;border: none;">
	        <h5 class="modal-title ml-auto mr-auto"><strong>Cadastrar Aluno na Turma</strong></h5>
	      </div>
	      <div class="modal-body" style="border: 15px solid #022b38;border-top: none;background-color: white;">
	        <p v-if="errors.length" class="c-erros">
	          <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
	          <ul>
	            <li v-for="error in errors">{{error}}</li>
	          </ul>
	        </p>
	      <form action="./api/cadastrar_aluno" method="POST" @submit.prevent="cadastrarAluno">
	      <p>
	        <strong>CPF:</strong>
	        <span><input-mask v-model="cpf" mask="###.###.###-##" masked class="input form-control"></input-mask></span>
	      </p>
	      
	      <p>
	        <strong>Nome:</strong> 
	        <span><input v-model="nome" class="input form-control"></span>
	      </p>

	      <p>
	        <strong>E-mail:</strong> 
	        <span><input v-model="email" class="input form-control"></span>
	      </p>
	      
	      <p>
	        <strong>Telefone:</strong> 
	        <span><input-mask v-model="telefone" mask="(##)#####-####" masked class="input form-control"></input-mask></span>
	      </p>

	      <p>
	        <strong>Data de Nascimento:</strong> 
	        <span><input-mask v-model="data_nascimento" mask="##-##-####" masked class="input form-control"></input-mask></span>
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
				cpf:null,
				nome:null,
				email:null,
				telefone:null,
				data_nascimento:null,
				errors:[]
			}
		},
		methods:{
			limparDados(){
				this.cpf = ""
		        this.nome = ""
		        this.email = ""
		        this.telefone = ""
		        this.data_nascimento = ""
		        this.erros = []
			},

			cadastrarAluno(){
				if (this.cpf && 
					this.nome && 
					this.email &&
					this.telefone && 
					this.data_nascimento) {
		          axios
		              .post('./api/cadastrar_aluno', {
		                cpf: this.cpf,
		                nome: this.nome,
		                email: this.email,
		                telefone: this.telefone,
		                data_nascimento: this.data_nascimento,
		                cod_turma: this.turma
		              })
		              .then(response => {
		                this.$emit('cadastroOk',response.data)
		                $('#novoAluno').modal('hide')
		                this.limparDados()
		              })    
		        }

		        this.errors = [];

		        if (!this.cpf) {
		          this.errors.push('Prencha o campo CPF.');
		        }
		        if (!this.nome) {
		          this.errors.push('Prencha o campo Nome.');
		        }
		        if (!this.email) {
		          this.errors.push('Prencha o campo E-mail.');
		        }
		        if (!this.telefone) {
		          this.errors.push('Prencha o campo Telefone.');
		        }
		        if (!this.data_nascimento) {
		          this.errors.push('Prencha o campo Data de Nascimento.');
		        }
		        return;
				
			}
		}
	}
</script>