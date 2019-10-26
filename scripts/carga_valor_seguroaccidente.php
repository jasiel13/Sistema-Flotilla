<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$valor=$_POST['valor'];
$jsondata = array();
$query="SELECT accidente,pago_total from accidentes where id_accidentes=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);


$accidente1=$resultados['accidente'];
$costo_total_accidente=$resultados['pago_total'];

$jsondata['accidente1'] = $accidente1;
$jsondata['costo_total_accidente'] = $costo_total_accidente;
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);
?>


