<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT nombre,apellido_pat,apellido_mat,licencia,fecha_vencimiento from conductor where id_conductor=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);
 
$nombre=$resultados['nombre'];
$apellido_pat=$resultados['apellido_pat'];
$apellido_mat=$resultados['apellido_mat'];
$licencia=$resultados['licencia'];
$fecha_vencimiento=$resultados['fecha_vencimiento'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['nombre'] = $nombre;
$jsondata['apellido_pat'] = $apellido_pat;
$jsondata['apellido_mat'] = $apellido_mat;
$jsondata['licencia'] = $licencia;
$jsondata['fecha_vencimiento'] = $fecha_vencimiento;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


