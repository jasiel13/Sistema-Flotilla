<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$valor=$_POST['valor'];

$jsondata = array();

$query="SELECT aditivo,marca from aditivo_tipo where id_aditivo=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$aditivo5=$resultados['aditivo'];
$marca2=$resultados['marca'];

$jsondata['aditivo5'] = $aditivo5;
$jsondata['marca2'] = $marca2;

 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


