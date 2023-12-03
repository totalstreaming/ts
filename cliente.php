<?php
	require_once 'valid.php';
?>	
<!DOCTYPE html>
<html lang = "eng">
	<head>
		<title>Total  Streaming</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
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
				<div class = "container-fluid" style = "word-wrap:break-word;">
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
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = "cuenta.php"><i class = "glyphicon glyphicon-book"></i> Plataformas</a></li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-th"></i> Tipo de registro</a>
						<ul style = "list-style-type:none;">
							<li><a href = "asignar_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Asignacion de cuenta </a></li>
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
				<div class = "alert alert-info">Cuentas / Clientes</div>
					<button id = "add_cliente" type = "button" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Agregar nuevo</button>
					<button id = "show_cliente" type = "button" style = "display:none;" class = "btn btn-success"><span class = "glyphicon glyphicon-circle-arrow-left"></span> Volver</button>
					
					<a href = "correos.php" style = "font-size:15px;"><i class = "glyphicon glyphicon"></i> Enviar correo</a></br>
					<br />
					<br />
					<div id = "cliente_table">
						<table id = "table" class = "table table-bordered">
							<thead class = "alert-success">
								<tr>
									<th>ID Cliente</th>
									<th>Primer Nombre</th>
									<th>Apellidos</th>
									<th>Correo Electronico</th>
									<th>Plataforma</th>
									<th>Fecha de Afiliacion</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$qcliente = $conn->query("SELECT * FROM `cliente`") or die(mysqli_error($conn));
									while($fcliente = $qcliente->fetch_array()){
								?>
								<tr>
									<td><?php echo $fcliente['cliente_no']?></td>
									<td><?php echo $fcliente['nombre']?></td>									
									<td><?php echo $fcliente['apellidos']?></td>
									<td><?php echo $fcliente['correo_electronico']?></td>
									<td><?php echo $fcliente['cuenta_streaming']?></td>
									<td><?php echo date("m-d-Y", strtotime($fcliente['section']))?></td>
		
									<td><a  value = "<?php echo $fcliente['cliente_no']?>" class = "btn btn-danger delcliente_id"><span class = "glyphicon glyphicon-remove"></span> Eliminar</a> <a class = "btn btn-warning ecliente_id" value = "<?php echo $fcliente['cliente_no']?>"><span class = "glyphicon glyphicon-edit"></span> Editar</a></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
					<div id = "edit_form"></div>
					<div id = "cliente_form" style = "display:none;">
						<div class = "col-lg-3"></div>
						<div class = "col-lg-6">
							<form method = "POST" action = "save_cliente_query.php" enctype = "multipart/form-data">	
								<div class = "form-group">	
									<label>ID Cliente:</label>
									<input type = "text" name = "cliente_no" required = "required" class = "form-control" />
								</div>	
								<div class = "form-group">	
									<label>Primer Nombre:</label>
									<input type = "text" name = "nombre" required = "required" class = "form-control" />
								</div>
								<div class = "form-group">	
									<label>Correo Electronico:</label>
									<input type = "text" required = "required"name = "correo_electronico" class = "form-control" />
								</div>	
								<div class = "form-group">	
									<label>Apellidos:</label>
									<input type = "text" required = "required" name = "apellidos" class = "form-control" />
								</div>
								<div class = "form-group">
									<label>Plataforma:</label>
									<select name="cuenta_streaming" required="required" class="form-control">
     					    <option value="Netflix">Netflix</option>
      						<option value="Prime Video">Prime Video</option>
      						<option value="Star+">Star+</option>
      						<option value="Paramount">Paramount</option>
      						<option value="HBO Max">HBO Max</option>
      						<option value="Disney+">Disney+</option>
    						</select>
  						</div>
								<div class = "form-group">	
									<label>Fecha de Afiliacion</label>
									<input type = "date" name = "section"  required = "required" class = "form-control" />
									
								</div>
								<div class = "form-group">	
									<button class = "btn btn-primary" name = "save_cliente"><span class = "glyphicon glyphicon-save"></span> Enviar</button>
								</div>
							</form>		
						</div>	
					</div>
			</div>
		</div>
		<br />
		<br />
		<br />
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
	<script type = "text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$('#add_cliente').click(function(){
				$(this).hide();
				$('#show_cliente').show();
				$('#cliente_table').slideUp();
				$('#cliente_form').slideDown();
				$('#show_cliente').click(function(){
					$(this).hide();
					$('#add_cliente').show();
					$('#cliente_table').slideDown();
					$('#cliente_form').slideUp();
				});
			});
		});
	</script>
	
	<script type = "text/javascript">
		$(document).ready(function(){
			$result = $('<center><label>Deleting...</label></center>');
			$('.delcliente_id').click(function(){
				$cliente_id = $(this).attr('value');
				$(this).parents('td').empty().append($result);
				$('.delcliente_id').attr('disabled', 'disabled');
				$('.ecliente_id').attr('disabled', 'disabled');
				setTimeout(function(){
					window.location = 'delete_cliente.php?cliente_id=' + $cliente_id;
				}, 1000);
			});
			$('.ecliente_id').click(function(){
				$cliente_id = $(this).attr('value');
				$('#show_cliente').show();
				$('#show_cliente').click(function(){
					$(this).hide();
					$('#edit_form').empty();
					$('#cliente_table').show();
					$('#add_cliente').show();
				});
				$('#cliente_table').fadeOut();
				$('#add_cliente').hide();
				$('#edit_form').load('load_cliente.php?cliente_id=' + $cliente_id);
			});
		});
	</script>
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