<template>

<div id="novaTurma" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;background-color: #022b38">
      <div class="modal-header" style="background-color: #022b38;color: white;border: none;">
        <h5 class="modal-title ml-auto mr-auto"><strong>Cadastrar Turma</strong></h5>
      </div>
      <div class="modal-body" style="border: 15px solid #022b38;border-top: none;background-color: white;">
        <p v-if="errors.length" class="c-erros">
          <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
          <ul>
            <li v-for="error in errors">{{ error }}</li>
          </ul>
        </p>
      <form action="./api/cadastrar_turma" method="POST" @submit.prevent="cadastrar()">
      <p>
        <strong>Curso:</strong>
        <span><select class="form-control" v-model="curso">
        	<option selected value="">Selecione</option>
        	<option v-for="curso in dados[0]" v-bind:value="curso.id">{{curso.nome}}</option>
        </select></span>
      </p>
      
      <p>
        <strong>Instrutor:</strong> 
        <span><select class="form-control" v-model="instrutor">
        	<option selected value="">Selecione</option>
        	<option v-for="instrutor in dados[1]" :value="instrutor.id">{{instrutor.nome}}</option>
        </select></span>
      </p>

      <p>
        <strong>Data de Ínicio:</strong> 
        <span><input-mask v-model="data_ini" mask="##-##-####" masked class="input form-control"></input-mask></span>
      </p>
      
      <p>
        <strong>Data de Término:</strong> 
        <span><input-mask v-model="data_fim" mask="##-##-####" masked class="input form-control"></input-mask></span>
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
				curso:"",
				instrutor:"",
				data_ini:"",
				data_fim:"",
				dados: [],
        errors:[]
			}
		},
		mounted () {
		    axios
		      .get('./dados')
		      .then(response => (this.dados = response.data))
		},
		methods:{
      limparModal(){
        this.curso = ""
        this.instrutor = ""
        this.data_ini = ""
        this.data_fim = ""
        this.errors = ""
      },

			cadastrar(){
        if (this.curso && this.data_ini && this.data_fim) {
  
          axios
              .post('./api/cadastrar_turma', {
                curso: this.curso,
                instrutor: this.instrutor,
                data_ini: this.data_ini,
                data_fim: this.data_fim
              })
              .then(response => {
                this.$emit('emit')
                $('#novaTurma').modal('hide');
                this.curso = ""
                this.instrutor = ""
                this.data_ini = ""
                this.data_fim = ""
                this.errors = []
              })    
        }

        this.errors = [];

        if (!this.curso) {
          this.errors.push('Selecione um curso.');
        }    
        if (!this.data_ini) {
          this.errors.push('Digite a data de início do curso.');
        }
        if (!this.data_fim) {
          this.errors.push('Digite a data de término do curso.');
        }

        return;
				
			}
		}
	}
</script>