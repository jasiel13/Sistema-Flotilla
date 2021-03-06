<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Tabla carga combustible</title>
    
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
<div class="form-group col-md-3"></div>
<div class="form-group col-md-3">
<label for="">Fecha Inicio de Carga</label>  
<input id="min" name="min" type="text" placeholder="Fecha iniciar busqueda" class="form-control">
</div>
<div class="form-group col-md-3"> 
<label for="">Fecha Inicio de Carga(cerrar rango)</label>  
<input id="max" name="max" type="text" placeholder="Fecha cerrar busqueda" class="form-control">
</div> 
</div>

<thead class="thead-dark text-center">
<tr>
<th>ID</th>
<th>Vehículo</th>
<th>Fecha de carga</th>
<th>Hora de carga</th>
<th>Ticket</th>
<th>Factura</th>
<th>Capacidad</th>
<th>Tipo de combustible</th>
<th>Monto Total</th>
<th>Litros</th>
<th>Monto x Litros</th>
<th>Fecha de registro</th>
<th>Empresa</th>
<th>Km_inicial</th>
<th>Km_final</th>
<th>Rendimiento Real</th>
<th>Rendimiento Esperado</th>
<th>Factor</th>
<th>Porcentaje</th>
<th>Eliminar</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="SELECT  * FROM carga_combustible";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){ 

$datos=$row[0]."||".
$row[1]."||".
$row[2]."||".
$row[3]."||".
$row[4]."||".
$row[5]."||".

$row[7]."||".
$row[8]."||".
$row[9]."||".
$row[10]."||".
$row[11]."||".
$row[12]."||".
$row[13]."||".
$row[14]."||".
$row[15]."||".
$row[16]."||".
$row[17]."||".
$row[18];

$lleno=$row[6];
if($lleno=="1"){
  $status="<label style='color:green;'>Tanque lleno</label>";
}
else
{
   $status="<label style='color:red;'>Tanque semi-lleno</label>";
};

?>
  <tr> 
    <td class="text-center"><?php echo$row[0]?></td>  
    <td class="text-center"><?php echo$row[1]?></td>
    <td class="text-center"><?php echo$row[2]?></td>
    <td class="text-center"><?php echo$row[3]?></td>
    <td class="text-center"><?php echo$row[4]?></td>     
    <td class="text-center"><?php echo$row[5]?></td>
    <td class="text-center"><?php echo$status?></td> 
    <td class="text-center"><?php echo$row[7]?></td>
    <td class="text-center"><?php echo$row[8]?></td>
    <td class="text-center"><?php echo$row[9]?></td>
    <td class="text-center"><?php echo$row[10]?></td>
    <td class="text-center"><?php echo$row[11]?></td>
    <td class="text-center"><?php echo$row[12]?></td>
    <td class="text-center"><?php echo$row[13]?></td>
    <td class="text-center"><?php echo$row[14]?></td>
    <td class="text-center"><?php echo$row[15]?></td>
    <td class="text-center"><?php echo$row[16]?></td>
    <td class="text-center"><?php echo$row[17]?></td>
    <td class="text-center"><?php echo$row[18]?></td>

    <td class="text-center">
      <button class="btn btn-danger fa fa-trash" onclick="delete1('<?php echo $row[0]?>')"></button>
    </td>
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

//BORRAR DATOS
function delete1(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_cargacombustible.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        $('#table').load('scripts/tabla_cargacombustible.php');
        alert(data);                           
      }
  });
  }  
}

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

        var indexCol = 2;

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
</script>
</body>
</html>