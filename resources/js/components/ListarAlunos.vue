<template>
    <div>
    	<table class="table table-bordered table-striped table-sm table-responsive">
            <thead >
                <tr>
                    <th style="white-space: nowrap;" width="50%">Nome do Aluno</th>
                    <th style="white-space: nowrap;" width="50%">CPF</th>
                    <th style="white-space: nowrap;" width="20%">E-mail</th>
                    <th style="white-space: nowrap;" width="20%">Telefone</th>
                    <th style="white-space: nowrap;" width="20%">Data de Nascimento</th>
                    <th style="white-space: nowrap;" width="20%">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="aluno in alunos.data">
                    <td style="white-space: nowrap;" width="50%">{{aluno.nome}}</td>
                    <td style="white-space: nowrap;" width="50%">{{aluno.cpf}}</td>
                    <td width="20%" style="white-space: nowrap;">{{aluno.email}}</td>
                    <td width="20%" style="white-space: nowrap;">{{aluno.fone}}</td>
                    <td width="20%" style="white-space: nowrap;">{{aluno.data_nascimento == null ? "" : aluno.data_nascimento.split('-').reverse().join('-')}}</td>
                    <td align="center" style="white-space: nowrap;" width="20%">
                        <button @click="apagarAluno(aluno.id)" class="btn btn-dark btn-sm">Apagar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="c-page">
            <vc-paginate :source="alunos" @navigate="navigate"></vc-paginate>
        </div>
    </div>
</template>

<style>
    .c-page{
        float: right;
    }    
</style>

<script>
    import VcPaginate from './Pagination.vue'
	export default{
        components:{VcPaginate},
		props:['alunos','cod'],
		methods:{
			apagarAluno(id){	
				axios
					.post('./api/apagar_aluno',{
						id: id,
                        cod_turma: this.cod
					}).then(response => {
						this.$emit('atualizarListaAlunos', response.data)
					})
			},
            navigate(page){
                axios
                  .get('./api/listar_alunos/'+this.cod+'?page='+page)
                  .then(response => {
                    this.$emit('page',response.data)
                  })
            }
		}
	}
</script>