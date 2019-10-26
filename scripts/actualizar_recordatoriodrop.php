<?php
if(isset($_POST["id"]))
{
$coneccion = new PDO("mysql:host=localhost; dbname=controldeflotilla;","root","");
    $cadena_consulta="update recordatorios set fecha_inicio=:start where id_recordatorio=:id";
    $consulta=$coneccion->prepare($cadena_consulta);
    $consulta->execute(
   array( 
   'start' => $_POST['start'],   
   'id'   => $_POST['id']
  )
 );
}
?>

