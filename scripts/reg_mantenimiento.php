<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$fecha_inicio=$_POST['fecha_inicio'];
$servicio=$_POST['servicio'];
$tiempo=$_POST['tiempo'];
$fecha_final=$_POST['fecha_final'];
$vehiculo=$_POST['vehiculo'];
$km_inicial=$_POST['km_inicial'];
$km_proximo=$_POST['km_proximo'];
$costo_refacciones=$_POST['costo_refacciones'];
$costo_manodeobra=$_POST['costo_manodeobra'];
$costo_total=$_POST['costo_total'];
$referencia=$_POST['referencia'];
$tipo_mtto=$_POST['tipo_mtto'];
$proveedor=$_POST['proveedor'];
$observaciones=$_POST['observaciones'];
$incidente=$_POST['incidente'];
$descripcion_incidente=$_POST['descripcion_incidente'];
/*$fecha_proximo=$_POST['fecha_proximo'];*/

$insert="INSERT INTO mantenimiento (fecha_inicio ,fecha_final, servicio, tiempo, vehiculo, km_inicial, km_proximo, costo_refacciones, costo_manodeobra, costo_total, referencia, tipo_mtto, proveedor, incidente, descripcion_incidente, observaciones) VALUES ('$fecha_inicio','$fecha_final','$servicio','$tiempo','$vehiculo','$km_inicial','$km_proximo', '$costo_refacciones', '$costo_manodeobra', '$costo_total', '$referencia', '$tipo_mtto', '$proveedor', '$incidente', '$descripcion_incidente', '$observaciones')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
if($insert==true)
{
	$insert2="INSERT INTO historial_mantenimiento (fecha_inicio ,fecha_final, servicio, tiempo, vehiculo, km_inicial, km_proximo, costo_refacciones, costo_manodeobra, costo_total, referencia, tipo_mtto, proveedor, incidente, descripcion_incidente, observaciones) VALUES ('$fecha_inicio','$fecha_final','$servicio','$tiempo','$vehiculo','$km_inicial','$km_proximo', '$costo_refacciones', '$costo_manodeobra', '$costo_total', '$referencia', '$tipo_mtto', '$proveedor', '$incidente', '$descripcion_incidente', '$observaciones')";
	mysqli_query($con,$insert2) or die ("Problemas al insertar".mysqli_error());
}
?>

