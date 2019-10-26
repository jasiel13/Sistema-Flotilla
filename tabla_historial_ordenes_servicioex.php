<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Tabla Historial Orden de Servicios Externas</title>
    
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
<div class="bg-info clearfix">
<h3 align="center">Historial Orden de Servicio Externa
<i class="fa fa fa-clipboard fa-2x"></i></h3>
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de la Orden de servicio
      <img src="img/servicio.png">
  </legend>

<div class="form-row">
<div class="form-group col-md-2"></div>  
<div class="form-group col-md-4">
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
<button type="button" onclick="location.href='comparativo_proveedores.php'" class="btn btn-info hvr-sink">
Comparativo de Proveedores
</button>
</div>
<div class="form-group col-md-4">
<button type="button" onclick="location.href='orden_servicio_externa.php'" class="btn btn-info hvr-sink">
Ordenes de Servicio Externa
</button>
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>
</div>
</div> 
<hr>
<div class="text-left">
    </div>
   </div>
  </div>


<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar">

<div class="form-row">
<div class="form-group col-md-3"></div>
<div class="form-group col-md-3">
<label for="">Fecha de Registro</label>  
<input id="min" name="min" type="text" placeholder="Fecha iniciar busqueda" class="form-control">
</div>
<div class="form-group col-md-3"> 
<label for="">Fecha de Registro(cerrar rango)</label>  
<input id="max" name="max" type="text" placeholder="Fecha cerrar busqueda" class="form-control">
</div> 
</div>

<thead class="thead-dark text-center">
<tr>
<th>No. Orden</th>
<th>Fecha de Registro</th>
<th>Vehículo</th>
<th>Servicio</th>
<th>Responsable</th>
<th>Fecha de inicio</th>
<th>Proveedor</th>
<th>Estado</th>
<th>Costo</th>
<th>Kilometraje</th>
<th>Autorizado por</th>
<th>Fecha de Entrega</th>
<th>Comentarios</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="SELECT  * FROM historial_ordenes_servicioex";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){ 

$datos=$row[0]."||".
$row[1]."||".
$row[2]."||".
$row[3]."||".
$row[4]."||".
$row[5]."||".
$row[6]."||".
$row[7]."||".
$row[8]."||".
$row[9]."||".
$row[10]."||".
$row[11]."||".
$row[12];
?>
  <tr> 
    <td class="text-center"><?php echo$row[0]?></td>  
    <td class="text-center"><?php echo$row[1]?></td>
    <td class="text-center"><?php echo$row[2]?></td>
    <td class="text-center"><?php echo$row[3]?></td>
    <td class="text-center"><?php echo$row[4]?></td>     
    <td class="text-center"><?php echo$row[5]?></td>
    <td class="text-center"><?php echo$row[6]?></td>
    <td class="text-center"><?php echo$row[7]?></td>
    <td class="text-center"><?php echo$row[8]?></td>
    <td class="text-center"><?php echo$row[9]?></td>
    <td class="text-center"><?php echo$row[10]?></td>
    <td class="text-center"><?php echo$row[11]?></td>
    <td class="text-center"><?php echo$row[12]?></td>    
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

        var indexCol = 1;

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
    filename: "Historial de Ordenes de Servicio Externas",
    fileext: ".xls",
    preserveColors: true
  }); 
});   
</script>
</body>
</html>