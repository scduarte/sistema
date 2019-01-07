<template>

<div id="editarTurma" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;background-color: #022b38">
      <div class="modal-header" style="background-color: #022b38;color: white;border: none;">
        <h5 class="modal-title ml-auto mr-auto"><strong>Editar Turma</strong></h5>
      </div>
      <div class="modal-body" style="border: 15px solid #022b38;border-top: none;background-color: white;">
        <p v-if="errors.length" class="c-erros">
          <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
          <ul>
            <li v-for="error in errors">{{ error }}</li>
          </ul>
        </p>
      <form action="./api/editar_turma" method="POST" @submit.prevent="editar(turma.id)">
      <p>
        <strong>Curso:</strong>
        <span><select class="form-control" v-model="curso">
        	<option selected value="">Selecione</option>
        	<option v-for="curso in cursos" v-bind:value="curso.id">{{curso.nome}}</option>
        </select></span>
      </p>
      
      <p>
        <strong>Instrutor:</strong> 
        <span><select class="form-control" v-model="instrutor">
        	<option selected value="">Selecione</option>
        	<option v-for="instrutor in instrutores" v-bind:value="instrutor.id">{{instrutor.nome}}</option>
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
    props:['turma','instrutores','cursos'],
		data(){
			return{
				curso:"",
				instrutor:"",
				data_ini: "",
				data_fim: "",
				dados: [],
        errors:[]
			}
		},
		methods:{
      limparModal(){
        this.curso = ""
        this.instrutor = ""
        this.data_ini = ""
        this.data_fim = ""
        this.errors = ""
      },

			editar(id){
        if (this.curso && this.data_ini && this.data_fim) {
  
          axios
              .post('./api/atualizar_turma', {
                curso: this.curso,
                instrutor: this.instrutor,
                data_ini: this.data_ini,
                data_fim: this.data_fim,
                turma_id: id
              })
              .then(response => {
                this.$emit('emit',this.turma.id)
                $('#editarTurma').modal('hide');
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