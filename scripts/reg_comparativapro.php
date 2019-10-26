<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$numero_orden=$_POST['numero_orden'];
$vehiculo=$_POST['vehiculo'];
$servicio=$_POST['servicio'];
$cantidad=$_POST['cantidad'];
$proveedor1=$_POST['proveedor1'];
$proveedor2=$_POST['proveedor2'];
$proveedor3=$_POST['proveedor3'];
$costo_unitario1=$_POST['costo_unitario1'];
$costo_unitario2=$_POST['costo_unitario2'];
$costo_unitario3=$_POST['costo_unitario3'];
$costo_total1=$_POST['costo_total1'];
$costo_total2=$_POST['costo_total2'];
$costo_total3=$_POST['costo_total3'];

$insert="INSERT INTO orden_servicio_gastos(numero_orden,vehiculo,servicio,cantidad,proveedor1,proveedor2,proveedor3,costo_unitario1,costo_total1,costo_unitario2,costo_total2,costo_unitario3,costo_total3) VALUES ('$numero_orden','$vehiculo','$servicio','$cantidad','$proveedor1','$proveedor2','$proveedor3','$costo_unitario1','$costo_total1','$costo_unitario2', '$costo_total2', '$costo_unitario3','$costo_total3')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
?>

