<?php session_start();

require 'admin/config.php';
require 'functions.php';

// comprobar session
if (!isset($_SESSION['usuario'])) 
{
  header('Location: '.RUTA.'login.php');
}

$conexion = conexion($bd_config);
$admin = iniciarSession('usuarios', $conexion);

if ($admin['tipo'] == 'administrador')
 {
  // traer el nombre del usuario
  $admin = iniciarSession('usuarios', $conexion);
  require 'views/admin.views.php';
} 
else 
{
  header('Location: '.RUTA.'validar.php');
}

?>
