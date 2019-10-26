<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT tipo,ciudad,contacto,telefono,celular,correo from proveedores where id_proveedor=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);
 
$tipo=$resultados['tipo'];
$ciudad=$resultados['ciudad'];
$contacto=$resultados['contacto'];
$telefono=$resultados['telefono'];
$celular=$resultados['celular'];
$correo=$resultados['correo'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['tipo'] = $tipo;
$jsondata['ciudad'] = $ciudad;
$jsondata['contacto'] = $contacto;
$jsondata['telefono'] = $telefono;
$jsondata['celular'] = $celular;
$jsondata['correo'] = $correo;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


