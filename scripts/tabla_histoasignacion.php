<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query5="SELECT  * FROM historial_conductor ORDER BY id_conductor DESC";
$result5=mysqli_query($con, $query5) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark'>
<tr>
<th>ID_conductor</th>
<th>Nombre</th>
<th>Apellido Paterno</th>
<th>Apellido Materno</th>
<th>Licencia</th>
<th>Fecha de vencimiento</th>
<th>Vehículo Asignado</th>
<th>Fecha de Reasignacion</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result5))
{   echo "<tbody>";
	echo "<tr>";
	echo "<td>".$row['id_conductor']."</td>";
	echo "<td>".$row['nombre']."</td>";
	echo "<td>".$row['apellido_pat']."</td>";
	echo "<td>".$row['apellido_mat']."</td>";
	echo "<td>".$row['licencia']."</td>";
	echo "<td>".$row['fecha_vencimiento']."</td>";	
	echo "<td>".$row['vehiculo']."</td>";
	echo "<td>".$row['fecha_modificacion']."</td>";	
	echo "</tr>";
	echo "</tbody>";

}
echo "</table>";

mysqli_query($con,$query5) or die ("Problemas al llamar tabla".mysqli_error());

mysqli_close($con);

?>