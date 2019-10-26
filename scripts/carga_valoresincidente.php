<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT conductor,vehiculo,servicio,incidente,descripcion,odometro from incidentes where id_incidente=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result); 

$conductor=$resultados['conductor'];
$vehiculo=$resultados['vehiculo'];
$servicio=$resultados['servicio'];
$incidente=$resultados['incidente'];
$descripcion=$resultados['descripcion'];
$odometro=$resultados['odometro'];

//agregamos nuestros datos al array para retornarlos

$jsondata['conductor'] = $conductor; 
$jsondata['vehiculo'] = $vehiculo;
$jsondata['servicio'] = $servicio;
$jsondata['incidente'] = $incidente;
$jsondata['descripcion'] = $descripcion; 
$jsondata['odometro'] = $odometro;
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


