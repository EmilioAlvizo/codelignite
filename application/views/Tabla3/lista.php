<!-- application/views/Tabla3/lista.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" /> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" />
    <title>tabla 3</title>
</head>

<body>

    <div class="container mt-4">

        <div class="mt-4 mb-4 p-3 bg-light rounded border">
            <h3>Filtros personalizados</h3>

            <div class="row mb-3">

                <div class="col-md-3">
                    <label>Nombre:</label>
                    <input type="text" id="filtroNombre" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Estado:</label>
                    <select id="filtroEstado" class="form-select">
                        <option value="">Todos</option>
                        <option value="Invalido">Invalido</option>
                        <option value="Valido">Valido</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Error">Error</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Fecha Captura Desde:</label>
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


        <!-- <div style="height: 1000px; background-color: #8ac0f5;"></div> -->

        <h1>Tabla 3 - clientes con deudas</h1>

        <!-- Botón que abre el modal -->
        <!-- <button type="button" class="btn btn-primary mb-3" id="btnNuevoRegistro" data-bs-toggle="modal" data-bs-target="#modalFormulario">
            + Nuevo Registro
        </button> -->

        <table id="miTabla3" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Nombre</th>
                    <th>Saldo</th>
                    <th>Estado</th>
                    <th>Fecha Captura</th>
                    <!-- <th>Acciones</th> -->
                </tr>
            </thead>
            <tbody></tbody> <!-- Ajax llena esto -->
        </table>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script> <!-- moment.js -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>


    <script>
        // recargar tabla al hacer click en "filtrar"
        $('#btnFiltrar').click(function(){
            tabla.ajax.reload();
        });

        //limpiar filtros
        $('#btnBorrarFiltro').click(function(){
            $('#filtroNombre').val('');
            $('#filtroEstado').val('');
            $('#filtroFechaDesde').val('');
            tabla.ajax.reload();
        });

        var tabla = $('#miTabla3').DataTable({
            scrollX: true,
            serverSide: true, // activa el modo server-side
            processing: true, // muestra "Procesando..." mientras carga
            ajax: {
                url: '<?= site_url("tabla3/ajax_lista") ?>',
                type: 'GET',
                data: function(d) {
                    //agregar parametros personalizados para filtros
                    d.nombre = $('#filtroNombre').val();
                    d.estado = $('#filtroEstado').val();
                    d.fcaptura = $('#filtroFechaDesde').val();
                }
            },
            columns: [{
                    data: 'cliente_id'
                },
                { data: 'nombre' },
                {
                    data: 'saldo',
                    render: function(data) {
                        return DataTable.render.number(',', '.', 2, '$').display(data);
                    }
                },
                { data: 'estado' },
                {
                    data: 'fcaptura',
                    render: function(data, type, row) {
                    // 'data' es el valor de la fecha, 'row' es la fila completa
                    // Usa moment.js para formatear (asegúrate de tenerlo cargado)
                    return moment(data).format('DD/MM/YYYY HH:mm:ss');
                }
                },
                //{ data: 'acciones', orderable: false }
            ]
        });

        /* var modal = new bootstrap.Modal(document.getElementById('modalFormulario')); 

        // limpiar formulario al abrir nuevo registro
        $('#btnNuevoRegistro').click(function() {
            $('#formRegistro')[0].reset();
        })
        
        // Guardar (crear o actualizar) 
        $('#btnGuardar').click(function() {
            var formData = $('#formRegistro').serialize();
            var numero = $('#numero').val();
            var url = numero ? '<?= site_url("tabla3/actualizar") ?>' : '<?= site_url("tabla3/guardar") ?>';
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
                        alert('Guardado correctamente');
                    } else {
                        alert('Error al guardar');
                    }
                }
            });
        }); 
        
        // Editar - cargar datos en el modal 
        $(document).on('click', '.btn-editar', function() {
            var numero = $(this).data('id');
            $.ajax({
                url: '<?= site_url("tabla3/obtener") ?>/' + numero,
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
            if (confirm("¿Eliminar registro?")) {
                $.ajax({
                    url: "<?= site_url('tabla3/eliminar') ?>/" + id,
                    type: "POST",
                    success: function() {
                        tabla.ajax.reload(null, false); // 🔥 recarga SOLO la tabla 
                    }
                });
            }
        }); */
    </script>
</body>

</html>