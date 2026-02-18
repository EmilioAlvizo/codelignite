<!DOCTYPE html>
<html>
<head>
    <title>Editar Registro</title>
</head>
<body>
    <h1>Editar Registro</h1>
    
    <form method="post" action="<?php echo base_url('tabla1/actualizar'); ?>">
        <input type="hidden" name="numero" value="<?php echo $registro->numero; ?>">

        <label>numero:</label>
        <input type="number" name="numero" value="<?php echo $registro->numero; ?>" disabled><br><br>
        
        <label>Edad:</label>
        <input type="number" name="edad" value="<?php echo $registro->edad; ?>"><br><br>
        
        <label>Cantidad:</label>
        <input type="text" name="cantidad" maxlength="10" value="<?php echo $registro->cantidad; ?>" ><br><br>
        
        <label>Poblacion:</label>
        <input type="number" step="1" name="poblacion" value="<?php echo $registro->poblacion; ?>" ><br><br>
        
        <label>precio:</label>
        <input type="number" step="0.01" name="precio" value="<?php echo $registro->precio; ?>" ><br><br>

        <label>porcentaje:</label>
        <input type="number" step="0.01" name="porcentaje" value="<?php echo $registro->porcentaje; ?>" ><br><br>

        <label>temperatura:</label>
        <input type="number" step="0.01" name="temperatura" value="<?php echo $registro->temperatura; ?>" ><br><br>

        <label>saldo:</label>
        <input type="number" step="0.01" name="saldo" value="<?php echo $registro->saldo; ?>" ><br><br>

        <label>nombre:</label>
        <input type="text" name="nombre" value="<?php echo $registro->nombre; ?>" ><br><br>

        <label>descripcion:</label>
        <input type="text" name="descripcion" value="<?php echo $registro->descripcion; ?>" ><br><br>

        <label>codigo:</label>
        <input type="text" name="codigo" value="<?php echo $registro->codigo; ?>" ><br><br>

        <label>notas:</label>
        <input type="text" name="notas" value="<?php echo $registro->notas; ?>" ><br><br>

        <label>fecha_registro:</label>
        <input type="date" name="fecha_registro" value="<?php echo $registro->fecha_registro; ?>" ><br><br>

        <label>fecha_nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?php echo $registro->fecha_nacimiento; ?>" ><br><br>

        <label>hora_entrada:</label>
        <input type="time" name="hora_entrada" value="<?php echo $registro->hora_entrada; ?>" ><br><br>

        <label>fecha_mod:</label>
        <input type="date" name="fecha_mod" value="<?php echo $registro->fecha_mod; ?>" ><br><br>

        <!-- <label>activo:</label>
        <input type="checkbox" name="activo" <?php echo $registro->activo ? 'checked' : ''; ?> ><br><br>
 -->
        <select name="activo">
            <option value="1" <?php echo $registro->activo == 1 ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo $registro->activo == 0 ? 'selected' : ''; ?>>No</option>
        </select><br><br>

        <!-- <label>uuid:</label>
        <input type="number" step="0.01" name="poblacion" value="<?php echo $registro->poblacion; ?>" required><br><br>
        -->
        <button type="submit">Actualizar</button>
        <a href="<?php echo base_url('tabla1'); ?>">Cancelar</a>
    </form>
</body>
</html>