<?php
$usuario1=$_POST['usuario1'];
$usuario=$_POST['usuario'];
$password=$_POST['password'];
$tipo=$_POST['tipo'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query7= " UPDATE usuarios SET id_usuario='$usuario1', usuario = '$usuario', password ='$password',tipo ='$tipo' WHERE id_usuario  = ' " . $usuario1. " ' ";

$resultado=mysqli_query($con, $query7) or die (mysqli_error()); 
mysqli_close($con);
?>

