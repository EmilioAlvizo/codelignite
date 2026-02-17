<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Registros</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />

</head>

<body>
    <h1>Tabla 2 - Registros</h1>
    <a href="<?php echo base_url('tabla2/crear'); ?>">Nuevo Registro</a>

    <table border="1">
        <thead>
            <tr>
                <th>Número</th>
                <th>Objeto</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro->numero; ?></td>
                    <td><?php echo $registro->objeto; ?></td>
                    <td><?php echo $registro->valor; ?></td>
                    <td><?php echo $registro->fecha; ?></td>
                    <td>
                        <a href="<?php echo base_url('tabla2/editar/' . $registro->numero); ?>">Editar</a>
                        <a href="<?php echo base_url('tabla2/eliminar/' . $registro->numero); ?>"
                            onclick="return confirm('¿Eliminar este registro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>