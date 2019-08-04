<template>
<div class="container">
    <h1 class="text-center">Listado de Personas:</h1>
    <div class="form-group row">
        <div class="col-md-6">
            <div class="input-group">
                <select class="form-control col-md-3">
                    <option value="nombre">Nombre</option>
                    <option value="descripcion">Descripción</option>
                </select>
                <input type="text" class="form-control" placeholder="Texto a buscar">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Agregar</button>
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
                <th>Departamento:</th>
                <th>Ciudad:</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="persona in mostrarPersonas" :key="persona.id">
                <td scope="row">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                        Editar
                    </button>
                </td>
                <td v-text="persona.id"></td>
                <td v-text="persona.nombre"></td>
                <td v-text="persona.tipo_documento"></td>
                <td v-text="persona.num_documento"></td>
                <td v-text="persona.telefono"></td>
                <td v-text="persona.email"></td>
                <td v-text="persona.direccion"></td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingresar nueva persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button @click="registrarPersona()" type="button" class="btn btn-success">Registrar persona</button>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    data() {
        return {
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
            mostrarPersonas: []
        }
    },
    methods: {
        listarPersonas() {
            let me = this;
            var url = '/persona'

            axios.get(url).then(function(response){
              var respuesta = response.data;
              console.log(respuesta);
              me.mostrarPersonas = respuesta.personas;
            })
            .catch(function(error){
              console.log(error)
            });
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
              console.log('funciono!');
              me.listarPersonas();
            }).catch(function(error){
              console.log(error)
            });
        },
        nombreDepartamento() {
            let me = this;


        }
    },
    mounted() {
        console.log('Component mounted.');
        this.listarDepartamento();
        this.listarPersonas();
    }
}
</script>
