<!DOCTYPE html>
<?php
	require_once 'valid.php';
?>	
<html lang = "eng">
	<head>
		<title>Total  Streaming</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	</head>
	<body style = "background-color:#d3d3d3;">
		<nav class = "navbar navbar-default navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<img src = "images/+tv.jpg" width = "50px" height = "50px" />
					<h4 class = "navbar-text navbar-right">Total  Steaming</h4>
				</div>
			</div>
		</nav>
		<div class = "container-fluid">
			<div class = "col-lg-2 well" style = "margin-top:60px;">
				<div class = "container-fluid">
					<img src = "images/user.png" width = "100px" height = "100px"/>
					<br />
					<br />
					<label class = "text-muted"><?php require'account.php'; echo $name;?></label>
				</div>
				<hr style = "border:1px dotted #d3d3d3;"/>
				<ul id = "menu" class = "nav menu">
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = "home.php"><i class = "glyphicon glyphicon-home"></i> Inicio</a></li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-tasks"></i> Administrador de Usuarios</a>
						<ul style = "list-style-type:none;">
							<li><a href = "permisos.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-user"></i> Administrador</a></li>
							<li><a href = "cliente.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-user"></i> Clientes</a></li>
						</ul>
					</li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = "cuenta.php"><i class = "glyphicon glyphicon-cuenta"></i> PLATAFORMAS</a></li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-th"></i> TIPO DE REGISTRO</a>
						<ul style = "list-style-type:none;">
							<li><a href = "asignar_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i>ASIGNACION DE CUENTA</a></li>
							<li><a href = "devolver_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> DESHABILITACION DE CUENTA</a></li>
						</ul>
					</li>


					
					
					<li><a  style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-cog"></i> Configuración</a>
						<ul style = "list-style-type:none;">
							<li><a style = "font-size:15px;" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Cerrar Sesión</a></li>
						</ul>
					</li>
				</ul>
			</div>
			

			<div class = "col-lg-1"></div>
			<div class = "col-lg-9 well" style = "margin-top:60px;">
		
			<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Cuentas</title>
</head>
<body>
    <h1>Consulta de Cuentas y Plataformas</h1>
    <form method="post" action="home.php">

	    
	<button type="submit" name="consultar" value="Netflix" style="background-image: url('images/button (1).png'); background-size: contain; width: 125px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
