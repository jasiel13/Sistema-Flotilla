<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT id_llantas,num_serie,vehiculo,marca,cantidad,costo_unitario,costo_total,kilometraje,proximo_kilometraje from llantas where id_llantas=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);

$vehiculo1=$resultados['vehiculo'];
$num_serie2=$resultados['num_serie'];
$marca2=$resultados['marca'];
$cantidad1=$resultados['cantidad'];
$costo_unitario1=$resultados['costo_unitario'];
$costo_total1=$resultados['costo_total'];
$kilometraje1=$resultados['kilometraje'];
$proximo_kilometraje1=$resultados['proximo_kilometraje'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['vehiculo1'] = $vehiculo1;
$jsondata['num_serie2'] = $num_serie2;
$jsondata['marca2'] = $marca2;
$jsondata['cantidad1'] = $cantidad1;
$jsondata['costo_unitario1'] = $costo_unitario1;
$jsondata['costo_total1'] = $costo_total1;
$jsondata['kilometraje1'] = $kilometraje1;
$jsondata['proximo_kilometraje1'] = $proximo_kilometraje1;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


