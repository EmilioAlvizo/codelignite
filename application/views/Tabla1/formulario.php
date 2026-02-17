<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Registro</title>
</head>
<body>
    <h1>Nuevo Registro</h1>
    
    <form method="post" action="<?php echo base_url('tabla1/guardar'); ?>">
        <label>Número:</label>
        <input type="number" name="numero" required><br><br>
        
        <label>Objeto:</label>
        <input type="text" name="objeto" maxlength="10" required><br><br>
        
        <label>Valor:</label>
        <input type="number" step="0.01" name="valor" required><br><br>
        
        <button type="submit">Guardar</button>
        <a href="<?php echo base_url('tabla1'); ?>">Cancelar</a>
    </form>
</body>
</html>