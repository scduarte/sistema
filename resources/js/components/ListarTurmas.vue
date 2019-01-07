<template>
    <div class="col-12">
        <div>
            <h3>Ações</h3>
            <button class="btn btn-dark btn-sm mb-1" v-on:click="listarTurmas">Listar Turmas</button>
            
            <button class="btn btn-dark btn-sm mb-1" v-on:click="listarInstrutores">Listar Instrutores</button>

            <button class="btn btn-dark btn-sm mb-1" v-on:click="listarCursos">Listar Cursos</button>
        </div>

        <div v-if="mostrarTurmas" class="my-3">
            <h3>Informações das Turmas <button class="btn btn-dark btn-sm mb-1" data-toggle="modal" data-target="#novaTurma">Nova Turma</button></h3>
            <table class="table table-bordered table-striped table-sm table-responsive">
                <thead >
                    <tr>
                        <th style="white-space: nowrap;" width="5%">Cód.</th>
                        <th style="white-space: nowrap;" width="50%">Nome da Turma</th>
                        <th style="white-space: nowrap;" width="50%">Período</th>
                        <th style="white-space: nowrap;" width="20%">CH</th>
                        <th style="white-space: nowrap;" width="100%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="lista in listaTurmas">
                        <td style="white-space: nowrap;" width="5%">{{lista.id}}</td>
                        <td style="white-space: nowrap;" width="50%">{{lista.nome}}</td>
                        <td style="white-space: nowrap;" width="50%">
                            {{lista.data_inicio.split('-').reverse().join('-')}} 
                            até 
                            {{lista.data_final.split('-').reverse().join('-')}}
                        </td>
                        <td width="20%" style="white-space: nowrap;">{{lista.carga_horaria}}h</td>
                        <td align="center" style="white-space: nowrap;" width="100%">
                            <button @click="buscarAlunos(lista.id); cod = lista.id" class="btn btn-dark btn-sm">Alunos</button>

                            <button @click="buscarInstrutor(lista.id); cod = lista.id" class="btn btn-dark btn-sm">Instrutor</button>

                            <button class="btn btn-dark btn-sm" @click="editarTurma(lista.id)" data-toggle="modal" data-target="#editarTurma">Alterar Turma</button>

                            <button class="btn btn-dark btn-sm" @click="apagarTurma(lista.id)">Apagar Turma</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="float: right;">
                <vc-pagination :source="pagination" @navigate="navigate"></vc-pagination>
            </div>
            
        </div>

        <div v-if="mostrarCursos" class="my-3">
            <h3>Informações dos Cursos <button class="btn btn-dark btn-sm mb-1" data-toggle="modal" data-target="#novoCurso">Novo Curso</button></h3>
            <table class="table table-bordered table-striped table-sm table-responsive">
                <thead >
                    <tr>
                        <th style="white-space: nowrap;" width="50%">Nome</th>
                        <th style="white-space: nowrap;" width="50%">Requisito</th>
                        <th style="white-space: nowrap;" width="50%">Carga Horária</th>
                        <th style="white-space: nowrap;" width="20%">Preço</th>
                        <th style="white-space: nowrap;" width="100%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="lista in listaCursos">
                        <td style="white-space: nowrap;" width="50%">{{lista.nome}}</td>
                        <td style="white-space: nowrap;" width="50%">{{lista.requisito}}</td>
                        <td style="white-space: nowrap;" width="50%">{{lista.carga_horaria}}h</td>
                        <td width="20%" style="white-space: nowrap;">{{lista.preco}}</td>
                        <td align="center" style="white-space: nowrap;" width="100%">
                            <button class="btn btn-dark btn-sm" @click="apagarCurso(lista.id)">Apagar Curso</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="float: right;">
                <vc-pagination :source="pagination" @navigate="navigate"></vc-pagination>
            </div>
            
        </div>

        <div v-if="mostrarListaInstrutores" class="my-3">
            <h3>Informações dos Instrutores <button class="btn btn-dark btn-sm mb-1" data-toggle="modal" data-target="#novoInstrutor">Novo Instrutor</button></h3>
            <table class="table table-bordered table-striped table-sm table-responsive">
                <thead >
                    <tr>
                        <th style="white-space: nowrap;" width="50%">Nome</th>
                        <th style="white-space: nowrap;" width="50%">E-mail</th>
                        <th style="white-space: nowrap;" width="20%">Valor da hora</th>
                        <th style="white-space: nowrap;" width="100%">Certificados</th>
                        <th style="white-space: nowrap;" width="100%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="lista in listaInstrutores">
                        <td style="white-space: nowrap;" width="50%">{{lista.nome}}</td>
                        <td width="20%" style="white-space: nowrap;">{{lista.email}}</td>
                        <td width="20%" style="white-space: nowrap;">{{lista.valor_hora}}</td>
                        <td width="20%" style="white-space: nowrap;">{{lista.certificados}}</td>
                        <td align="center" style="white-space: nowrap;" width="100%">
                            <button class="btn btn-dark btn-sm" @click="apagarInstrutor(lista.id)">Apagar Instrutor</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="float: right;">
                <vc-pagination :source="pagination" @navigate="navigate"></vc-pagination>
            </div>
            
        </div>
        
        <div v-if="mostrarAlunos" class="mt-5 mb-4">
            
            <h3>Alunos da Turma cód. {{cod}} 
                <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#novoAluno">Novo Aluno</button>
            </h3>
            
            <listar-alunos  :alunos="alunos" 
                            :cod="cod" 
                            @atualizarListaAlunos = "refreshAlunos" 
                            @page=" alunos = $event">
                               
                            </listar-alunos>
            
            <cadastrar-alunos   @cadastroOk="buscarAlunos" 
                                :turma="cod">
                                  
                                </cadastrar-alunos>

        </div>
        
        <div v-if="mostrarInstrutores" class="mt-5 mb-4">
            
            <h3>Instrutor da Turma cód. {{cod}} 
               <!-- <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#novoInstrutor">Mudar Instrutor</button> -->
            </h3>
            
            <listar-instrutores :instrutores="instrutores"
                                :cod="cod" 
                                @atualizarListaInstrutores="refreshInstrutores" 
                                >
                               
                                </listar-instrutores>

        </div>

        <cadastrar-turmas @emit="atualizarLista"></cadastrar-turmas>

        <editar-turma :turma="turma" :instrutores="listaInstrutores" :cursos="cursos" @emit="atualizarLista"></editar-turma>

        <cadastrar-instrutores @cadastroOk="buscarInstrutores"></cadastrar-instrutores>
        <cadastrar-curso @emit="listarCursos"></cadastrar-curso>

    </div>
