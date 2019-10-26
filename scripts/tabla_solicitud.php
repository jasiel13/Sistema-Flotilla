<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Tabla de solicitudes</title>
    
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
<thead class="thead-dark text-center">
<tr>
<th>Usuario</th>
<th>Fecha</th>
<th>Problema</th>
<th>Prioridad</th>
<th>Eliminar</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="SELECT  * FROM soporte";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){ 

$datos=$row[0]."||".
$row[1]."||".
$row[2]."||".
$row[3]."||".
$row[4];
?>
  <tr>   
    <td class="text-center"><?php echo$row[1]?></td>
    <td class="text-center"><?php echo$row[2]?></td>
    <td><?php echo$row[3]?></td>
    <td class="text-center"><?php echo$row[4]?></td>
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
      url : 'scripts/borrar_solicitud.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        $('#table').load('scripts/tabla_solicitud.php');
        alert(data);                           
      }
  });
  }  
}
</script>
</body>
</html>