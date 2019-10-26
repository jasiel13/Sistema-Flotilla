<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$marca=$_POST['marca'];

$insert="INSERT INTO  marca_llantas (marca) VALUES ('$marca')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>