<?php
error_reporting(0);
$ticket=$_POST['ticket'];
$vehiculo=$_POST['vehiculo'];
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="SELECT vehiculo,porcentaje FROM carga_combustible WHERE vehiculo ='$vehiculo' and ticket ='$ticket'";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){

 $auto=$row['vehiculo'];
 $porcentaje=$row['porcentaje'];
 $p=$row['porcentaje'];//para poder mostar la cantidad de porcentaje sin modificar tal como se trae de la consulta y para hacer el mensaje de baja antes de completar el 10%
 }

//para comenzar a entrar al ciclo primero los km deben de llegar a 10 una vez que llegue se mete al ciclo,marcara la alerta "media" cuando por ejemplo sean 10 o 19 dira que esta por llegar al 20% y cuando ya diga 30,31,32 la alerta cambiara y dira que esta cerca de llegar al 40%. Cambia cada 10 porcientos para decidir si es alta,media,baja.

    $excedido = 0;
    $mensaje;
    while($porcentaje >= 20){
      $excedido += 20;
      $porcentaje-= 20;
    }
    $mensaje = "Superó el:<br>".$excedido."%";
    $prioridad ="Alta<img src='img/alerta_alta.png' style='width:40px'";
    $boton="<a href='reg_mantenimiento.php' class='btn btn-danger'><img src='img/mtto1.png' style='width:25px'></a>";

    if($porcentaje >= 10 && $porcentaje < 20){
        $excedido += 20;
        $mensaje = "Esta por superar el:<br>".$excedido."%";
        $prioridad ="Media<img src='img/alerta_media.png' style='width:40px'>";
        $boton="<a href='reg_mantenimiento.php' class='btn btn-warning'><img src='img/mtto1.png' style='width:25px'></a>";
    } 

    if($p<=10){
        $mensaje="Aún no entra en rango";
        $prioridad ="Baja<img src='img/alerta_baja.png' style='width:40px'";
        $boton="<a href='reg_mantenimiento.php' class='btn btn-info'><img src='img/mtto1.png' style='width:25px'></a>";
    }

echo "<div class='container'style='width:500px'>
<table class='table table-hover table-sm table-bordered table-condensed'>
<thead class='thead-dark text-center'>
<tr>
<th>Vehículo</th>
<th>Porcentaje</th>
<th>Mensaje de Alerta</th>
<th>Prioridad</th>
<th>Mantenimiento</th>
</tr>
</thead>
<tbody class='text-center'>
<tr>
<td>$auto</td>
<td>$p%</td>
<td>$mensaje</td>
<td>$prioridad</td>
<td>$boton</td>
</tr>
</tbody>
</table>
</div>";
mysqli_close($con);
?>