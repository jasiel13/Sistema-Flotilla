<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT aditivo,fecha_registro,marca,litros,costo_litro,costo_total,vehiculo from aditivos where id_aditivos=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$aditivo3=$resultados['aditivo'];
$aditivo5=$resultados['aditivo'];
$fecha_registro2=$resultados['fecha_registro'];
$marca2=$resultados['marca'];
$litros1=$resultados['litros'];
$costo_litro1=$resultados['costo_litro'];
$costo_total1=$resultados['costo_total'];
$vehiculo1=$resultados['vehiculo'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['aditivo3'] = $aditivo3;
$jsondata['aditivo5'] = $aditivo5;
$jsondata['fecha_registro2'] = $fecha_registro2;
$jsondata['marca2'] = $marca2;
$jsondata['litros1'] = $litros1;
$jsondata['costo_litro1'] = $costo_litro1;
$jsondata['costo_total1'] = $costo_total1; 
$jsondata['vehiculo1'] = $vehiculo1; 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


