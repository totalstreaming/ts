<?php
	$conn = new mysqli('localhost', 'id21607853_streaming', 'Totalstr2023*', 'id21607853_bdtotalst') or die(mysqli_error($conn));
	if(!$conn){
		die("Error fatal: error de conexión!");
	}