<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT id_conductor,nombre,vehiculo,fecha_modificacion from conductor where id_conductor=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);

$id_conductor=$resultados['id_conductor']; 
$nombre=$resultados['nombre'];
$vehiculo=$resultados['vehiculo'];
$fecha_modificacion=$resultados['fecha_modificacion'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['id_conductor'] = $id_conductor;
$jsondata['nombre'] = $nombre;
$jsondata['vehiculo'] = $vehiculo;
$jsondata['fecha_modificacion'] = $fecha_modificacion;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


