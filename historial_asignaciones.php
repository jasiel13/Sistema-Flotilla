<?php include 'menu.php'; 
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Historial de Asignaciones</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="jquery/dataTables.bootstrap4.min.js"></script>
    
    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap_4.3.1/js/popper.min.js"></script>

    <!--librerias para crear animaciones-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <script type="text/javascript" src="wowjs/wow.min.js"></script>
    <script type="text/javascript">new WOW().init();</script> 

    <!--librerias para crear efecto hover-->
    <link rel="stylesheet" type="text/css" href="Hover/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/error.css">    
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_tables.css">   
  </head>

 <body>
<div class="bg-info clearfix">
<h3 align="center">Historial de Asignaciones
<i class="fa fa-book fa-2x"></i></h3> 
</div>

<!--CODIGO PARA FORMULARIO DE ACTUALIZAR CONDUCTOR-->
<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Conductor
    <img src="img/conductor.png">
  </legend>

<form class="container" id="updateconductor" method="POST">
  <div class="form-row">
     <div class="form-group col-md-4">
    <label for="" >Conductor</label>
      <select  name="conductor1" id="conductor1" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query6="SELECT  * FROM conductor";
            $result6=mysqli_query($con, $query6) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result6)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['id_conductor'].'">'.$row['nombre'].'</option>';
          }
        ?>
      </select>
     <p id="ms10" style="display:none" class="error">Coloque el nombre del conductor que desea modificar</p>
   </div>

    <div class="form-group col-md-4">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre"oninput="validar(this)"> 
     <p id="ms11" style="display:none" class="error">El campo nombre no puede estar vacío</p>         
    </div>

    <div class="form-group col-md-4">
      <label for="">Apellido Paterno</label>
      <input type="text" class="form-control" name="apellido_pat" id="apellido_pat" placeholder="Apellido Paterno" oninput="validar(this)">
  <p id="ms12" style="display:none" class="error">El campo apellido paterno no puede estar vacío</p> 
     </div>     
  </div>

<div class="form-row">
 <div class="form-group col-md-4">
      <label for="">Apellido Materno</label>
      <input type="text" class="form-control" name="apellido_mat" id="apellido_mat" placeholder="Apellido Materno" oninput="validar(this)">
  <p id="ms13" style="display:none" class="error">El campo apellido materno no puede estar vacío</p>
</div>  
<div class="form-group col-md-4">
      <label for="">Licencia</label>
      <input type="text" class="form-control" name="licencia" id="licencia" placeholder="Licencia">
<p id="ms14" style="display:none" class="error">El campo licencia no puede estar vacío</p>
</div>
    <div class="form-group col-md-4">
      <label for="">Fecha de vencimiento de licencia</label>
      <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento">
    <p id="ms15" style="display:none" class="error">El campo fecha no puede estar vacío</p>
  </div>   
  </div>
  
<hr>
<div class="form-row">
<div class="form-group col-md-3">
<button type="button" id="btnguardar" class="btn btn-warning hvr-rotate"><i class="fa fa-edit"></i>Modificar</button>
<button type="button" class="btn btn-warning hvr-rotate" onclick="delete2($('#conductor1').val())"><i class="fa fa-trash" style="color:black;"></i>  Eliminar</button>
</div>
<div class="form-group col-md-6">
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>Exportar a excel</button> 
</div>
<div class="form-group col-md-3">
<button type="button" class="btn btn-info hvr-float" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>
Nueva asignación
</button> 
</div>
</div>
</form>

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->
<!--CODIGO PARA FORMULARIO DE ACTUALIZAR CONDUCTOR-->


<!--CODIGO PARA MODAL DE ASIGNACIONES-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Reasingar  Vehículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="frmupdate1" method="POST">
  <div class="form-row">
 <div class="form-group col-md-6">
    <label for="" >Conductor</label>
      <select  name="conductor" id="conductor" class="form-control">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query1="SELECT  * FROM conductor";
            $result1=mysqli_query($con, $query1) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result1)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['id_conductor'].'">'.$row['nombre'].'</option>';
          }
        ?>
      </select>
     <p id="ms1" style="display:none" class="fallo">Coloque el nombre del conductor que desea asignar</p>
   </div>
  <div class="form-group col-md-6">
      <label for="">Vehículo</label>
      <select  name="vehiculo" id="vehiculo" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
      </select>
      <p id="ms2" style="display:none" class="fallo">Asigne un vehículo</p>      
    </div> 
    <div class="form-group col-md-6">
      <label for="">Fecha de Modificación</label>
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d H:i:s"); //formato fecha y hora
      ?>
     <input type="text" class="form-control" name="fecha_mod" id="fecha_mod" 
      value="<?php echo $fecha; ?>">
     </div>     
   </div>   
</form>

      </div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar3" class="btn btn-dark">Enivar</button>      
      <button type="button" onclick="location.href='cartaresponsiva.php'" class="btn btn-dark"> Responsiva </button>
    </div>
  </div>
 </div>
</div>
<!-- Modal -->
<br>

<!--<div id="tabla_historial" class="table-responsive-sm"></div>-->


