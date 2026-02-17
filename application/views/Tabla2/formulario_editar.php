<!DOCTYPE html>
<html>
<head>
    <title>Editar Registro</title>
</head>
<body>
    <h1>Editar Registro</h1>
    
    <form method="post" action="<?php echo base_url('tabla2/actualizar'); ?>">
        <input type="hidden" name="numero" value="<?php echo $registro->numero; ?>">
        
        <label>Número:</label>
        <input type="number" name="numero_display" value="<?php echo $registro->numero; ?>" disabled><br><br>
        
        <label>Objeto:</label>
        <input type="text" name="objeto" maxlength="10" value="<?php echo $registro->objeto; ?>" required><br><br>
        
        <label>Valor:</label>
        <input type="number" step="0.01" name="valor" value="<?php echo $registro->valor; ?>" required><br><br>
        
        <button type="submit">Actualizar</button>
        <a href="<?php echo base_url('tabla2'); ?>">Cancelar</a>
    </form>
</body>
</html>