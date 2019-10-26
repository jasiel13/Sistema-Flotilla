<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$vehiculo=$_POST['vehiculo'];
$numero_identificacion=$_POST['numero_identificacion'];
$observaciones=$_POST['observaciones'];
$fecha=$_POST['fecha'];
$entregado_por=$_POST['entregado_por'];
$recibido_por=$_POST['recibido_por'];
$nombre=$_POST['nombre'];
$cantidad=$_POST['cantidad'];
$estado=$_POST['estado'];

$insertar="INSERT INTO checklist(vehiculo, numero_identificacion, observaciones, fecha, entregado_por, recibido_por) VALUES ('$vehiculo','$numero_identificacion','$observaciones','$fecha','$entregado_por','$recibido_por')";
mysqli_query($con,$insertar) or die ("Problemas al insertar".mysqli_error());

if($insertar==true){

for($i=0; $i < count($nombre=$_POST['nombre']); $i++){
 
$nombre = $_POST['nombre'][$i];
$cantidad = $_POST['cantidad'][$i];
$estado = $_POST['estado'][$i];

$sql="INSERT INTO checklist_accesorios (nombre,cantidad,estado,vehiculo,numero_identificacion) VALUES ('$nombre', '$cantidad', '$estado','$vehiculo','$numero_identificacion')";
	mysqli_query($con,$sql) or die ("Problemas al insertar".mysqli_error());

   }
 }
mysqli_close($con);
?>