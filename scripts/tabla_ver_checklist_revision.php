<?php
$numero=$_POST['numero'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="select numero_check,responsable,vehiculo, kilometraje, fecha_revision, hora_revision, aceite_motor, liquido_frenos, liquido_direccion, liquido_transmision, anticongelante, estado_banda, faros_cuartos, faros_direccionales,faros_freno, faros_intermitentes, parabrisas, frenos,nivel_gasolina,revision_direccion,estado_llantas,licencia,poliza,tarjeta_circulacion,limpieza,apariencia,placas,observaciones
from checklist_revision
where numero_check ='$numero'
order by fecha_revision desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark text-center' >
<tr>
<th>No. Checklist</th>
<th>Responsable</th>
<th>Unidad en Revisión</th>
<th>Kilometraje</th>
<th>Fecha Revisión</th>
<th>Hora Revisión</th>
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
	echo "</tr>";

	echo "<tr>";
    echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'>1- Comprobar niveles y rellenar en casos necesarios</th>";
    echo "</tr>";

    echo "<tr>";
    echo"<th colspan='4'>Acéite de Motor</th>";
    echo "<td colspan='4'>".$row[6]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Líquido de Frenos</th>";
    echo "<td colspan='4'>".$row[7]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Líquido de Dirección Hidráulica</th>";
    echo "<td colspan='4'>".$row[8]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Líquido de Transmisión</th>";
    echo "<td colspan='4'>".$row[9]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Anticongelante</th>";
    echo "<td colspan='4'>".$row[10]."</td>";
    echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

    echo"<th colspan='4'>2- Revisión del estado de la banda </th>";
    echo "<td colspan='4'>".$row[11]."</td>";
    echo "</tr>";
   
   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'>3- Revisión de la iluminación de los faros delanteros y traseros</th>";
   echo "</tr>";

   echo"<th colspan='4'>Cuartos</th>";
   echo "<td colspan='4'>".$row[12]."</td>";
   echo "</tr>";
   echo"<th colspan='4'>Direccionales</th>";
   echo "<td colspan='4'>".$row[13]."</td>";
   echo "</tr>";
   echo"<th colspan='4'>Freno</th>";
   echo "<td colspan='4'>".$row[14]."</td>";
   echo "</tr>";
   echo"<th colspan='4'>Intermitentes</th>";
   echo "<td colspan='4'>".$row[15]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='2'>4- Revisión del estado del parabirsas</th>";
   echo "<td colspan='6'>".$row[16]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>5- Revisión de frenos, por lo menos nivel o altura del pedal</th>";
   echo "<td colspan='4'>".$row[17]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>6- Nivel de gasolina</th>";
   echo "<td colspan='4'>".$row[18]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>7- Revisión de la dirección</th>";
   echo "<td colspan='4'>".$row[19]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>8- Revisión del estado de las llantas</th>";
   echo "<td colspan='4'>".$row[20]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>9- Licencia de manejo</th>";
   echo "<td colspan='4'>Fecha de Expiración<br>".$row[21]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>10- Póliza de seguro del vehículo</th>";
   echo "<td colspan='4'>Fecha de Expiración<br>".$row[22]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>11- Tarjeta de circulación</th>";
   echo "<td colspan='4'>Fecha de Expiración<br>".$row[23]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>12- Limpieza exterior e interior</th>";
   echo "<td colspan='4'>".$row[24]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>13- Apariencia física del chasis y carrocería</th>";
   echo "<td colspan='4'>".$row[25]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>14- Verifique que tenga sus dos placas</th>";
   echo "<td colspan='4'>".$row[26]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='2'>Observaciones</th>";
   echo "<td colspan='6'>".$row[27]."</td>";
   echo "</tr>";
  echo "</tbody>";

}
echo "</table>";
mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>