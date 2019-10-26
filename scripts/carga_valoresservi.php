<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT tipo_servicio,kilometraje,prioridad,tiempo from tipos_servicios where id_servicio=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);
 

$kilometraje1=$resultados['kilometraje'];
$prioridad1=$resultados['prioridad'];
$tiempo1=$resultados['tiempo'];
 
//agregamos nuestros datos al array para retornarlos

$jsondata['kilometraje1'] = $kilometraje1;
$jsondata['prioridad1'] = $prioridad1;
$jsondata['tiempo1'] = $tiempo1;

 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


