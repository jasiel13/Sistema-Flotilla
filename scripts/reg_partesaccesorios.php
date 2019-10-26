<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$partes=$_POST['partes'];

$insert="INSERT INTO  partes_accesorios (partes) VALUES ('$partes')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>