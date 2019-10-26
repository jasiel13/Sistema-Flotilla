<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT vehiculo,aseguradora,poliza,fecha_vencimiento,monto_total,accidente,costo_total_accidente from seguros where id_seguro=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$vehiculo1=$resultados['vehiculo'];
$aseguradora2=$resultados['aseguradora'];
$poliza1=$resultados['poliza'];
$fecha_vencimiento1=$resultados['fecha_vencimiento'];
$monto_total1=$resultados['monto_total'];
$accidente2=$resultados['accidente'];
$costo_total_accidente1=$resultados['costo_total_accidente'];
$accidente4=$resultados['accidente'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['vehiculo1'] = $vehiculo1;
$jsondata['aseguradora2'] = $aseguradora2;
$jsondata['poliza1'] = $poliza1;
$jsondata['fecha_vencimiento1'] = $fecha_vencimiento1;
$jsondata['monto_total1'] = $monto_total1;
$jsondata['accidente2'] = $accidente2; 
$jsondata['costo_total_accidente1'] = $costo_total_accidente1; 
$jsondata['accidente4'] = $accidente4; 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


