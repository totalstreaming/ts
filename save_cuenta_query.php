<?php
require_once 'connect.php';

if (isset($_POST['save_cuenta'])) {
    $plataforma = $_POST['plataforma'];
    $cuenta_desc = $_POST['cuenta_desc'];
    $correo_electronico = $_POST['correo_electronico'];
    $fecha_de_creacion = $_POST['fecha_de_creacion'];
    $qty = $_POST['qty'];

    // Inicializa la variable $numUsuariosGenericos en 5 como valor por defecto
    $numUsuariosGenericos = 5;

    switch ($plataforma) {
        	case 'Netflix':
			case 'HBO Max':
            $numUsuariosGenericos = 5;
            break;
			case 'Star+':
       	    case 'Disney+':
            $numUsuariosGenericos = 7;
            break;
        
           case 'Paramount':
           case 'Prime Video':
            $numUsuariosGenericos = 6;
            break;
        default:
            $numUsuariosGenericos = 5;
            break;
    }

    for ($i = 1; $i <= $numUsuariosGenericos; $i++) {
        $usuario_generico = "generico " . $i;

        $conn->query("INSERT INTO `cuenta` VALUES('', '$plataforma', '$cuenta_desc', '$usuario_generico', '$correo_electronico', '$fecha_de_creacion', '$qty')") or die(mysqli_error($conn));
    }

    echo '
        <script type = "text/javascript">
            alert("Datos guardados exitosamente.");
            window.location = "cuenta.php";
        </script>
    ';
}

