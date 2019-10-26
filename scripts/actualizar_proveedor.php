<?php
$proveedor=$_POST['proveedor'];
$tipo=$_POST['tipo'];
$ciudad=$_POST['ciudad'];
$contacto=$_POST['contacto'];
$telefono=$_POST['telefono'];
$celular=$_POST['celular'];
$correo=$_POST['correo'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE proveedores SET tipo = '$tipo',ciudad = '$ciudad', contacto = '$contacto' , telefono = '$telefono' , celular='$celular', correo='$correo' WHERE id_proveedor  = ' " . $proveedor. " ' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error());

mysqli_close($con);
?>











