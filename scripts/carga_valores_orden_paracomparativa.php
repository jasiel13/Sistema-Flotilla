<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$valor=$_POST['valor'];
$jsondata = array();
$query="SELECT vehiculo,servicio from orden_servicio_externo where numero_orden=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$vehiculo=$resultados['vehiculo']; 
$servicio=$resultados['servicio'];

$jsondata['vehiculo'] = $vehiculo;
$jsondata['servicio'] = $servicio;
 
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


