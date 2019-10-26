<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Tabla Orden de Servicios Externas</title>
    
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
<th>Eliminar</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="SELECT  * FROM orden_servicio_externo";
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

$estado=$row[7];
if($estado=="en curso"){
  $status="<label style='color:green;'>$row[7]</label>   
<select name='estado' id='estado' onchange='mifuncion(this.value)'>
            <option value=''>Seleccionar</option>
            <option value='en curso'>En curso</option>
            <option value='pendiente'>Pendiente</option>
            <option value='cerrada'>Cerrada</option>
        </select>";
}
if($estado=="pendiente"){
  $status="<label style='color:blue;'>$row[7]</label>
  <select name='estado' id='estado' onchange='mifuncion(this.value)'>
            <option value=''>Seleccionar</option>
            <option value='en curso'>En curso</option>
            <option value='pendiente'>Pendiente</option>
            <option value='cerrada'>Cerrada</option>
        </select>";
}
if($estado=="cerrada"){
  $status="<label style='color:red;'>$row[7]</label>
  <select name='estado' id='estado' onchange='mifuncion(this.value)'>
            <option value=''>Seleccionar</option>
            <option value='en curso'>En curso</option>
            <option value='pendiente'>Pendiente</option>
            <option value='cerrada'>Cerrada</option>
        </select>";
}
else
{
};

?>
  <tr> 
    <td class="text-center"><?php echo$row[0]?></td>  
    <td class="text-center"><?php echo$row[1]?></td>
    <td class="text-center"><?php echo$row[2]?></td>
    <td class="text-center"><?php echo$row[3]?></td>
    <td class="text-center"><?php echo$row[4]?></td>     
    <td class="text-center"><?php echo$row[5]?></td>
    <td class="text-center"><?php echo$row[6]?></td>
    <td class="text-center"><?php echo$status?></td>
    <td class="text-center"><?php echo$row[8]?></td>
    <td class="text-center"><?php echo$row[9]?></td>
    <td class="text-center"><?php echo$row[10]?></td>
    <td class="text-center"><?php echo$row[11]?></td>
    <td class="text-center"><?php echo$row[12]?></td>    

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
      url : 'scripts/borrar_orden_servicio_externa.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        $('#table').load('scripts/tabla_orden_servicio_externa.php');
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

//mi funcion es para detectar lo que se selecciono en el select y el table tbody tr es para seleccionar toda la fila pero en ella lleva el id estos resultados son para enviarlos al php donde se hara la consulta tiene sus errores para eso usa el console el error lo genera el seleccionar el id por td 
 function mifuncion(valor){ 

 $("table tbody tr").click(function() {  
  var id = $(this).find("td:eq(0)").text();
    //console.log(valor);
    //console.log(id);
    $.ajax({                        
       type: 'POST',                 
       url : 'scripts/update_orden_servicio_estado.php',                   
       data: {valor:valor,id:id},
       success: function(data)            
       {
        $('#table').load('scripts/tabla_orden_servicio_externa.php');
       }
     });
   });
  }    
</script>
</body>
</html>