<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT vehiculo,servicio,responsable,fecha_inicio,proveedor,costo,kilometraje,autorizacion,fecha_entrega,comentarios from orden_servicio_externo where numero_orden=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());


$resultados= mysqli_fetch_array($result);
 
$vehiculo1=$resultados['vehiculo'];
$servicio1=$resultados['servicio'];
$responsable1=$resultados['responsable'];
$fecha_inicio1=$resultados['fecha_inicio'];
$proveedor1=$resultados['proveedor'];
$costo1=$resultados['costo'];
$kilometraje1=$resultados['kilometraje'];
$autorizacion1=$resultados['autorizacion'];
$fecha_entrega1=$resultados['fecha_entrega'];
$comentarios1=$resultados['comentarios'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['vehiculo1'] = $vehiculo1;
$jsondata['servicio1'] = $servicio1;
$jsondata['responsable1'] = $responsable1;
$jsondata['fecha_inicio1'] = $fecha_inicio1;
$jsondata['proveedor1'] = $proveedor1;
$jsondata['costo1'] = $costo1;
$jsondata['kilometraje1'] = $kilometraje1;
$jsondata['autorizacion1'] = $autorizacion1;
$jsondata['fecha_entrega1'] = $fecha_entrega1;
$jsondata['comentarios1'] = $comentarios1;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


