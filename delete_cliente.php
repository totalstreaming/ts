<?php
	require_once 'connect.php';
	$conn->query("DELETE FROM `cliente` WHERE `cliente_no` = '$_REQUEST[cliente_id]'") or die(mysqli_error($conn));
	header('location: cliente.php');