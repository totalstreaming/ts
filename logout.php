<?php
session_start();
unset($_SESSION['admin_id']); // Elimina la variable de sesión 'admin_id'
session_destroy(); // Opcional: puedes usar session_destroy() para destruir la sesión por completo
header('location: index.php');
