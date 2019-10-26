<?php
$numero=$_POST['numero'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="select num_checklist, conductor, vehiculo, kilometraje, fecha_revision, hora_revision, nivel_gasolina, luces_delanteras_bajas, luces_delanteras_alta, luces_traseras, luces_freno, luces_cruce_delantera, luces_cruce_trasera, intermitentes_delanteras, intermitentes_trasera, aceite_transmision, aceite_motor, aceite_direccion, refrigerante, radiador, liga_freno, indicador_combustible, indicador_temperatura, indicador_presion, horometro, tacometro, velocimetro, bocina, alarma, limpia_parabrisas, gato_hidraulico, neumaticos, retrovisores, vidrio_delantero, vidrio_trasero, vidrio_lateral_delantero, vidrio_lateral_trasero, direccion, suspension_delantera, suspension_trasera, pintura, limpieza, licencia, poliza, tarjeta_circulacion, placas, codigo_bateria, observaciones
from checklist_mtto
where num_checklist ='$numero'
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
    echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'>Observaciones del Vehículo</th>";
    echo "</tr>";

    echo "<tr>";
    echo"<th colspan='4' class='bg-secondary text-light'>Descripción</th>";
    echo "<th colspan='4' class='bg-secondary text-light'>Estado</th>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Luces Delanteras Baja</th>";
    echo "<td colspan='4'>".$row[7]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Luces Delanteras Alta</th>";
    echo "<td colspan='4'>".$row[8]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Luces Traseras</th>";
    echo "<td colspan='4'>".$row[9]."</td>";
    echo "</tr>";
    echo "<tr>";
    echo"<th colspan='4'>Luces de Freno</th>";
    echo "<td colspan='4'>".$row[10]."</td>";
    echo "</tr>";
   echo "<tr>"; 
   echo"<th colspan='4'>Luces de Cruce Delanteras</th>";
   echo "<td colspan='4'>".$row[11]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Luces de Cruce Traseras</th>";
   echo "<td colspan='4'>".$row[12]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Luces Intermitentes Delanteras</th>";
   echo "<td colspan='4'>".$row[13]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Luces Intermitentes Traseras</th>";
   echo "<td colspan='4'>".$row[14]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Aceite de Transmición</th>";
   echo "<td colspan='4'>".$row[15]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Aceite de Motor</th>";
   echo "<td colspan='4'>".$row[16]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Aceite de Dirección</th>";
   echo "<td colspan='4'>".$row[17]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Refrigerante</th>";
   echo "<td colspan='4'>".$row[18]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Radiador</th>";
   echo "<td colspan='4'>".$row[19]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Liga de Freno</th>";
   echo "<td colspan='4'>".$row[20]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Indicador de Combustible</th>";
   echo "<td colspan='4'>".$row[21]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Indicador de Temperatura</th>";
   echo "<td colspan='4'>".$row[22]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Indicador de Presión</th>";
   echo "<td colspan='4'>".$row[23]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Horómetro</th>";
   echo "<td colspan='4'>".$row[24]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Tacómetro</th>";
   echo "<td colspan='4'>".$row[25]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Velocímetro</th>";
   echo "<td colspan='4'>".$row[26]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Bocina</th>";
   echo "<td colspan='4'>".$row[27]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Alarma</th>";
   echo "<td colspan='4'>".$row[28]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Gato Hidraúlico</th>";
   echo "<td colspan='4'>".$row[30]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Retrovisores</th>";
   echo "<td colspan='4'>".$row[32]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Vidrio Delantero</th>";
   echo "<td colspan='4'>".$row[33]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Vidrio Trasero</th>";
   echo "<td colspan='4'>".$row[34]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Vidrios Laterales Delanteros</th>";
   echo "<td colspan='4'>".$row[35]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Vidrios Laterales Traseros</th>";
   echo "<td colspan='4'>".$row[36]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Dirección</th>";
   echo "<td colspan='4'>".$row[37]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Suspención Delantera</th>";
   echo "<td colspan='4'>".$row[38]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Suspención Trasera</th>";
   echo "<td colspan='4'>".$row[39]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Pintura Carrocería</th>";
   echo "<td colspan='4'>".$row[40]."</td>";
   echo "</tr>";
   echo "<tr>";
   echo"<th colspan='4'>Orden y Limpieza</th>";
   echo "<td colspan='4'>".$row[41]."</td>";
   echo "</tr>";
   echo "<tr>";
  
   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Nivel de gasolina</th>";
   echo "<td colspan='4'>".$row[6]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Revisión del estado de el Parabrisas</th>";
   echo "<td colspan='4'>".$row[29]."</td>";
   echo "</tr>";
  
   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Revisión del estado de las llantas</th>";
   echo "<td colspan='4'>".$row[31]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Licencia de manejo</th>";
   echo "<td colspan='4'>Fecha de Expiración<br>".$row[42]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Póliza de seguro del vehículo</th>";
   echo "<td colspan='4'>Fecha de Expiración<br>".$row[43]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Tarjeta de circulación</th>";
   echo "<td colspan='4'>Fecha de Expiración<br>".$row[44]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>¿Cuenta con las 2 Placas?</th>";
   echo "<td colspan='4'>".$row[45]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='4'>Código de la Bateria</th>";
   echo "<td colspan='4'>".$row[46]."</td>";
   echo "</tr>";

   echo "<tr>";
   echo "<th colspan='8' scope='rowgroup' class='bg-info text-center'></th>";
   echo "</tr>";

   echo"<th colspan='2'>Observaciones</th>";
   echo "<td colspan='6'>".$row[47]."</td>";
   echo "</tr>";
  echo "</tbody>";

}
echo "</table>";
mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>
