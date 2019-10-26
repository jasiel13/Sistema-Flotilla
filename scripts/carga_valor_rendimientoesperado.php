<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$valor=$_POST['valor'];
$jsondata = array();
$query="SELECT vehiculo,rendimiento from vehiculo where no_unidad=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$vehiculo=$resultados['vehiculo']; 
$rendimiento_kilometro=$resultados['rendimiento']; 


$jsondata['vehiculo'] = $vehiculo;
$jsondata['rendimiento_kilometro'] = $rendimiento_kilometro;
 
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);
?>


