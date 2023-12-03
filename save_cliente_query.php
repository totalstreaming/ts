<?php
require_once 'connect.php';

if (isset($_POST['save_cliente'])) {
    $cliente_no = $_POST['cliente_no'];
    $nombre = $_POST['nombre'];
    $correo_electronico = $_POST['correo_electronico'];
    $apellidos = $_POST['apellidos'];
    $cuenta_streaming = $_POST['cuenta_streaming'];
    $section = $_POST['section'];

    // Verificar si existen cuentas disponibles con el término 'generico' en 'usuario_generico'
    $checkCuentasDisponibles = "SELECT COUNT(*) AS cuenta_count FROM `cuenta` WHERE `usuario_generico` LIKE '%generico%'";
    $resultCuentasDisponibles = $conn->query($checkCuentasDisponibles);
    $rowCuentasDisponibles = $resultCuentasDisponibles->fetch_assoc();
    $cuentasDisponibles = $rowCuentasDisponibles['cuenta_count'];

    if ($cuentasDisponibles == 0) {
        echo '
            <script type="text/javascript">
                alert("No hay cuentas disponibles. Cree nuevas cuentas.");
                window.location = "cliente.php";
            </script>
        ';
    } else {
        // Verificar si la plataforma existe en la tabla 'cuenta'
        $checkPlataformaExistente = "SELECT COUNT(*) AS plataforma_count FROM `cuenta` WHERE `plataforma` = '$cuenta_streaming' AND `usuario_generico` LIKE '%generico%'";
        $resultPlataformaExistente = $conn->query($checkPlataformaExistente);
        $rowPlataformaExistente = $resultPlataformaExistente->fetch_assoc();
        $plataformaExistente = $rowPlataformaExistente['plataforma_count'];

        if ($plataformaExistente == 0) {
            echo '
                <script type="text/javascript">
                    alert("No existen cuentas disponibles en este momento ....Compre una nueva cuenta y Cree una nueva plataforma carguela y vuelva a intentarlo.");
                    window.location = "cliente.php";
                </script>
            ';
        } else {
            // Insertar datos en la tabla 'cliente'
            $insertCliente = "INSERT INTO `cliente` VALUES('', '$cliente_no', '$nombre', '$correo_electronico', '$apellidos', '$cuenta_streaming', '$section')";
            $resultInsertCliente = $conn->query($insertCliente);

            if ($resultInsertCliente) {
                // Actualizar 'usuario_generico' en 'cuenta' con 'cliente_no'
                $updateCuenta = "UPDATE `cuenta` SET `usuario_generico` = '$cliente_no' WHERE `plataforma` = '$cuenta_streaming' AND `usuario_generico` LIKE '%generico%' LIMIT 1";
                $resultUpdateCuenta = $conn->query($updateCuenta);

                if ($resultUpdateCuenta) {
                    echo '
                        <script type="text/javascript">
                            alert("Datos guardados exitosamente y actualización realizada");
                            window.location = "cliente.php";
                        </script>
                    ';
                } else {
                    echo '
                        <script type="text/javascript">
                            alert("Error al actualizar usuario_generico en cuenta");
                            window.location = "cliente.php";
                        </script>
                    ';
                }
            } else {
                echo '
                    <script type="text/javascript">
                        alert("Error al guardar el cliente");
                        window.location = "cliente.php";
                    </script>
                ';
            }
        }
    }
	if ($resultUpdateCuenta) {
		// Extraer los últimos 4 dígitos de 'usuario_generico'
		$lastFourDigits = substr($cliente_no, -4);
	
		// Actualizar 'comentario' en 'cuenta' con los últimos 4 dígitos de 'usuario_generico'
		$updateComentario = "UPDATE `cuenta` SET `comentario` = '$lastFourDigits' WHERE `plataforma` = '$cuenta_streaming' AND `usuario_generico` = '$cliente_no'";
		$resultUpdateComentario = $conn->query($updateComentario);
	
		if ($resultUpdateComentario) {
			echo '
				<script type="text/javascript">
					alert("Datos guardados exitosamente y actualización realizada en el comentario");
					window.location = "cliente.php";
				</script>
			';
		} else {
			echo '
				<script type="text/javascript">
					alert("Error al actualizar el comentario en la cuenta");
					window.location = "cliente.php";
				</script>
			';
		}
	}
}
?>
