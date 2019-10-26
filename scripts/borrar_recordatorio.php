<?php
//se recojen variables de forma normal
$id=$_POST['id'];

//se crea array asociativo 
$datos=array(	
	"id"=>$id	
);
//se crea la conexion mediante pdo, en los values se pone :title para identificar el array , el trycatch solo es para saber si se realizo la conexion
try{
	$coneccion = new PDO("mysql:host=localhost; dbname=controldeflotilla;","root","");
    $cadena_consulta="delete from recordatorios where id_recordatorio=:id";
    $consulta=$coneccion->prepare($cadena_consulta);
    $consulta->execute($datos);
}
catch(PDOException $e){

}
//se usa si se envia el formulario d emanera normal y no por ajax
//header("location:http://localhost/control_flotilla/recordatorios.php");
?>