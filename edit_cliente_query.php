<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_cliente'])){
		$cliente_no = $_POST['cliente_no'];
		$nombre = $_POST['nombre'];
		$correo_electronico = $_POST['correo_electronico'];
		$apellidos = $_POST['apellidos'];
		$cuenta_streaming = $_POST['cuenta_streaming'];
		$section = $_POST['section'];
		$qcliente = $conn->query("SELECT * FROM `cliente` WHERE `cliente_no` = '$cliente_no'") or die(mysqli_error($conn));
		$vcliente = $qcliente->num_rows;
		if($vcliente['cliente_no'] == 1){
			echo '
				<script type = "text/javascript">
					alert("EL ID del estudiante ya existe");
					window.location = "cliente.php";
				</script>
			';
		}else{
			$conn->query("UPDATE `cliente` SET `cliente_no` = '$cliente_no', `nombre` = '$nombre', `correo_electronico` = '$correo_electronico', `apellidos` = '$apellidos', `cuenta_streaming` = '$cuenta_streaming', `section` = '$section' WHERE `cliente_id` = '$_REQUEST[cliente_id]'") or die(mysqli_error($conn));
			echo'
				<script type = "text/javascript">
					alert("Guardar Cambios");
					window.location = "cliente.php";
				</script>
			';
		}
	}	