</template>

<script>
    import VcPagination from './Pagination.vue'
    import CadastrarAlunos from './CadastrarAlunos.vue'
    import CadastrarInstrutores from './CadastrarInstrutores.vue'
    import ListarInstrutores from './ListarInstrutores.vue'
    import EditarTurma from './EditarTurma.vue'
    import CadastrarCurso from './CadastrarCurso.vue'

    export default {
        components: {
            VcPagination,
            CadastrarAlunos,
            CadastrarInstrutores,
            ListarInstrutores,
            EditarTurma,
            CadastrarCurso
        },
        data(){
            return{
             mostrarTurmas: false,
             mostrarAlunos: false,
             mostrarInstrutores:false,
             mostrarListaInstrutores:false,
             mostrarCursos:false,
             listaTurmas:[],
             turma:[],
             cursos:{},
             listaCursos:{},
             listaInstrutores: {},
             alunos: {},
             instrutores: [],
             pagination:{},
             cod:""
            }
        },
        methods:{
            refreshAlunos(dados){
                this.buscarAlunos(dados)
            },
            refreshInstrutores(dados){
                this.buscarInstrutor(dados)
            },
            listarTurmas(){

                switch(true){
                    case(this.mostrarTurmas == false):
                    this.mostrarTurmas = true
                    this.mostrarAlunos = false
                    this.mostrarInstrutores = false
                    this.mostrarListaInstrutores = false
                    break

                    case(this.mostrarTurmas == true):
                    this.mostrarTurmas = false
                    this.mostrarAlunos = false
                    this.mostrarInstrutores = false
                    this.mostrarListaInstrutores = false
                    break
                }

                axios
                  .get('./api/listar_turmas')
                  .then(response => {
                    this.listaTurmas = response.data.data
                    this.pagination = response.data
                  })

            },
            listarCursos(){

                switch(true){
                    case(this.mostrarCursos == false):
                    this.mostrarCursos = true
                    this.mostrarTurmas = false
                    this.mostrarAlunos = false
                    this.mostrarInstrutores = false
                    this.mostrarListaInstrutores = false
                    break

                    case(this.mostrarCursos == true):
                    this.mostrarTurmas = false
                    this.mostrarAlunos = false
                    this.mostrarInstrutores = false
                    this.mostrarListaInstrutores = false
                    break
                }

                axios
                  .get('./api/listar_cursos')
                  .then(response => {
                    this.listaCursos = response.data.data
                    this.pagination = response.data
                  })

            },
            apagarCurso(id){
                axios
                    .post('./api/apagar_curso',{id: id})
                    .then(response => {
                        this.listarCursos()
                    })
            },
            editarTurma(id){
                axios
                  .post('./api/editar_turma',{id:id})
                  .then(response => {
                    this.turma = response.data[0]
                    this.listaInstrutores = response.data[1]
                    this.cursos = response.data[2]
                  })
            },
            listarInstrutores(){
                switch(true){
                    case(this.mostrarListaInstrutores == false):
                    this.mostrarListaInstrutores = true
                    this.mostrarTurmas = false
                    this.mostrarAlunos = false
                    this.mostrarInstrutores = false
                    break

                    case(this.mostrarListaInstrutores == true):
                    this.mostrarListaInstrutores = false
                    this.mostrarTurmas = false
                    this.mostrarAlunos = false
                    this.mostrarInstrutores = false
                    break
                }

                axios
                  .get('./api/listar_instrutores')
                  .then(response => {
                    this.listaInstrutores = response.data.data
                    this.pagination = response.data
                  })
            },
            atualizarLista(id){
                axios
                  .get('./api/listar_turmas')
                  .then(response => {
                    this.listaTurmas = response.data.data
                    this.pagination = response.data
                  })

                  this.buscarInstrutor(id);
            },
            
            buscarAlunos(id){
                axios
                  .get('./api/listar_alunos/'+id
                    
                  )
                  .then(response => {
                    this.alunos = response.data
                    this.mostrarAlunos = true
                  })
            },
            
            buscarInstrutor(id){
                axios
                  .get('./api/listar_instrutores/'+id
                    
                  )
                  .then(response => {
                    console.log(response.data)
                    this.instrutores = response.data
                    this.mostrarInstrutores = true
                  })
            },
            buscarInstrutores(){
                axios
                  .get('./api/listar_instrutores'
                    
                  )
                  .then(response => {
                    this.listaInstrutores = response.data.data
                    this.pagination = response.data
                    this.mostrarListaInstrutores = true
                  })
            },
            apagarTurma(id){
                axios
                    .post('./api/apagar_turma',{id: id})
                    .then(response => {
                        this.listaTurmas = response.data.data
                        this.pagination = response.data
                    })
            },
            apagarInstrutor(id){    
                axios
                    .post('./api/apagar_instrutores',{
                        id: id,
                    }).then(response => {
                        this.buscarInstrutores()
                    })
            },
            navigate(page){
                axios
                  .get('./api/listar_turmas?page='+page)
                  .then(response => {
                    this.listaTurmas = response.data.data
                    this.pagination = response.data
                  })
            }
        }
    }
</script>
