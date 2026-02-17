<!DOCTYPE html>
<html>
<head>
    <title>Lista de Registros</title>
</head>
<body>
    <h1>Tabla 1 - Registros</h1>
    <a href="<?php echo base_url('tabla1/crear'); ?>">Nuevo Registro</a>
    
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
            <?php foreach($registros as $registro): ?>
            <tr>
                <td><?php echo $registro->numero; ?></td>
                <td><?php echo $registro->objeto; ?></td>
                <td><?php echo $registro->valor; ?></td>
                <td><?php echo $registro->fecha; ?></td>
                <td>
                    <a href="<?php echo base_url('tabla1/editar/'.$registro->numero); ?>">Editar</a>
                    <a href="<?php echo base_url('tabla1/eliminar/'.$registro->numero); ?>" 
                       onclick="return confirm('¿Eliminar este registro?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>