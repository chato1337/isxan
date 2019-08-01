<template>
    <div class="container">
        <h1 class="text-center">Informacion de la entidad</h1>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Accion</th>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                            Editar
                        </button>
                    </th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar la informacion de la entidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Rut:</label>
                            <input :value="nit" class="form-control" type="number">
                            <label for="">Nombre de la entidad:</label>
                            <input :value="nombre" class="form-control" type="text">
                            <label for="">Departamento:</label>
                            <select class="custom-select" name="" id="">
                                <option value="">seleccione</option>
                            </select>
                            <label for="">Ciudad:</label>
                            <select class="custom-select" name="" id="">
                                <option value="">selecione</option>
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
                nit: 0,
                nombre: 'sin definir',
                departamento: '',
                ciudad: '',
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
