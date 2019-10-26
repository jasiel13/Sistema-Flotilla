<?php
$vehiculo=$_POST['vehiculo'];
$numero_identificacion=$_POST['numero_identificacion'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="select id_checklist,vehiculo,observaciones,numero_identificacion,fecha,entregado_por,recibido_por
from checklist
where vehiculo ='$vehiculo' and numero_identificacion='$numero_identificacion'
order by fecha desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark text-center' >
<tr>
<th>No. Checklist</th>
<th>Vehículo</th>
<th>Observaciones</th>
<th>Número de Identificación</th>
<th>Fecha</th>
<th>Entregado por</th>
<th>Recibido por</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{   echo "<tbody class='text-center'>";
	echo "<tr>";
	echo "<td>".$row[0]."</td>";
	echo "<td>".$row[1]."</td>";
	echo "<td>".$row[2]."</td>";
	echo "<td>".$row[3]."</td>";
	echo "<td>".$row[4]."</td>";
	echo "<td>".$row[5]."</td>";	
	echo "<td>".$row[6]."</td>";		
	echo "</tr>";
	echo "</tbody>";

}
echo "</table>";

if($query==true){

$query="select c.numero_identificacion,ca.nombre,ca.cantidad,ca.estado
from checklist c inner join checklist_accesorios ca on c.numero_identificacion= ca.numero_identificacion
where c.numero_identificacion = ca.numero_identificacion and c.vehiculo ='$vehiculo' and c.numero_identificacion='$numero_identificacion'
order by c.fecha desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

echo "
<div class='container'>
<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark text-center'>
<tr>
<th>Partes y Accesorios</th>
<th>Cantidad</th>
<th>Estado</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{   echo "<tbody class='text-center'>";
	echo "<tr>";
	echo "<td>".$row[1]."</td>";
	echo "<td>".$row[2]."</td>";
	echo "<td>".$row[3]."</td>";	
	echo "</tr>";
	echo "</tbody>";

}
echo "
</div>
</table>";
}

mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>