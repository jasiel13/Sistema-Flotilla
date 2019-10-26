<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Tabla de Historial de Incidentes</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script> 
    <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="jquery/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>   

    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css"> 

    <!--librerias para crear efecto hover-->    
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_tables.css">       
  </head>

<body>
<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar">

<div class="form-row">
<div class="form-group col-md-2"></div>
<div class="form-group col-md-4">
<label for="">Fecha Inicio del Incidente</label>  
<input id="min" name="min" type="text" placeholder="Fecha iniciar busqueda" class="form-control">
</div>
<div class="form-group col-md-4"> 
<label for="">Fecha Inicio del Incidente(cerrar rango)</label>  
<input id="max" name="max" type="text" placeholder="Fecha cerrar busqueda" class="form-control">
</div> 
</div>

<thead class="thead-dark text-center">
<tr>
<th>No.Incidente</th>  
<th>Conductor</th>
<th>Vehículo</th>
<th>Servicio</th>
<th>Fecha del Reporte</th>
<th>Prioridad</th>
<th>Incidente</th>
<th>Descripción</th>
<th>Kilometraje al momento</th>
<th>Fecha de vencimiento</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="SELECT  id_incidente,conductor,vehiculo,servicio,fecha_inicio,prioridad,incidente,descripcion,odometro,
fecha_final FROM historial_incidentes";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){ 

$datos=$row['id_incidente']."||".
$row['conductor']."||".
$row['vehiculo']."||".
$row['servicio']."||".
$row['fecha_inicio']."||".
$row['prioridad']."||".
$row['incidente']."||".
$row['descripcion']."||".
$row['odometro']."||".
$row['fecha_final'];
?>
  <tr>
    <td class="text-center"><?php echo$row['id_incidente']?></td>   
    <td class="text-center"><?php echo$row['conductor']?></td>
    <td class="text-center"><?php echo$row['vehiculo']?></td>
    <td class="text-center"><?php echo$row['servicio']?></td>
    <td class="text-center"><?php echo$row['fecha_inicio']?></td>
    <td class="text-center"><?php echo$row['prioridad']?></td>
    <td class="text-center"><?php echo$row['incidente']?></td>
    <td><?php echo$row['descripcion']?></td>
    <td class="text-center"><?php echo$row['odometro']?></td>
    <td class="text-center"><?php echo$row['fecha_final']?></td>    
  </tr>  
<?php
 }
mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>
</tbody>
</table>
</div>

<script type="text/javascript">
  //CODIGO PARA EJECUTAR LA TABLA CON EL PLUGIN DATA-TABLE  
  $(document).ready( function () {
    $('#exportar').DataTable();
} );

$( ()=> {
  $('#exportar').DataTable();
  $(document).on('click', '#btn', function(){

  if( !$('.dataWrapper').is(':visible') ) {
    $('.dataWrapper').show();
  } else {
    $('.dataWrapper').hide();
  }
  });
});

//rango de fechas
$(document).ready(function() {  
    var table = $('#exportar').DataTable();
    $('#min,#max').keyup( function() {
        table.draw();
    });
});

$.fn.dataTable.ext.search.push(
    function( oSettings, aData, iDataIndex ) {

        var dateIni = $('#min').val();
        var dateFin = $('#max').val();

        var indexCol = 4;//si falla revisa aqui que la columna deb de ser la 5

        dateIni = dateIni.replace(/-/g, "");
        dateFin= dateFin.replace(/-/g, "");

        var datofini = aData[indexCol].replace(/-/g, "");

        if (dateIni === "" && dateFin === "")
        {
            return true;
        }

        if(dateIni === "")
        {
            return datofini <= dateFin;
        }

        if(dateFin === "")
        {
            return datofini >= dateIni;
        }

        return datofini >= dateIni && datofini <= dateFin;
    }
);
//rango de fechas

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Historial de Incidentes",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>