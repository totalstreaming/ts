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
					<img src = "images/+tv.jpg" width = "35px" height = "35px" />
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
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-th"></i> Tipo de registros</a>
						<ul style = "list-style-type:none;">
							<li><a href = "asignar_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Asignacion de Cuenta</a></li>
							<li><a href = "devolver_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Deshabilitacion de cuenta</a></li>
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
				<div class = "alert alert-info">Transacción / Asignacion de Cuenta</div>
				<form method = "POST" action = "asignar.php" enctype = "multipart/form-data">
					<div class = "form-group pull-left">	
						<label>Nombre del cliente:</label>
						<br />
						<select name = "cliente_no" id = "cliente">
							<option value = "" selected = "selected" disabled = "disabled">Seleccione una opción</option>
							<?php
								$qborrow = $conn->query("SELECT * FROM `cliente` ORDER BY `apellidos`") or die(mysqli_error($conn));
								while($fborrow = $qborrow->fetch_array()){
							?>
								<option value = "<?php echo $fborrow['cliente_no']?>"><?php echo $fborrow['nombre']." ".$fborrow['apellidos']?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class = "form-group pull-right">	
						<button name = "save_borrow" class = "btn btn-primary"><span class = "glyphicon glyphicon-thumbs-up"></span> Asignar Cuenta</button>
					</div>
					<table id = "table" class = "table table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>Status de Cuenta</button>
								<th>Plataforma</th>
								<th>Usuario Asignado</th>
								<th>Correo  (Asignado Principal)</th>
								<th>Fecha de creacion (Cuenta Plataforma)</th>
								<th>Cantidad</th>
								<th>Disponible</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$q_cuenta = $conn->query("SELECT * FROM `cuenta`") or die(mysqli_error($conn));
								while($f_cuenta = $q_cuenta->fetch_array()){
								$q_borrow = $conn->query("SELECT SUM(qty) as total FROM `borrowing` WHERE `cuenta_id` = '$f_cuenta[cuenta_id]' && `status` = 'Borrowed'") or die(mysqli_error($conn));
								$new_qty = $q_borrow->fetch_array();
								$total = $f_cuenta['qty'] - $new_qty['total'];
							?> 
							<tr>
								<td>
									<?php
										if($total == 0){
											echo "<center><label class = 'text-danger'> Plataforma Asignada </label></center>";
										}else{
											echo '<input type = "hidden" name = "cuenta_id[]" value = "'.$f_cuenta['cuenta_id'].'"><center><input type = "checkbox" name = "selector[]" value = "1"></center>';
										}
									?>
								</td>
								<td><?php echo $f_cuenta['plataforma']?></td>
								<td><?php echo $f_cuenta['usuario_generico']?></td>
								<td><?php echo $f_cuenta['correo_electronico']?></td>
								<td><?php echo date("m-d-Y", strtotime($f_cuenta['fecha_de_creacion']))?></td>
								<td><?php echo $f_cuenta['qty']?></td>
								<td><?php echo $total?></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
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