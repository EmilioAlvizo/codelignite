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
    <h1>Tabla 1 - Registros</h1>

    <a href="<?= site_url('tabla1/crear') ?>" class="btn btn-primary mb-3">
        + Nuevo Registro
    </a>

    <div style="height: 1000px; background-color: #8ac0f5;"></div>

    <table id="miTabla" class="table table-bordered table-striped">
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
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js" ></script>


    <script>
        var tabla = $('#miTabla').DataTable({
        scrollX: true,
        serverSide: true,       // activa el modo server-side
        processing: true,       // muestra "Procesando..." mientras carga
        ajax: {
            url: '<?= site_url("tabla1/ajax_lista") ?>',
            type: 'GET'
        },
        columns: [
            { data: 0 },  // numero
            { data: 1 },  // edad
            { data: 2 },  // cantidad
            { data: 3,
                render: function(data, type) {
                    var num = DataTable.render
                    .number(',')
                    .display(data);

                    return num;
                }
             },  // poblacion
            { data: 4 },  // precio
            { data: 5 },  // porcentaje
            { data: 6 },  // temperatura
            { data: 7,
            render: function(data, type) {
                var num = DataTable.render
                .number(',', '.', 2, '$')
                .display(data);

                return num;
            }
             },  // saldo
            { data: 8 },  // nombre
            { data: 9 },  // descripcion
            { data: 10 }, // codigo
            { data: 11 }, // notas
            { data: 12 }, // fecha_registro
            { data: 13 }, // fecha_nacimiento
            { data: 14 }, // hora_entrada
            { data: 15 }, // fecha_mod
            { data: 16 }, // activo
            { data: 17 }, // uuid
            { data: 18, orderable: false }  // acciones
        ]
    });

    $(document).on('click', '.btn-eliminar', function() {

    var id = $(this).data('id');

    if(confirm("¿Eliminar registro?")) {

        $.ajax({
            url: "<?= site_url('tabla1/eliminar') ?>/" + id,
            type: "POST",
            success: function(response) {
                tabla.ajax.reload(null, false); // 🔥 recarga SOLO la tabla
            }
        });

    }
});

    </script>
</body>
</html>