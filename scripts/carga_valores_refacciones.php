<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT id_refacciones,vehiculo,parte,tipo,monto,proveedor from listado_partes where id_refacciones=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$vehiculo1=$resultados['vehiculo'];
$parte1=$resultados['parte'];
$tipo1=$resultados['tipo'];
$monto1=$resultados['monto'];
$proveedor1=$resultados['proveedor'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['vehiculo1'] = $vehiculo1;
$jsondata['parte1'] = $parte1;
$jsondata['tipo1'] = $tipo1;
$jsondata['monto1'] = $monto1;
$jsondata['proveedor1'] = $proveedor1; 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


