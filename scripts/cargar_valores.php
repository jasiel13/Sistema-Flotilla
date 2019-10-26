<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT rendimiento,status,fecha,empresa,departamento from vehiculo where no_unidad=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);
 
$rendimiento=$resultados['rendimiento'];
$status=$resultados['status'];
$fecha=$resultados['fecha'];
$empresa=$resultados['empresa'];
$departamento=$resultados['departamento'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['rendimiento'] = $rendimiento;
$jsondata['status'] = $status;
$jsondata['fecha'] = $fecha;
$jsondata['empresa'] = $empresa;
$jsondata['departamento'] = $departamento;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


