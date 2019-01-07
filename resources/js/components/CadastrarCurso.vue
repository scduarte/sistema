<template>

<div id="novoCurso" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;background-color: #022b38">
      <div class="modal-header" style="background-color: #022b38;color: white;border: none;">
        <h5 class="modal-title ml-auto mr-auto"><strong>Cadastrar Curso</strong></h5>
      </div>
      <div class="modal-body" style="border: 15px solid #022b38;border-top: none;background-color: white;">
        <p v-if="errors.length" class="c-erros">
          <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
          <ul>
            <li v-for="error in errors">{{ error }}</li>
          </ul>
        </p>
      <form action="./api/cadastrar_curso" method="POST" @submit.prevent="cadastrar()">
      <p>
        <strong>Nome do Curso:</strong>
        <span><input v-model="nome" class="form-control input"></span>
      </p>
      
      <p>
        <strong>Requisito:</strong> 
        <span><input v-model="requisito" class="form-control input"></span>
      </p>

      <p>
        <strong>Carga Horária:</strong> 
        <span><input v-model="carga_horaria" class="form-control input"></span>
      </p>
      
      <p>
        <strong>Preço:</strong> 
        <span><input v-model="preco" class="form-control input"></span>
      </p>

      <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button>
      <button @click="limparModal" type="button" class="btn btn-primary btn-sm pull-right mr-2" data-dismiss="modal">Sair</button>
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
		data(){
			return{
				nome:"",
				requisito:"",
				carga_horaria:"",
				preco:"",
        errors:[]
			}
		},
		methods:{
      limparModal(){
        this.nome = ""
        this.requisito = ""
        this.carga_horaria = ""
        this.preco = ""
        this.errors = ""
      },

			cadastrar(){
        if (this.nome && this.requisito && this.carga_horaria && this.preco) {
  
          axios
              .post('./api/cadastrar_curso', {
                nome: this.nome,
                requisito: this.requisito,
                carga_horaria: this.carga_horaria,
                preco: this.preco
              })
              .then(response => {
                this.$emit('emit')
                $('#novoCurso').modal('hide');
                this.nome = ""
                this.requisito = ""
                this.carga_horaria = ""
                this.preco = ""
                this.errors = ""
              })    
        }

        this.errors = [];

        if (!this.nome) {
          this.errors.push('Preencha o campo nome.');
        }    
        if (!this.requisito) {
          this.errors.push('Preencha o campo requisito.');
        }
        if (!this.carga_horaria) {
          this.errors.push('Preencha o campo carga horária.');
        }
        if (!this.preco) {
          this.errors.push('Preencha o campo preço.');
        }
        return;
				
			}
		}
	}
</script>