<!--codigo para generar la tabla de data-table-->
<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar">
<thead class="thead-dark text-center">
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
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query5="SELECT  * FROM historial_conductor ORDER BY id_conductor DESC";
$result5=mysqli_query($con, $query5) or die (mysqli_error());
while ($row=mysqli_fetch_array($result5))
{ 
  echo "<tr>";
  echo "<td class='text-center'>".$row['id_conductor']."</td>";
  echo "<td class='text-center'>".$row['nombre']."</td>";
  echo "<td class='text-center'>".$row['apellido_pat']."</td>";
  echo "<td class='text-center'>".$row['apellido_mat']."</td>";
  echo "<td class='text-center'>".$row['licencia']."</td>";
  echo "<td class='text-center'>".$row['fecha_vencimiento']."</td>";  
  echo "<td class='text-center'>".$row['vehiculo']."</td>";
  echo "<td class='text-center'>".$row['fecha_modificacion']."</td>"; 
  echo "</tr>";
}

mysqli_query($con,$query5) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);

?>
</tbody>
</table>
</div>
<!--codigo para generar la tabla de data-table-->

<!--CODIGO PARA MODAL DE ASIGNACIONES/////////////////////////////////////////////////////////-->
<script type="text/javascript">
function validaForm1(){ 
if($("#conductor").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#conductor").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

    if($("#vehiculo").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }     
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar3").click( function() {
// Primero validará el formulario.
  if(validaForm1()){ 
  $.post("scripts/actualizar_conductor.php",$("#frmupdate1").serialize(),function(res){ 
                if(res == 1){
                     //alert("Fallo al modificar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Error al asignar conductor',                  
                   });
                } else {
                  //alert("Vehículo modificado con éxito!!");
                  //codigo de alert SW2
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Vehículo asignado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    //codigo de alert SW2
                    document.getElementById("frmupdate1").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//limpiar formulario al cerrar modal
function limpiar() {
//document.getElementById("frmupdate1").reset();//limpiar form
//$("#ms1").fadeOut();//limpiar mensaje de aviso
//$("#ms2").fadeOut();
location.reload();
};

//CODIGO PARA MANDAR LLAMAR LA TABLA DE HISTORIAL
   /*function muestradatos5(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra el historial de cambios...</h5>"
    }
    else
    {
      Ajax3=new XMLHttpRequest();
           Ajax3.open("get","scripts/tabla_histoasignacion.php?c="+cadena,true);
           Ajax3.onreadystatechange=function(){
           var ca=document.getElementById("tabla_historial");
           ca.innerHTML=Ajax3.responseText;
            };
           Ajax3.send(null);
    }
  }*/

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
//CODIGO PARA MODAL DE ASIGNACIONES////////////////////////////////////////////////////////////////



//CODIGO PARA EL FORMULARIO DE MODIFICACIONES/////////////////////////////////////////////////
function validaForm10(){
    // Campos de texto
    if($("#conductor1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms10").delay(100).fadeIn("slow");
        $("#conductor1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }  

    if($("#nombre").val() == ""){        
        $("#ms11").delay(100).fadeIn("slow");
        $("#nombre").focus();
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }

    if($("#apellido_pat").val() == ""){        
        $("#ms12").delay(100).fadeIn("slow");
        $("#apellido_pat").focus();
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    }

   if($("#apellido_mat").val() == ""){        
        $("#ms13").delay(100).fadeIn("slow");
        $("#apellido_mat").focus();
        return false;
    }
    else
    {
      $("#ms13").fadeOut();      
    }

  if($("#licencia").val() == ""){        
        $("#ms14").delay(100).fadeIn("slow");
        $("#licencia").focus();
        return false;
    }
    else
    {
      $("#ms14").fadeOut();      
    }
  if($("#fecha").val() == ""){        
        $("#ms15").delay(100).fadeIn("slow");
        $("#fecha").focus();
        return false;
    }
    else
    {
      $("#ms15").fadeOut();      
    }  

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm10()){ 
  $.post("scripts/actualizar_conductor2.php",$("#updateconductor").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al modificar',                  
                   });
                } else {
                    //alert("Conductor agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Condutcor modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("updateconductor").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//este codigo es para bloquear el uso de numeros en campos de solo letras y que tampoco se puedan copiar y pegar
const validar = function(campo) {
  let valor = campo.value;  
  // Verifica si el valor del campo (input) contiene numeros.
  if(/\d/.test(valor)) { 
  //Remueve los numeros que contiene el valor y lo establece en el valor del campo (input).
  campo.value = valor.replace(/\d/g,'');
  }  
};    
//este codigo es para bloquear el uso de numeros en campos de solo letras

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/cargar_valorescondu.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos
        $("#nombre").val(json.nombre);
        $("#apellido_pat").val(json.apellido_pat);
        $("#apellido_mat").val(json.apellido_mat);
        $("#licencia").val(json.licencia);
        $("#fecha_vencimiento").val(json.fecha_vencimiento);
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

  //CODIGO PARA BORRAR REGISTRO
function delete2(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_conductor.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        alert(data);
        //document.getElementById("updateconductor").reset();
        location.reload();
      }
  });
  }  
}//se quita este corchete y el if confirm si no quieres confirmar el eliminar
//CODIGO PARA EL FORMULARIO DE MODIFICACIONES////////////////////////////////////////////////////
//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Historial de asignaciones",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>