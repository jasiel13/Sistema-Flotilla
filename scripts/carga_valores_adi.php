<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$valor=$_POST['valor'];

$jsondata = array();

$query="SELECT aditivo,marca from aditivo_tipo where id_aditivo=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$aditivo2=$resultados['aditivo'];
$marca1=$resultados['marca'];

$jsondata['aditivo2'] = $aditivo2;
$jsondata['marca1'] = $marca1;

 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


