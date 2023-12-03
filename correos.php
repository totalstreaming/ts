<?php

					use PHPMailer\PHPMailer\PHPMailer;
					use PHPMailer\PHPMailer\Exception;

					// Incluir la biblioteca PHPMailer
					require 'C:\xampp\htdocs\TotalStreaming\src/Exception.php'; 
					require 'C:\xampp\htdocs\TotalStreaming\src/PHPMailer.php'; 
					require 'C:\xampp\htdocs\TotalStreaming\src/SMTP.php'; 

					require_once 'connect.php';
					// Configuración del correo electrónico
					$destinatario = "muchomas.tv02@gmail.com";
					$asunto = "Renovacion de cuenta";
					$mensaje = "Estimado usuario 
                    +TV le saluda 
                    Le agradecemos su preferencia.
                    Se le recuerda que hoy vence su suscripcion, ponemos a su disposición el numero 7003-5367 para realizar el SINPE.
                    Una vez realizado su pago por favor enviarnos el comprobante por este medio
                    Gracias 
                    Quedamos atentos.";

					// Configuración de PHPMailer
					$mail = new PHPMailer(true); // Habilitar excepciones

				try {
    				// Configuración del servidor SMTP
    				$mail->isSMTP();
    				$mail->Host = 'smtp.gmail.com';
    				$mail->SMTPAuth = true;
    				$mail->Username = 'muchomas.tv02@gmail.com';
    				$mail->Password = 'yadu gzww ufuq btny';
    				$mail->SMTPSecure = 'TLS';
    				$mail->Port = 587;

    				// Configuración del remitente
    				$mail->setFrom('muchomas.tv02@gmail.com', '+TV');

    				// Consulta para obtener las direcciones de correo electrónico
    				$query = "SELECT correo_electronico FROM cliente";
    				$resultado = $conn->query($query);

    				// Envío de correos electrónicos
    			while ($fila = $resultado->fetch_assoc()) {
        			$para = $fila['correo_electronico'];
        			$mail->addAddress($para);
        			$mail->Subject = $asunto;
        			$mail->Body = $mensaje;
					$mail->send();
					echo "Correo enviado a: $para <br>";

        			// Limpiar los destinatarios para el próximo bucle
        			$mail->clearAddresses();
   					}

    				echo '
					<script type = "text/javascript">
						alert("Todo los correos se han enviado de forma correcta.");
						window.location = "cliente.php";
					</script>
				';
					} catch (Exception $e) {
   					 echo "Error al enviar el correo: {$mail->ErrorInfo}";
					}

					// Cerrar la conexión a la base de datos
					$conn->close();
				?>