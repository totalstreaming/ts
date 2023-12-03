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
		<link rel = "stylesheet" type = "text/css" href = "css/chosen.min.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
	</head>
	<body style = "background-color:#d3d3d3;">
		<nav class = "navbar navbar-default navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<img src = "images/+tv.jpg" width = "50px" height = "50px" />
					<h4 class = "navbar-text navbar-right">Total  Streaming</h4>
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
							<li><a href = "cliente.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-user"></i> Cliente</a></li>
						</ul>
					</li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = "cuenta.php"><i class = "glyphicon glyphicon-cuenta"></i> Plataformas</a></li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-th"></i> Tipo de registro</a>
						<ul style = "list-style-type:none;">
							<li><a href = "asignar_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Asignacion de Cuenta</a></li>
							<li><a href = "devolver_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Deshabilitacion de Cuenta</a></li>
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
				<div class = "alert alert-info">Transacción / Deshabilitacion</div>
				<form method = "POST" action = "devolver.php" enctype = "multipart/form-data">	
					<table id = "table" class = "table table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>Cliente</th>
								<th>Plataforma</th>
								<th>Correo Electronico(EMPRESA)</th>
								<th>Estado de la Cuenta</th>
								<th>Fecha de Deshabilitacion</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$qreturn = $conn->query("SELECT * FROM `borrowing`") or die(mysqli_error($conn));
								while($freturn = $qreturn->fetch_array()){
							?>
							<tr>
								<td>
									<?php
										$qcliente = $conn->query("SELECT * FROM `cliente` WHERE `cliente_no` = '$freturn[cliente_no]'") or die(mysqli_error($conn));
										$fcliente = $qcliente->fetch_array();
										echo $fcliente['nombre']."".$fcliente['apellidos'];
									?>
								</td>
								<td>
									<?php
										$qcuenta = $conn->query("SELECT * FROM `cuenta` WHERE `cuenta_id` = '$freturn[cuenta_id]'") or die(mysqli_error($conn));
										$fcuenta = $qcuenta->fetch_array();
										echo $fcuenta['plataforma'];
									?>
								</td>
								<td>
									<?php
										$qcuenta = $conn->query("SELECT * FROM `cuenta` WHERE `cuenta_id` = '$freturn[cuenta_id]'") or die(mysqli_error($conn));
										$fcuenta = $qcuenta->fetch_array();
										echo $fcuenta['correo_electronico'];
									?>
								</td>
								<td><?php echo $freturn['status']?></td>
								<td><?php echo date("m-d-Y", strtotime($freturn['date']))?></td>
								<td>
									<?php 
										if($freturn['status'] == 'Returned'){
										echo '<center><button disabled = "disabled" class = "btn btn-primary" type = "button" href = "#" data-toggle = "modal" data-target = "#return"><span class = "glyphicon glyphicon-check"></span> Deshabilitada </button></center>';	
										}else{
										echo '<input type = "hidden" name = "borrow_id" value = "'.$freturn['borrow_id'].'"/><center><button class = "btn btn-primary"  data-toggle = "modal" data-target = "#return"><span class = "glyphicon glyphicon-unchecked"></span> Deshabilitar ? </button></center>';
										
									}
									?>
								</td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				<br />
				<br />
				<br />
			</div>
		</div>
		<nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
				<label class = "navbar-text pull-left"></label>
				<label class = "navbar-text pull-right">Total  Streaming Proyecto final 2023 Total  Streaming</label>
			</div>
		</nav>
	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
	<script src = "js/sidebar.js"></script>
	<script src = "js/jquery.dataTables.js"></script>
	<script src = "js/chosen.jquery.min.js"></script>	
	<script type = "text/javascript">
		$(document).ready(function(){
			$("#cliente").chosen({ width:"auto" });	
		})
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$("#table").DataTable();
		});
	</script>
</html>