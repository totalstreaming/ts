<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_cuenta'])){
		$plataforma = $_POST['plataforma'];
		$cuenta_desc = $_POST['cuenta_desc'];
		$usuario_generico = $_POST['usuario_generico'];
		$correo_electronico = $_POST['correo_electronico'];
		$fecha_de_creacion = $_POST['fecha_de_creacion'];
		$qty = $_POST['qty'];
		$conn->query("UPDATE `cuenta` SET `plataforma` = '$plataforma', `comentario` = '$cuenta_desc', `usuario_generico` = '$usuario_generico', `correo_electronico` = '$correo_electronico', `fecha_de_creacion` = '$fecha_de_creacion', `qty` = '$qty' WHERE `cuenta_id` = '$_REQUEST[cuenta_id]'") or die(mysqli_error($conn));
		echo '
			<script type = "text/javascript">
				alert("Guardar Cambios");
				window.location = "cuenta.php";
			</script>
		';
	}