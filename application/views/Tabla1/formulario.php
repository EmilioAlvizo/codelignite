<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Registro</title>
</head>
<body>
    <h1>Nuevo Registro</h1>
    
    <form method="post" action="<?php echo base_url('tabla1/guardar'); ?>">
        <label>Edad:</label>
        <input type="number" step="1" name="edad" required><br><br>
        
        <label>Cantidad:</label>
        <input type="number" step="0.01" name="cantidad" ><br><br>

        <label>Poblacion:</label>
        <input type="number" step="1" name="poblacion" ><br><br>

        <!-- <label>Precio:</label>
        <input type="number" step="0.01" name="precio" ><br><br>
         -->
        <label>Porcentaje:</label>
        <input type="number" step="0.01" name="porcentaje" ><br><br>

        <label>Temperatura:</label>
        <input type="number" step="1" name="temperatura" ><br><br>

        <label>Saldo:</label>
        <input type="number" step="0.01" name="saldo" ><br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" maxlength="10" ><br><br>
        
        <label>descripcion:</label>
        <input type="text" name="descripcion" maxlength="10" ><br><br>

        <label>codigo:</label>
        <input type="text" name="codigo" maxlength="10" ><br><br>

        <label>notas:</label>
        <input type="text" name="notas" maxlength="10" ><br><br>

        <label>fecha_registro:</label>
        <input type="datetime-local" name="fecha_registro" ><br><br>

        <label>fecha_nacimiento:</label>
        <input type="date" name="fecha_nacimiento" ><br><br>

        <label>hora_entrada:</label>
        <input type="time" name="hora_entrada" ><br><br>

        <label>fecha_mod:</label>
        <input type="date"  name="fecha_mod" ><br><br>

        <label>activo:</label>
        <select name="activo">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select><br><br>

        <label>uuid:</label>
        <input type="number" step="0.01" name="uuid" ><br><br>
         
        <button type="submit">Guardar</button>
        <a href="<?php echo base_url('tabla1'); ?>">Cancelar</a>
    </form>
</body>
</html>