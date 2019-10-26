<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$numero=$_POST['numero'];
$conductor=$_POST['conductor'];
$vehiculo=$_POST['vehiculo'];
$kilometraje=$_POST['kilometraje'];
$fecha_revision=$_POST['fecha_revision'];
$hora_revision=$_POST['hora_revision'];
$parabrisas=$_POST['parabrisas'];
$nivel_gasolina=$_POST['nivel_gasolina'];
$estado_llantas=$_POST['estado_llantas'];
$licencia=$_POST['licencia'];
$poliza=$_POST['poliza'];
$tarjeta_circulacion=$_POST['tarjeta_circulacion'];
$observaciones=$_POST['observaciones'];

$aceite=$_POST['aceite'];
$liquido_frenos=$_POST['liquido_frenos'];
$liquido_direccion=$_POST['liquido_direccion'];
$transmision=$_POST['transmision'];
$anticongelante=$_POST['anticongelante'];

$cuarto=$_POST['cuarto'];
$direccionales=$_POST['direccionales'];
$freno=$_POST['freno'];
$intermitentes=$_POST['intermitentes'];

$estado=$_POST['estado'];
$frenos=$_POST['frenos'];
$direccion=$_POST['direccion'];
$limpieza=$_POST['limpieza'];
$apariencia=$_POST['apariencia'];
$placas=$_POST['placas'];

$insert="INSERT INTO checklist_revision (numero_check,responsable,vehiculo, kilometraje, fecha_revision, hora_revision, aceite_motor, liquido_frenos, liquido_direccion, liquido_transmision, anticongelante, estado_banda, faros_cuartos, faros_direccionales,faros_freno, faros_intermitentes, parabrisas, frenos,nivel_gasolina,revision_direccion,estado_llantas,licencia,poliza,tarjeta_circulacion,limpieza,apariencia,placas,observaciones)
 VALUES ('$numero','$conductor','$vehiculo','$kilometraje','$fecha_revision','$hora_revision','$aceite','$liquido_frenos', '$liquido_direccion', '$transmision', '$anticongelante', '$estado', '$cuarto', '$direccionales', '$freno', '$intermitentes', '$parabrisas','$frenos','$nivel_gasolina','$direccion','$estado_llantas','$licencia','$poliza','$tarjeta_circulacion','$limpieza','$apariencia','$placas','$observaciones')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
mysqli_close($con);
?>

