<?php
require_once 'connect.php';
session_start();
$qadmin = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_SESSION[admin_id]'") or die(mysqli_error( $conn));
$fadmin = $qadmin->fetch_array();
$rol = $fadmin['Categoria'];
if($rol != 1){
    header('location: home.php');
}else{
    header('location: admin.php');
}
?>		