<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query6="SELECT  * FROM usuarios";
$result=mysqli_query($con, $query6) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark text-center'>
<tr>
<th>Usuarios</th>
<th>Contraseña</th>
<th>Rol</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{   echo "<tbody class='text-center'>";
	echo "<tr>";
	echo "<td>".$row['usuario']."</td>";
	echo "<td>".$row['password']."</td>";
	echo "<td>".$row['tipo']."</td>";
	echo "</tr>";
	echo "</tbody>";

}
echo "</table>";

mysqli_query($con,$query6) or die ("Problemas al llamar tabla".mysqli_error());

mysqli_close($con);
?>