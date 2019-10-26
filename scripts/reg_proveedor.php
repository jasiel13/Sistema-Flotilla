<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$proveedor=$_POST['proveedor'];
$tipo=$_POST['tipo'];
$ciudad=$_POST['ciudad'];
$contacto=$_POST['contacto'];
$telefono=$_POST['telefono'];
$celular=$_POST['celular'];
$correo=$_POST['correo'];

$insert="INSERT INTO proveedores(proveedor, tipo, ciudad, contacto, telefono, celular ,correo) VALUES ('$proveedor','$tipo','$ciudad','$contacto','$telefono','$celular','$correo')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>