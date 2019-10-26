<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$conductor=$_POST['conductor'];
$servicio=$_POST['servicio'];
$vehiculo=$_POST['vehiculo'];
$prioridad=$_POST['prioridad'];
$prioridad1=$_POST['prioridad1'];
$fecha_inicio=$_POST['fecha_inicio'];
$fecha_final=$_POST['fecha_final'];
$odometro=$_POST['odometro'];
$incidente=$_POST['incidente'];
$descripcion=$_POST['descripcion'];


$insert="INSERT INTO incidentes (conductor,vehiculo,servicio,fecha_inicio,prioridad,dias_prioridad,incidente,descripcion,odometro,fecha_final) VALUES ('$conductor','$vehiculo','$servicio','$fecha_inicio','$prioridad1','$prioridad','$incidente','$descripcion', '$odometro', '$fecha_final')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

if($insert==true){
$insert2="INSERT INTO historial_incidentes (conductor,vehiculo,servicio,fecha_inicio,prioridad,dias_prioridad,incidente,descripcion,odometro,fecha_final) VALUES ('$conductor','$vehiculo','$servicio','$fecha_inicio','$prioridad1','$prioridad','$incidente','$descripcion', '$odometro', '$fecha_final')";
mysqli_query($con,$insert2) or die ("Problemas al insertar".mysqli_error());	
}
?>

