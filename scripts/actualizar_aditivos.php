<?php
$id_aditivos=$_POST['id_aditivos'];
$aditivo5=$_POST['aditivo5'];
$fecha_registro2=$_POST['fecha_registro2'];
$marca2=$_POST['marca2'];
$litros1=$_POST['litros1'];
$costo_litro1=$_POST['costo_litro1'];
$costo_total1=$_POST['costo_total1'];
$vehiculo1=$_POST['vehiculo1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE aditivos SET aditivo = '$aditivo5', fecha_registro ='$fecha_registro2' ,marca= '$marca2', litros= '$litros1', costo_litro='$costo_litro1', costo_total= '$costo_total1', vehiculo='$vehiculo1' WHERE id_aditivos  = ' " . $id_aditivos. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error());
mysqli_close($con);
?>











