<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT tipo_servicio,tiempo from tipos_servicios where id_servicio=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result); 

$servicio=$resultados['tipo_servicio'];
$tiempo=$resultados['tiempo'];

//agregamos nuestros datos al array para retornarlos

$jsondata['servicio'] = $servicio; 
$jsondata['tiempo'] = $tiempo; 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


