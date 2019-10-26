<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$nombre=$_POST['nombre'];
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$año=$_POST['ano'];
$placa=$_POST['placa'];
$tipo=$_POST['tipo'];
$fecha=$_POST['fecha'];
$departamento=$_POST['departamento'];
$empresa=$_POST['empresa'];
$medida_uso=$_POST['medida_uso'];
$rendimiento=$_POST['rendimiento'];
$serie=$_POST['serie'];
$status=$_POST['status'];

$insertar="INSERT INTO vehiculo(vehiculo, marca, modelo, ano, placa, tipo, fecha, departamento, empresa, medida_uso, rendimiento,no_serie,status) VALUES ('$nombre','$marca','$modelo','$año','$placa','$tipo','$fecha','$departamento','$empresa','$medida_uso','$rendimiento','$serie', '$status')";

mysqli_query($con,$insertar) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>