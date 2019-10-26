<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$tipo=$_POST['tipo'];

$insert="INSERT INTO  tipo_combustible (tipo) VALUES ('$tipo')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>