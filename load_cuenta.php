<?php
	require_once 'connect.php';
	$q_cuenta = $conn->query("SELECT * FROM `cuenta` WHERE `cuenta_id` = '$_REQUEST[cuenta_id]'") or die(mysqli_error($conn));
	$f_cuenta = $q_cuenta->fetch_array();
?>
<div class = "col-lg-3"></div>
<div class = "col-lg-6">
	<form method = "POST" action = "edit_cuenta_query.php?cuenta_id=<?php echo $f_cuenta['cuenta_id']?>" enctype = "multipart/form-data">
    <div class="form-group">
    <label>Cuenta Streaming:</label>
    <select name="plataforma" required="required" class="form-control">
      <option value="Netflix">Netflix</option>
      <option value="Prime Video">Prime Video</option>
      <option value="Star+">Star+</option>
      <option value="Paramount">Paramount</option>
      <option value="HBO Max">HBO Max</option>
      <option value="Disney+">Disney+</option>
    </select>
  </div>
		<div class = "form-group">
			<label>Password:</label>

			<input type = "password" maxlength = "12" value = "<?php echo $f_cuenta['comentario']?>" name = "cuenta_desc" class = "form-control" />
		</div>
		<div class = "form-group">

    <label>Usuario Asignado:</label>
    <!-- Cambiando de un input de texto a un cuadro de selección (combobox) -->
    <select name="usuario_generico" class="form-control" required="required">
        <?php
        // Realizar la conexión a la base de datos (reemplaza los valores según tu configuración)
        $conexion = new mysqli('localhost', 'root', '', 'streaming_1');

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener los valores de cliente_no desde la tabla cliente
        $consulta = "SELECT cliente_no FROM cliente";
        $resultado = $conexion->query($consulta);

        // Verificar si hay resultados
        if ($resultado->num_rows > 0) {
            // Iterar sobre los resultados y agregar opciones al cuadro de selección
            while ($fila = $resultado->fetch_assoc()) {
                // Seleccionar automáticamente el valor actual de usuario_generico
                $seleccionado = ($fila['cliente_no'] == $f_cuenta['usuario_generico']) ? "selected" : "";
                echo "<option value='" . $fila['cliente_no'] . "' $seleccionado>" . $fila['cliente_no'] . "</option>";
            }
        } else {
            echo "<option value=''>No hay clientes disponibles</option>";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </select>


		</div>
		<div class="form-group">
    <label>CORREO DE LA CUENTA(EMPRESA):</label>
    <input type="email" name="correo_electronico" value="<?php echo $f_cuenta['correo_electronico']?>" class="form-control" required="required" />
  	</div>
		<div class = "form-group">
			<label>Fecha de Creación:</label>
			<input type = "date" name = "fecha_de_creacion" value = "<?php echo $f_cuenta['fecha_de_creacion']?>" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Cantidad</label>
			<input type = "number" min = "0" value = "<?php echo $f_cuenta['qty']?>" name = "qty" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">
			<button name = "edit_cuenta" class = "btn btn-warning"><span class = "glyphicon glyphicon-edit"></span> Guardar Cambios</button>
		</div>
	</form>		
</div>