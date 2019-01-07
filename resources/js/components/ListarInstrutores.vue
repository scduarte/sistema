<template>
    <div>
    	<table class="table table-bordered table-striped table-sm table-responsive">
            <thead >
                <tr>
                    <th style="white-space: nowrap;" width="50%">Nome</th>
                    <th style="white-space: nowrap;" width="50%">E-mail</th>
                    <th style="white-space: nowrap;" width="20%">Valor da hora</th>
                    <th style="white-space: nowrap;" width="20%">Certificados</th>
                    <th style="white-space: nowrap;" width="20%">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="instrutor in instrutores">
                    <td style="white-space: nowrap;" width="50%">{{instrutor.nome}}</td>
                    <td style="white-space: nowrap;" width="50%">{{instrutor.email}}</td>
                    <td width="20%" style="white-space: nowrap;">{{instrutor.valor_hora}}</td>
                    <td width="20%" style="white-space: nowrap;">{{instrutor.certificados}}</td>
                    <td align="center" style="white-space: nowrap;" width="20%">
                        <button @click="apagarInstrutor()" class="btn btn-dark btn-sm">Apagar</button>
                    </td>
                </tr>
            </tbody>
        </table>
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
		props:['instrutores','cod'],
		methods:{
			apagarInstrutor(){	
				axios
					.post('./api/apagar_instrutor',{
                        cod_turma: this.cod
					}).then(response => {
						this.$emit('atualizarListaInstrutores', response.data)
					})
			}
		}
	}
</script>