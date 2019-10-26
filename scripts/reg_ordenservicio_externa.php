<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$fecha_registro=$_POST['fecha_registro'];
$vehiculo=$_POST['vehiculo'];
$servicio=$_POST['servicio'];
$responsable=$_POST['responsable'];
$fecha_inicio=$_POST['fecha_inicio'];
$proveedor=$_POST['proveedor'];
$estado=$_POST['estado'];
$costo=$_POST['costo'];
$kilometraje=$_POST['kilometraje'];
$autorizacion=$_POST['autorizacion'];
$fecha_entrega=$_POST['fecha_entrega'];
$comentarios=$_POST['comentarios'];

$insert="INSERT INTO orden_servicio_externo(fecha_registro,vehiculo,servicio,responsable,fecha_inicio,proveedor,estado,costo,kilometraje,autorizacion,fecha_entrega,comentarios) VALUES ('$fecha_registro','$vehiculo','$servicio','$responsable','$fecha_inicio','$proveedor','$estado','$costo','$kilometraje', '$autorizacion', '$fecha_entrega','$comentarios')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
if($insert==true){
	$insert2="INSERT INTO historial_ordenes_servicioex(fecha_registro,vehiculo,servicio,responsable,fecha_inicio,proveedor,estado,costo,kilometraje,autorizacion,fecha_entrega,comentarios) VALUES ('$fecha_registro','$vehiculo','$servicio','$responsable','$fecha_inicio','$proveedor','$estado','$costo','$kilometraje', '$autorizacion', '$fecha_entrega','$comentarios')";
mysqli_query($con,$insert2) or die ("Problemas al insertar".mysqli_error());

 }
?>

