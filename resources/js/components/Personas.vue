<template>
<div class="container">
    <h1 class="text-center">Listado de Personas:</h1>
    <div class="form-group row">
        <div class="col-md-6">
            <div class="input-group">
                <select class="form-control col-md-3" v-model="criterio">
                    <option value="num_documento">Documento:</option>
                    <option value="nombre">Nombre:</option>
                </select>
                <input v-model="buscar" @keyup.enter="listarPersonas(1, buscar, criterio)" type="text" class="form-control" placeholder="Escriba y pulse en buscar o enter">
                <button @click="listarPersonas(1, buscar, criterio)" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                <button @click="abrirModal('persona','registrar')" type="button" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </div>


    <table class="table table-sm table-dark table-bordered text-center">
        <thead>
            <tr>
                <th style="width:10%">#</th>
                <th>Id:</th>
                <th>Nombres y Apellidos:</th>
                <th>Doc:</th>
                <th>Numero:</th>
                <th>Telefono:</th>
                <th>Email:</th>
                <th>Dirección:</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="persona in mostrarPersonas" :key="persona.id">
                <td scope="row">
                    <!-- Button trigger modal -->
                    <button @click="abrirModal('persona', 'actualizar', persona)" type="button" class="btn btn-sm btn-warning">
                        Actualizar
                    </button>
                </td>
                <td v-text="persona.id"></td>
                <td v-text="persona.nombre"></td>
                <td v-text="persona.tipo_documento"></td>
                <td v-text="persona.num_documento"></td>
                <td v-text="persona.telefono"></td>
                <td v-text="persona.email"></td>
                <td v-text="persona.direccion"></td>
            </tr>
        </tbody>
    </table>
    <nav>
        <ul class="pagination">
            <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
            </li>
            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
            </li>
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
            </li>
        </ul>
    </nav>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content mt-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-text="tituloModal"></h5>
                    <button @click="cerrarModal()" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-show="error" class="form-group">
                        <div class="text-center">
                            <div v-for="error in errorMensaje" :key="error" v-text="error" class="badge badge-danger text-wrap"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <label for="">Tipo de documento:</label>
                                    <select class="custom-select" v-model="tipo_documento">
                                        <option value="0">seleccione</option>
                                        <option value="CC">CEDULA DE CIUDADANIA</option>
                                        <option value="TI">TARJETA DE IDENTIDAD</option>
                                        <option value="RUT">RUT</option>
                                        <option value="PS">PASAPORTE</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="">Numero de documento:</label>
                                    <input v-model="num_documento" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Nombres y apellidos:</label>
                                    <input v-model="nombre" class="form-control" type="text">
                                </div>
                                <div class="col">
                                    <label for="">Dirección:</label>
                                    <input v-model="direccion" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Telefono de contacto:</label>
                                    <input v-model="telefono" class="form-control" type="text">
                                </div>
                                <div class="col">
                                    <label for="">Correo electronico:</label>
                                    <input v-model="email" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Departamento:</label>
                                    <select class="custom-select" v-model="idepartamento" @change="listarCiudades(idepartamento)">
                                        <option value="0">seleccione</option>
                                        <option v-for="departamento in mostrarDepartamentos" :key="departamento.id" :value="departamento.id" v-text="departamento.name"></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="">Ciudad:</label>
                                    <select class="custom-select" v-model="imunicipio">
                                        <option value="0">selecione</option>
                                        <option v-for="ciudad in mostrarCiudades" :key="ciudad.id" :value="ciudad.id" v-text="ciudad.name"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="cerrarModal()" type="button" class="btn btn-secondary">Cancelar</button>
                    <button @click="registrarPersona()" v-if="tipoAccion==1" type="button" class="btn btn-success">Registrar persona</button>
                    <button @click="actualizarPersona()" v-if="tipoAccion==2" type="button" class="btn btn-warning">Actualizar persona</button>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import Swal from 'sweetalert2';
