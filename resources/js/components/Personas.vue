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
                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                <tr>
                    <td scope="row">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                            Editar
                        </button>
                    </td>
                    <td>1</td>
                    <td>Mark</td>
                    <td>CC</td>
                    <td>Otto</td>
                    <td>b/el jardin</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ingresar nuevo provedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tipo de documento:</label>
                            <select class="custom-select" v-model="tipo_documento">
                              <option value="0">seleccione</option>
                              <option value="CC">CEDULA DE CIUDADANIA</option>
                              <option value="TI">TARJETA DE IDENTIDAD</option>
                              <option value="RUT">RUT</option>
                              <option value="PS">PASAPORTE</option>
                            </select>
                            <label for="">Numero de documento:</label>
                            <input v-model="num_documento" class="form-control" type="number">
                            <label for="">Nombres y apellidos:</label>
                            <input v-model="nombre" class="form-control" type="text">
                            <label for="">Dirección:</label>
                            <input v-model="direccion" class="form-control" type="text">
                            <label for="">Telefono de contacto:</label>
                            <input v-model="telefono" class="form-control" type="text">
                            <label for="">Correo electronico:</label>
                            <input v-model="email" class="form-control" type="text">
                            <label for="">Departamento:</label>
                            <select class="custom-select" v-model="idepartamento" @change="listarCiudades(idepartamento)">
                              <option value="0">seleccione</option>
                              <option v-for="departamento in mostrarDepartamentos" :key="departamento.id" :value="departamento.id" v-text="departamento.name"></option>
                            </select>
                            <label for="">Ciudad:</label>
                            <select class="custom-select" v-model="imunicipio">
                              <option value="0">selecione</option>
                              <option v-for="ciudad in mostrarCiudades" :key="ciudad.id" :value="ciudad.id" v-text="ciudad.name"></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success">Actualizar datos</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data () {
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
                ciudad: 0
            }
        },
        methods: {
          listarDepartamento(){
            let me = this;
            var url = '/departamentos';
            axios.get(url).then(function (response){
              var respuesta = response.data;
              me.mostrarDepartamentos = respuesta.departamentos;
            })
            .catch(function (error){
              console.log(error);
            });
          },
          listarCiudades(idepartamento){
            let me = this;
            var url = '/ciudades?id='+idepartamento;
            axios.get(url).then(function (response){
              var respuesta = response.data;
              me.mostrarCiudades = respuesta.ciudades;
            })
            .catch(function (error){
              console.log(error);
            });
          }
        },
        mounted() {
            console.log('Component mounted.');
            this.listarDepartamento();
        }
    }
</script>
