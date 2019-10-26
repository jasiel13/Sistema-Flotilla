<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$vehiculo=$_POST['vehiculo'];
$fecha=$_POST['fecha'];
$partes=$_POST['partes'];
$tipo=$_POST['tipo'];
$monto=$_POST['monto'];
$proveedor=$_POST['proveedor'];

$insert="INSERT INTO listado_partes(vehiculo,fecha,parte,tipo,monto,proveedor) VALUES ('$vehiculo','$fecha','$partes','$tipo','$monto','$proveedor')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>