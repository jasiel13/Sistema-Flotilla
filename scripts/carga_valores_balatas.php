<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT fecha_registro,responsable,vehiculo,cantidad,costo,costo_total,observaciones from cambio_balatas where id_balatas=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);
 
$fecha_registro2=$resultados['fecha_registro'];
$conductor2=$resultados['responsable'];
$vehiculo2=$resultados['vehiculo'];
$cantidad2=$resultados['cantidad'];
$costo2=$resultados['costo'];
$costo_total2=$resultados['costo_total'];
$observaciones2=$resultados['observaciones'];

//agregamos nuestros datos al array para retornarlos
$jsondata['fecha_registro2'] = $fecha_registro2;
$jsondata['conductor2'] = $conductor2;
$jsondata['vehiculo2'] = $vehiculo2;
$jsondata['cantidad2'] = $cantidad2;
$jsondata['costo2'] = $costo2;
$jsondata['costo_total2'] = $costo_total2;
$jsondata['observaciones2'] = $observaciones2;
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


