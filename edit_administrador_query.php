<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_admin'])){
		$admin_id = $_POST['admin_id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nombre = $_POST['nombre'];
		$correo_electronico = $_POST['correo_electronico'];
		$apellidos = $_POST['apellidos'];
		$Categoria = $_POST['Categoria'];
		$q_admin = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$admin_id'") or die(mysqli_error($conn));
		$v_admin = $q_admin->num_rows;
		if($v_admin == 1){
			echo '
				<script type = "text/javascript">
					alert("Nombre de usuario ya existe");
					window.location = "admin.php";
				</script>
			';
		}else{
			$conn->query("UPDATE `admin` SET `username` = '$username', `password` = '$password', `nombre` = '$nombre', `correo_electronico` = '$correo_electronico', `apellidos` = '$apellidos' WHERE `admin_id` = '$_REQUEST[admin_id]'") or die(mysqli_error($conn));
			echo '
				<script type = "text/javascript">
					alert("Guardar Cambios");
					window.location = "admin.php";
				</script>
			';
		}
	}	