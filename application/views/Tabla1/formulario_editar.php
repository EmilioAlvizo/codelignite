<!DOCTYPE html>
<html>
<head>
    <title>Editar Registro</title>
</head>
<body>
    <h1>Editar Registro</h1>
    
    <form method="post" action="<?php echo base_url('tabla1/actualizar'); ?>">
        <input type="hidden" name="numero" value="<?php echo $registro->numero; ?>">
        
        <label>Edad:</label>
        <input type="number" step="1" name="edad" value="<?php echo $registro->edad; ?>" required><br><br>

        <label>Objeto:</label>
        <input type="text" name="objeto" maxlength="10" value="<?php echo $registro->objeto; ?>"><br><br>
        
        <button type="submit">Actualizar</button>
        <a href="<?php echo base_url('tabla1'); ?>">Cancelar</a>
    </form>
</body>
</html>