import VuePaginate from 'vue-paginate';
Vue.use(VuePaginate);
export default {
    data() {
        return {
            id_persona: 0,
            tipo_documento: '0',
            num_documento: 0,
            nombre: 'sin definir',
            idepartamento: 0,
            imunicipio: 0,
            mostrarDepartamentos: [],
            mostrarCiudades: [],
            direccion: '',
            telefono: '',
            email: '',
            departamento: 0,
            ciudad: 0,
            mostrarPersonas: [],
            criterio: 'num_documento',
            buscar: '',
            modal: 0,
            tituloModal: '',
            tipoAccion: 0,
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0,
            },
            offset: 3,
            error: 0,
            errorMensaje: []
            
        }
    },
    computed: {
    isActived: function(){
        return this.pagination.current_page;
    },
    pagesNumber: function(){
        if(!this.pagination.to){
            return [];
        }
        var from = this.pagination.current_page - this.offset;
        if(from<2){
            from = 1;
        }
        var to = from + (this.offset * 2);
        if(to>=this.pagination.last_page){
            to = this.pagination.last_page;
        }
        var pagesArray = [];
        while(from<=to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
    }
    },
    methods: {
        listarPersonas(page, buscar, criterio) {
            let me = this;
            var url = '/persona?page='+page+'&buscar='+buscar+'&criterio='+criterio;

            axios.get(url).then(function(response){
              var respuesta = response.data;
              console.log(respuesta);
              me.mostrarPersonas = respuesta.personas.data;
              me.pagination= respuesta.pagination;
            })
            .catch(function(error){
              console.log(error)
            });
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            // actualiza la pagian actual
            me.pagination.current_page = page;
            // enviar peticion para listar la otra pagina
            me.listarPersonas(page,buscar,criterio);
        },
        listarDepartamento() {
            let me = this;
            var url = '/departamentos';
            axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.mostrarDepartamentos = respuesta.departamentos;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        listarCiudades(idepartamento) {
            this.imunicipio = 0;
            let me = this;
            var url = '/ciudades?id=' + idepartamento;
            axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.mostrarCiudades = respuesta.ciudades;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        registrarPersona() {
            let me = this;
            if(this.validar()){
                return;
            }

            axios.post('/persona/registrar', {
              'nombre': this.nombre,
              'tipo_documento': this.tipo_documento,
              'num_documento': this.num_documento,
              'direccion': this.direccion,
              'departamento': this.idepartamento,
              'ciudad': this.imunicipio,
              'telefono': this.telefono,
              'email': this.email
            }).then(function (response){
                var tipoAlerta = 'success';
                var registro = me.nombre;
                var mensaje = 'La persona: '+registro+' fue registrada correctamente';
                me.cerrarModal();
                me.alerta(tipoAlerta, registro, mensaje);
                me.listarPersonas('num_documento', '');
            }).catch(function(error){
              console.log(error)
            });
        },
        validar(){
            this.error = 0;
            this.errorMensaje = [];

            if(!this.nombre) this.errorMensaje.push("El nombre es un campo obligatorio");
            if(this.num_documento==0) this.errorMensaje.push("El numero de documento es un campo obligatorio");
            if(!this.direccion) this.errorMensaje.push("La direccion es un campo obligatorio");
            if(!this.telefono) this.errorMensaje.push("El telefono es un campo obligatorio");
            if(!this.email) this.errorMensaje.push("El email es un campo obligatorio");
            if(this.idepartamento == 0) this.errorMensaje.push("El departamento es un campo obligatorio");
            if(this.imunicipio == 0) this.errorMensaje.push("El municipio/ciudad es un campo obligatorio");

            if(this.errorMensaje.length) this.error = 1;

            return this.error;
        },
        actualizarPersona() {
            let me = this;

            axios.put('/persona/actualizar',{
                'id': this.id_persona,
                'nombre': this.nombre,
                'tipo_documento': this.tipo_documento,
                'num_documento': this.num_documento,
                'direccion': this.direccion,
                'departamento': this.idepartamento,
                'ciudad': this.imunicipio,
                'telefono': this.telefono,
                'email': this.email
            }).then(function (response){
                var tipoAlerta = 'success';
                var registro = me.nombre;
                var mensaje = 'se actualizo el registro: '+registro+' correctamente';
                me.cerrarModal();
                me.listarPersonas('num_documento', '');
                me.alerta(tipoAlerta, registro, mensaje);
            }).catch(function(error){
                console.log(error)
            });
        },
        nombreDepartamento() {
            let me = this;


        },
        abrirModal(modelo, accion, data = []){
          switch(modelo){
            case "persona": {
              switch(accion){
                case 'registrar':
                {
                  this.modal = 1;
                  this.tipoAccion = 1;
                  this.tituloModal = 'Registrar persona';
                  this.tipo_documento = '0';
                  this.num_documento = 0;
                  this.nombre = '',
                  this.direccion = '';
                  this.telefono = '';
                  this.email = '';
                  this.idepartamento = 0;
                  this.imunicipio = 0;
                  break;
                }
                case 'actualizar':
                {
                  this.modal = 1;
                  this.tipoAccion = 2;
                  this.tituloModal = 'Actualizar persona';
                  this.id_persona = data['id'];
                  this.tipo_documento = data['tipo_documento'];
                  this.num_documento = data['num_documento'];
                  this.nombre = data['nombre'];
                  this.direccion = data['direccion'];
                  this.telefono = data['telefono'];
                  this.email = data['email'];
                  this.idepartamento = data['departamento'];
                  this.listarCiudades(this.idepartamento);
                  this.imunicipio = data['ciudad'];
                  break;
                }
              }
            }
          }
        },
        cerrarModal(){
            this.modal = 0;
            this.tipo_documento = '0';
            this.num_documento = 0;
            this.nombre = '',
            this.direccion = '';
            this.telefono = '';
            this.email = '';
            this.idepartamento = 0;
            this.imunicipio = 0;
            this.error = 0;
            this.errorMensaje = [];
        },
        alerta(tipo, registro, mensaje){
            Swal.fire({
                position: 'center',
                type: tipo,
                title: mensaje,
                showConfirmButton: false,
                timer: 2500
            })
        }
    },
    mounted() {
        console.log('Component mounted.');
        this.listarDepartamento();
        // this.listarCiudades(this.imunicipio);
        this.listarPersonas(1, this.buscar, this.criterio);
    }
}
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
</style>