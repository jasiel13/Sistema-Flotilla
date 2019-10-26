<?php
//se recojen variables de forma normal
$fecha_inicio=$_POST['fecha_inicio'];
$actividad=$_POST['actividad'];
$fecha_final=$_POST['fecha_final'];
$editable=$_POST['editable'];
$color=$_POST['color'];
$descripcion=$_POST['descripcion'];

//se crea array asociativo 
$datos=array(
	"title"=>$actividad,
	"description"=>$descripcion,
	"start"=>$fecha_inicio,
	"end"=>$fecha_final,
	"editable"=>$editable,
	"color"=>$color	
);
//se crea la conexion mediante pdo, en los values se pone :title para identificar el array , el trycatch solo es para saber si se realizo la conexion
try{
	$coneccion = new PDO("mysql:host=localhost; dbname=controldeflotilla;","root","");
    $cadena_consulta="insert into recordatorios(actividad,descripcion,fecha_inicio,fecha_final,editable,color)values(:title,:description,:start,:end,:editable,:color)";
    $consulta=$coneccion->prepare($cadena_consulta);
    $consulta->execute($datos);
}
catch(PDOException $e){

}
//se usa si se envia el formulario d emanera normal y no por ajax
//header("location:http://localhost/control_flotilla/recordatorios.php");
?>