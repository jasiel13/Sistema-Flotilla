<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT incidente,descripcion from incidentes where id_incidente=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result); 

$incidente=$resultados['incidente'];
$descripcion_incidente=$resultados['descripcion'];

//agregamos nuestros datos al array para retornarlos
$jsondata['incidente'] = $incidente;
$jsondata['descripcion_incidente'] = $descripcion_incidente; 

//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


