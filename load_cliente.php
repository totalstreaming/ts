<?php
	require_once 'connect.php';
	$q_cliente = $conn->query("SELECT * FROM `cliente` WHERE `cliente_no` = '$_REQUEST[cliente_id]'") or die(mysqli_error($conn));
	$f_cliente = $q_cliente->fetch_array();

	
?>
<div class = "col-lg-3"></div>
<div class = "col-lg-6">
	<form method = "POST" action = "edit_cliente_query.php?cliente_id=<?php echo $f_cliente['cliente_id']?>" enctype = "multipart/form-data">	
		<div class = "form-group">	
			<label>ID Estudiante:</label>
			<input type = "text" name = "cliente_no" value = "<?php echo $f_cliente['cliente_no']?>" required = "required" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<label>Primer nombre:</label>
			<input type = "text" name = "nombre" value = "<?php echo $f_cliente['nombre']?>" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">	
			<label>Segundo nombre:</label>
			<input type = "text" name = "correo_electronico" value = "<?php echo $f_cliente['correo_electronico']?>" placeholder = "(Optional)" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<label>Apellidos:</label>
			<input type = "text" required = "required" value = "<?php echo $f_cliente['apellidos']?>" name = "apellidos" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Curso:</label>
			<input type = "text" required = "required" value = "<?php echo $f_cliente['cuenta_streaming']?>" name = "cuenta_streaming" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<label>Año / Sección</label>
			<input type = "date" name = "section" value = "<?php echo $f_cliente['section']?>" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">	
			<button class = "btn btn-warning" name = "edit_cliente"><span class = "glyphicon glyphicon-edit"></span> Guardar Cambios</button>
		</div>
	</form>		
</div>
