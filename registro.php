<?php session_start();

require 'admin/config.php';
require 'functions.php';

//este codigo es para que el usuario de tipo usuario no entre a registro.php
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
//este codigo es para que el usuario de tipo usuario no entre a registro.php

  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = limpiarDatos($_POST['usuario']);
    $password = limpiarDatos($_POST['password']);
//sirve para encriptar la contraseña en la base de datos si funciona pero da un error en el login
    //$password = hash('sha512', $password);
    $rol = $_POST['rol'];

    $errores = '';

    // validar los campos de texto
    if (empty($usuario) || empty($password) || empty($rol))
    {
     $errores .= '<li class="error">Por favor rellene todos los campos</li>';
    }
    else{
        // validacion de que el usuario no exista
        $conexion = conexion($bd_config);
        $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
        $statement->execute([
            ':usuario' => $usuario
        ]);
        $resultado = $statement->fetch();

        if ($resultado != false)
        {
         $errores .= '<li class="error">Este usuario ya existe</li>';
        }
     }  
    if($errores == ''){
        $conexion = conexion($bd_config);
        $statement = $conexion->prepare('INSERT INTO usuarios (id_usuario, usuario, password, tipo) VALUES(null, :usuario, :password, :tipo)');
        $statement->execute([
            ':usuario' => $usuario,
            ':password' => $password,
            ':tipo' => $rol
        ]);

        header('Location: '.RUTA.'login.php');

    }
  }
//este codigo es para que el usuario de tipo usuario no entre a registro.php
}
else 
{
  header('Location: '.RUTA.'validar.php');
}
//este codigo es para que el usuario de tipo usuario no entre a registro.php
require 'views/registro.views.php';
?>
