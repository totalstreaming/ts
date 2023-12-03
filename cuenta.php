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
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = "home.php"><i class = "glyphicon glyphicon-home"></i> INICIO</a></li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-tasks"></i> Administrador de Usuarios</a>
						<ul style = "list-style-type:none;">
							<li><a href = "permisos.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-user"></i> Administrador</a></li>
							<li><a href = "cliente.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-user"></i> Clientes</a></li>
						</ul>
					</li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = "cuenta.php"><i class = "glyphicon glyphicon-cuenta"></i> Plataformas</a></li>
					<li><a style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-th"></i> Tipo de registros</a>
						<ul style = "list-style-type:none;">
							<li><a href = "asignar_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Asignacion de Cuenta</a></li>
							<li><a href = "devolver_cuenta.php" style = "font-size:15px;"><i class = "glyphicon glyphicon-random"></i> Deshabilitacion de Cuenta</a></li>
						</ul>
					</li>
					<li><a  style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-cog"></i> CONFIGURACION</a>
						<ul style = "list-style-type:none;">
							<li><a style = "font-size:15px;" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> CERRAR SESION</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class = "col-lg-1"></div>
			<div class = "col-lg-9 well" style = "margin-top:60px;">
				<div class = "alert alert-info">CUENTAS STREAMING</div>
					<button id = "add_cuenta" type = "button" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Agregar nuevo</button>
					<button id = "show_cuenta" type = "button" style = "display:none;" class = "btn btn-success"><span class = "glyphicon glyphicon-circle-arrow-left"></span> Volver</button>
					<br />
					<br />
					<div id = "cuenta_table">
						<table id = "table" class = "table table-bordered">
							<thead class = "alert-success">
								<tr>
									<th>Cuenta Streaming</th>
									<th>CORREO DE LA CUENTA(EMPRESA)</th>
									<th>USUARIO GENERICO:</th>
									<th>Fecha de Creación</th>
									<th>Disponible</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$qcuenta = $conn->query("SELECT * FROM `cuenta`") or die(mysqli_error($conn));
									while($fcuenta = $qcuenta->fetch_array()){
										
								?>
								<tr>
									<td><?php echo $fcuenta['plataforma']?></td>
									<td><?php echo $fcuenta['correo_electronico']?></td>
									<td><?php echo $fcuenta['usuario_generico']?></td>
									<?php
$fechaCreacion = strtotime($fcuenta['fecha_de_creacion']);
$fechaActual = time();
$dias_despues_de_ultimo_pago = floor(($fechaActual - $fechaCreacion) / (60 * 60 * 24));
$color = 'green'; // Color de fondo predeterminado
$leyenda = '';

if ($dias_despues_de_ultimo_pago >= 27) {
    if ($dias_despues_de_ultimo_pago % 27 == 0) {
        $color = 'orange';
        $leyenda = 'Pagar cuenta para evitar corte llevas sin actualizar el pago  '  .$dias_despues_de_ultimo_pago;
    } elseif ($dias_despues_de_ultimo_pago < 28) {
        $leyenda = 'Días restantes del mes'.$dias_despues_de_ultimo_pago;
    } else {
        $color = 'red';
        $leyenda = 'URGENTE PAGAR CUENTA LLEVA EN USO SIN ACTUALIZAR EL PAGO '.$dias_despues_de_ultimo_pago  ;
    }
} else {
    $leyenda = 'Días transcurridos desde la fecha de creación: ' . $dias_despues_de_ultimo_pago;
}
?>

<td style="background-color: <?php echo $color; ?>; color: white;">
    <?php echo date("m-d-Y", strtotime($fcuenta['fecha_de_creacion'])); ?><br>
    <?php echo $leyenda; ?>
</td>

									<td><?php echo $fcuenta['qty']?></td>
									<td><a class = "btn btn-danger delcuenta_id" value = "<?php echo $fcuenta['cuenta_id']?>"><span class = "glyphicon glyphicon-remove"></span> Eliminar</a> <a value = "<?php echo $fcuenta['cuenta_id']?>" class = "btn btn-warning ecuenta_id"><span class = "glyphicon glyphicon-edit"></span> Editar</a></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
					<div id = "edit_form"></div>
					<div id = "cuenta_form" style = "display:none;">
						<div class = "col-lg-3"></div>
						<div class = "col-lg-6">
							<form method = "POST" action = "save_cuenta_query.php" enctype = "multipart/form-data">
							<form method="POST" action="save_cuenta_query.php" enctype="multipart/form-data">
  							<div class="form-group">
    						<label>Cuenta Streaming:</label>
    						<select name="plataforma" required="required" class="form-control">
     					    <option value="Netflix">Netflix</option>
      						<option value="Prime Video">Prime Video</option>
      						<option value="Star+">Star+</option>
      						<option value="Paramount">Paramount</option>
      						<option value="HBO Max">HBO Max</option>
      						<option value="Disney+">Disney+</option>
    						</select>
  						</div>
								<div class = "form-group">
									<label>Password</label>
									<input type = "text" name = "cuenta_desc" class = "form-control" />
								</div>
								
								<div class = "form-group">
									<label>CORREO DE LA CUENTA(EMPRESA):</label>
									<input type="email" name="correo_electronico"  class="form-control" required="required" />								</div>
								<div class = "form-group">
									<label>Fecha de Creación:</label>
									<input type = "date" name = "fecha_de_creacion" required = "required" class = "form-control" />
								</div>
								<div class="form-group">
  								
								<label>Cantidad</label>
  								<input type="number" min="0" name="qty" required="required" class="form-control" value="1" readonly />
								</div>

								<div class = "form-group">
									<button name = "save_cuenta" class = "btn btn-primary"><span class = "glyphicon glyphicon-save"></span> Enviar</button>
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
				<label class = "navbar-text pull-right">Total  Steaming &copy; Total  Streaming  Proyecto final 2023 Total  Streaming</label>
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
			$('#add_cuenta').click(function(){
				$(this).hide();
				$('#show_cuenta').show();
				$('#cuenta_table').slideUp();
				$('#cuenta_form').slideDown();
				$('#show_cuenta').click(function(){
					$(this).hide();
					$('#add_cuenta').show();
					$('#cuenta_table').slideDown();
					$('#cuenta_form').slideUp();
				});
			});
		});
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$result = $('<center><label>Eliminando...</label></center>');
			$('.delcuenta_id').click(function(){
				$cuenta_id = $(this).attr('value');
				$(this).parents('td').empty().append($result);
				$('.delcuenta_id').attr('disabled', 'disabled');
				$('.ecuenta_id').attr('disabled', 'disabled');
				setTimeout(function(){
					window.location = 'delete_cuenta.php?cuenta_id=' + $cuenta_id;
				}, 1000);
			});
			$('.ecuenta_id').click(function(){
				$cuenta_id = $(this).attr('value');
				$('#show_cuenta').show();
				$('#show_cuenta').click(function(){
					$(this).hide();
					$('#edit_form').empty();
					$('#cuenta_table').show();
					$('#cuenta_admin').show();
				});
				$('#cuenta_table').fadeOut();
				$('#add_cuenta').hide();
				$('#edit_form').load('load_cuenta.php?cuenta_id=' + $cuenta_id);
			});
			
		});
	</script>
	
</html>



