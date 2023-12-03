<?php
	require_once 'connect.php';
	$conn->query("DELETE FROM `cuenta` WHERE `cuenta_id` = '$_REQUEST[cuenta_id]'") or die(mysqli_error($conn));
	$conn->query("DELETE FROM `borrowing` WHERE `cuenta_id` = '$_REQUEST[cuenta_id]'") or die(mysqli_error($conn));
	header("location: cuenta.php");