<button type="submit" name="consultar" value="Prime Video" style="background-image: url('images/button (6).png'); background-size: contain; width: 160px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
<button type="submit" name="consultar" value="Star+" style="background-image: url('images/button (4).png'); background-size: contain; width: 110px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
<button type="submit" name="consultar" value="Paramount" style="background-image: url('images/button (3).png'); background-size: contain; width: 165px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
<button type="submit" name="consultar" value="HBO Max" style="background-image: url('images/button (5).png'); background-size: contain; width: 130px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
<button type="submit" name="consultar" value="Disney+" style="background-image: url('images/button (2).png'); background-size: contain; width: 125px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
<button type="submit" name="cerrarConsulta" value="cerrarConsulta" style="background-image: url('images/IMGC.jpg'); background-size: contain; width: 50px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"></button>

        </form>

    <?php
    if (isset($_POST['consultar'])) {
        // Datos de conexión a la base de datos
        $servername = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
        $username = "id21607853_streaming";
        $password = "Totalstr2023*";
        $database = "id21607853_bdtotalst";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Obtener la plataforma seleccionada
        $plataforma = $_POST['consultar'];

        // Consulta SQL para extraer datos de la tabla "cuenta" con la plataforma seleccionada
        $qcuenta = $conn->query("SELECT * FROM cuenta WHERE plataforma = '$plataforma'") or die(mysqli_error($conn));
    ?>

    

    <table id="table" class="table table-bordered">
        <thead class="alert-success">
            <tr>
                <th>Cuenta Streaming</th>
                <th>CORREO DE LA CUENTA(EMPRESA)</th>
                <th>USUARIO :</th>
				<th>PASSWORD :</th>
                <th>Fecha de Creación</th>
                <th>Disponible</th>
               
            </tr>
        </thead>
        <tbody>
        <?php
        while ($fcuenta = $qcuenta->fetch_array()) {
        ?>
            <tr>
                <td><?php echo $fcuenta['plataforma']?></td>
                <td><?php echo $fcuenta['correo_electronico']?></td>
                <td><?php echo $fcuenta['usuario_generico']?></td>
				<td><?php echo $fcuenta['comentario']?></td>
                <td><?php echo date("m-d-Y", strtotime($fcuenta['fecha_de_creacion']))?></td>
                <td><?php echo $fcuenta['qty']?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <script>
        document.getElementById('cerrarConsulta').addEventListener('click', function() {
            document.getElementById('table').style.display = 'none';
        });
    </script>

    <?php
    }
    ?>
	

</body>
</html>
</html>

    </form>
</body>
</html>

			</div>
			</head>
	

		
		

			<div class="col-lg-1"></div>
<div class="col-lg-9 well" style="margin-top: 60px;">
<!DOCTYPE html>
<html>





<body>
    <h1><Fig></Fig>Cuentas asignadas y fechas de pago</h1>
    <form method="post" action="home.php">
        <button type="submit" name="consultarNetflix" value="Netflix" style="background-image: url('images/button (1).png'); background-size: contain; width: 125px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';"></button>
        <!-- Otros botones para las diferentes plataformas -->
        <button type="submit" name="cerrarConsulta" value="cerrarConsulta" style="background-image: url('images/IMGC.jpg'); background-size: contain; width: 50px; height: 40px; border: none; outline: none; transition: transform 0.3s ease-in-out; margin-right: 8px;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"></button>
    </form>

    <?php
    if (isset($_POST['consultarNetflix'])) {
        // Aquí va la lógica para la consulta específica de Netflix
        // Datos de conexión a la base de datos
        $servername = "localhost";
        $username = "id21607853_streaming";
        $password = "Totalstr2023*";
        $database = "id21607853_bdtotalst";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Consulta SQL para extraer los datos filtrados y relacionados de las tablas "borrowing" y "cliente" específicamente para Netflix
        $qcuenta = $conn->query("SELECT b.cliente_no, b.status, b.date, c.nombre, c.apellidos, c.correo_electronico
                                FROM borrowing b
                                INNER JOIN cliente c ON b.cliente_no = c.cliente_no
                                WHERE b.status LIKE '%Borrowed%'") or die(mysqli_error($conn));
    ?>
    <a href = "correos.php" style = "font-size:15px;"><i class = "glyphicon glyphicon"></i> Enviar correo</a></br>
        <table id="table" class="table table-bordered">
            <thead class="alert-success">
                <tr>
                    <th>Cliente</th>
                    <th>Correo del cliente</th>
                    <th>Estatus</th>
                    <th>Fecha de Activación</th>
                    <!-- Agrega más encabezados según sea necesario -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fcuenta = $qcuenta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $fcuenta['nombre'] . ' ' . $fcuenta['apellidos']?></td>
                        <td><?php echo $fcuenta['correo_electronico']?></td>
                        <td><?php echo $fcuenta['status']?></td>
                        <td><?php echo $fcuenta['date']?></td>
                        <!-- Puedes agregar más celdas según los campos de tu tabla borrowing -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <script>
            // Función para ocultar la tabla al hacer clic en el botón 'cerrarConsulta'
            document.getElementById('cerrarConsulta').addEventListener('click', function() {
                document.getElementById('table').style.display = 'none';
            });
        </script>
    <?php
    }
    ?>
	
</body>
</html>

		
		<nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
				<label class = "navbar-text pull-right">Total  Streaming  Proyecto final 2023 Total  Streaming</label>
			</div>
		</nav>
	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
	<script src = "js/sidebar.js"></script>

	
</html>
