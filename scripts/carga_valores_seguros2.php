<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT accidente,pago_total from accidentes where id_accidentes=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$accidente4=$resultados['accidente'];
$costo_total_accidente1=$resultados['pago_total'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['accidente4'] = $accidente4; 
$jsondata['costo_total_accidente1'] = $costo_total_accidente1; 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


