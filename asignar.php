<?php
	require_once 'connect.php';
	if(!ISSET($_POST['cliente_no'])){	
		echo '
			<script type = "text/javascript">
				alert("Seleccione un cliente primero");
				window.location = "asignar_cuenta.php";
			</script>
		';
	}else{
		if(!ISSET($_POST['selector'])){
			echo '
				<script type = "text/javascript">
					alert("Seleccione una cuenta!");
					window.location = "asignar_cuenta.php";
				</script>
			';
		}else{
			foreach($_POST['selector'] as $key=>$value){
				$cuenta_qty = $value;
				$cliente_no = $_POST['cliente_no'];
				$cuenta_id = $_POST['cuenta_id'][$key];
				$date = date("Y-m-d", strtotime("+8 HOURS"));
				$conn->query("INSERT INTO `borrowing` VALUES('', '$cuenta_id', '$cliente_no', '$cuenta_qty', '$date', 'Borrowed')") or die(mysqli_error($conn));
				echo '
					<script type = "text/javascript">
						alert("La cuenta se asigno al cliente de manera correcta");
						window.location = "asignar_cuenta.php";
					</script>
				';
			}
		}	
	}	