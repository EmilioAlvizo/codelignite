<!-- application/views/Tabla1/lista.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" /> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" />
    <title>tabla 1</title>
</head>

<body>
    <div class="container mt-4">
        <!-- <div style="height: 1000px; background-color: #8ac0f5;"></div> -->
        <div class="mt-4 mb-4 p-3 bg-light rounded border">
            <h3>Filtros personalizados</h3>

            <div class="row mb-3">

                <div class="col-md-3">
                    <label>Nombre:</label>
                    <input type="text" id="filtroNombre" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>UUID:</label>
                    <input type="text" id="filtroUUID" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Activo:</label>
                    <select id="filtroActivo" class="form-select">
                        <option value="">Todos</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Fecha Registro Desde:</label>
                    <input type="date" id="filtroFechaDesde" class="form-control">
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <button id="btnBorrarFiltro" class="btn btn-secondary w-100">Borrar filtros</button>
                </div>

                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <button id="btnFiltrar" class="btn btn-primary w-100">Filtrar</button>
                </div>

            </div>
        </div>

        <h1>Tabla 1 - Registros</h1>

        <!-- Botón que abre el modal -->
        <button type="button" class="btn btn-primary mb-3" id="btnNuevoRegistro" data-bs-toggle="modal" data-bs-target="#modalFormulario">
            + Nuevo Registro
        </button>

        <table id="miTabla" class="table table-bordered table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Edad</th>
                    <th>Cantidad</th>
                    <th>Poblacion</th>
                    <th>Precio</th>
                    <th>Porcentaje</th>
                    <th>Temperatura</th>
                    <th>Saldo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Codigo</th>
                    <th>Notas</th>
                    <th>Fecha Registro</th>
                    <th>Fecha Nacimiento</th>
                    <th>Hora Entrada</th>
                    <th>Fecha Mod</th>
                    <th>Activo</th>
                    <th>UUID</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody> <!-- Ajax llena esto -->
        </table>

        

    </div>

    <!-- Modal Bootstrap 5 -->
    <div class="modal fade" id="modalFormulario" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nuevo Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formRegistro">
                        <input type="hidden" id="numero" name="numero">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Edad:</label>
                                <input type="number" class="form-control" name="edad" id="edad" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Población:</label>
                                <input type="number" class="form-control" name="poblacion" id="poblacion">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Porcentaje:</label>
                                <input type="number" step="0.01" class="form-control" name="porcentaje" id="porcentaje">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Temperatura:</label>
                                <input type="number" class="form-control" name="temperatura" id="temperatura">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Saldo:</label>
                                <input type="number" step="0.01" class="form-control" name="saldo" id="saldo">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="2"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Código:</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" maxlength="10">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Activo:</label>
                                <select name="activo" id="activo" class="form-select">
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notas:</label>
                            <textarea class="form-control" name="notas" id="notas" rows="2"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fecha Registro:</label>
                                <input type="datetime-local" class="form-control" name="fecha_registro" id="fecha_registro">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Hora Entrada:</label>
                                <input type="time" class="form-control" name="hora_entrada" id="hora_entrada">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha Modificación:</label>
                            <input type="date" class="form-control" name="fecha_mod" id="fecha_mod">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script> <!-- moment.js -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // recargar tabla al hacer click en "filtrar"
        $('#btnFiltrar').click(function(){
            tabla.ajax.reload();
        });

        //limpiar filtros
        $('#btnBorrarFiltro').click(function(){
            $('#filtroNombre').val('');
            $('#filtroUUID').val('');
            $('#filtroActivo').val('');
            $('#filtroFechaDesde').val('');
            tabla.ajax.reload();
        });

        var tabla = $('#miTabla').DataTable({
            scrollX: true,
            serverSide: true, // activa el modo server-side
            processing: true, // muestra "Procesando..." mientras carga
            ajax: {
                url: '<?= site_url("tabla1/ajax_lista") ?>',
                type: 'GET',
                data: function(d) {
                    //agregar parametros personalizados para filtros
                    d.nombre = $('#filtroNombre').val();
                    d.uuid = $('#filtroUUID').val();
                    d.activo = $('#filtroActivo').val();
                    d.fecha_desde = $('#filtroFechaDesde').val();
                }
            },
            columns: [{
                    data: 0
                },
                {
                    data: 1
                },
                {
                    data: 2
                },
                {
                    data: 3,
                    render: function(data) {
                        return DataTable.render.number(',').display(data);
                    }
                },
                {
                    data: 4
                },
                {
                    data: 5
                },
                {
                    data: 6
                },
                {
                    data: 7,
                    render: function(data) {
                        return DataTable.render.number(',', '.', 2, '$').display(data);
                    }
                },
                {
                    data: 8
                },
                {
                    data: 9
                },
                {
                    data: 10
                },
                {
                    data: 11
                },
                {
                    data: 12,
                    render: function(data, type, row) {
                    // 'data' es el valor de la fecha, 'row' es la fila completa
                    // Usa moment.js para formatear (asegúrate de tenerlo cargado)
                    return moment(data).format('DD/MM/YYYY HH:mm:ss');
                }
                },
                {
                    data: 13,
                    render: function(data, type, row) {
                    // 'data' es el valor de la fecha, 'row' es la fila completa
                    // Usa moment.js para formatear (asegúrate de tenerlo cargado)
                    return moment(data).format('DD/MM/YYYY');
                } 
                },
                {
                    data: 14,
                    render: function(data, type, row) {
                    // 'data' es el valor de la fecha, 'row' es la fila completa
                    // Usa moment.js para formatear (asegúrate de tenerlo cargado)
                    return moment(data, 'HH:mm:ss.SSSSSSS').format('HH:mm:ss');
                }
                },
                {
                    data: 15,
                    render: function(data, type, row) {
                    // 'data' es el valor de la fecha, 'row' es la fila completa
                    // Usa moment.js para formatear (asegúrate de tenerlo cargado)
                    return moment(data).format('DD/MM/YYYY HH:mm:ss');
                }
                },
                {
                    data: 16
                },
                {
                    data: 17
                },
                {
                    data: 18,
                    orderable: false
                }
            ]
        });

        var modal = new bootstrap.Modal(document.getElementById('modalFormulario')); 

        // limpiar formulario al abrir nuevo registro
        $('#btnNuevoRegistro').click(function() {
            $('#formRegistro')[0].reset();
        })
        
        // Guardar (crear o actualizar) 
        $('#btnGuardar').click(function() {
            var formData = $('#formRegistro').serialize();
            var numero = $('#numero').val();
            var url = numero ? '<?= site_url("tabla1/actualizar") ?>' : '<?= site_url("tabla1/guardar") ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        modal.hide();
                        $('#formRegistro')[0].reset();
                        tabla.ajax.reload(null, false);
                        Swal.fire({
                        icon: 'success',
                        title: 'Guardado',
                        text: 'Registro guardado correctamente',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    } else {
                        Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo guardar el registro'
                    });
                    }
                }
            });
        }); 
        
        // Editar - cargar datos en el modal 
        $(document).on('click', '.btn-editar', function() {
            var numero = $(this).data('id');
            $.ajax({
                url: '<?= site_url("tabla1/obtener") ?>/' + numero,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#formRegistro')[0].reset();

                    $('#tituloModal').text('Editar Registro');
                    $('#numero').val(data.numero);
                    $('#edad').val(data.edad);
                    $('#cantidad').val(data.cantidad);
                    $('#poblacion').val(data.poblacion);
                    $('#porcentaje').val(data.porcentaje);
                    $('#temperatura').val(data.temperatura);
                    $('#saldo').val(data.saldo);
                    $('#nombre').val(data.nombre);
                    $('#descripcion').val(data.descripcion);
                    $('#codigo').val(data.codigo);
                    $('#notas').val(data.notas); // datetime-local: "2024-01-15 10:30:00" → "2024-01-15T10:30" 
                    //$('#fecha_registro').val(data.fecha_registro);
                    if (data.fecha_registro) {
                        var fr = data.fecha_registro.substring(0, 16).replace(' ', 'T');
                        $('#fecha_registro').val(fr);
                    }
                    $('#fecha_nacimiento').val(data.fecha_nacimiento); // time: "10:30:00.0000000" → "10:30" 
                    //$('#hora_entrada').val(data.hora_entrada);
                    if (data.hora_entrada) {
                        var he = data.hora_entrada.substring(0, 5);
                        $('#hora_entrada').val(he);
                    } // date: "2024-01-15 10:30:00.0000000" → "2024-01-15"
                    //$('#fecha_mod').val(data.fecha_mod);
                    if (data.fecha_mod) {
                        var fm = data.fecha_mod.substring(0, 10);
                        $('#fecha_mod').val(fm);
                    }
                    $('#activo').val(data.activo);
                    modal.show();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('Error al cargar los datos');
                }
            });
        }); 
        
        // Eliminar 
        $(document).on('click', '.btn-eliminar', function() {
            var id = $(this).data('id');

            Swal.fire({
            title: '¿Estás seguro?',
            text: "Este registro se eliminará permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= site_url('tabla1/eliminar') ?>/" + id,
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {

                        tabla.ajax.reload(null, false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: 'Registro eliminado correctamente',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar el registro'
                        });
                    }
                });

            }
        });
    });
    </script>
</body>

</html>