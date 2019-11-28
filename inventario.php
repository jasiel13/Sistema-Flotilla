<?php include 'menu.php'; 
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Inventario</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
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
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix">
<h3 align="center">Inventario
<i class="fa fa-book fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de los Vehículos
    <img src="img/camion.png">
  </legend>
<!--<button class="btn btn-primary hvr-pop" type="button" onclick="muestradatos3()">Ver Inventario</button>-->
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla
</button>
<button type="button" class="btn btn-warning hvr-pop" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar/Eliminar
</button>
<br>
<br>
<br>
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<!--<div id="tabla_3" class="table-responsive-sm"></div>-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Vehículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="frmupdate" method="POST">
  <div class="form-row">
   <div class="form-group col-md-6">
    <label for="" >Vehículo</label>
      <select  name="no_unidad" id="no_unidad" class="form-control" onchange="mifuncion(this.value)">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['no_unidad'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
      </select>
     <p id="ms1" style="display:none" class="fallo">Coloque el nombre de la unidad que desea modificar</p>
   </div>
  <div class="form-group col-md-6">
      <label for="">Rendimiento</label>
      <input type="text" class="form-control" name="rendimiento" id="rendimiento" placeholder="Rendimiento"> 
      <p id="ms2" style="display:none" class="fallo">El campo rendimiento no puede ir vacío</p>    
    </div> 
   </div>  

  <div class="form-row">   
      <div class="form-group col-md-6">
      <label for="">Status</label>
      <select name="status" id="status" class="form-control">
        <option value="">Seleccione...</option>
        <option value="disponible">Disponible</option>
        <option value="taller">En taller</option>
        <option value="fuera de servicio">Fuera de servicio</option>
        <option value="ocupado">Ocupado/En uso</option>           
      </select>
    <p id="ms3" style="display:none" class="fallo">El campo status no puede ir vacío</p>      
     </div>
  <div class="form-group col-md-6"> 
  <label for="">Renovación de Placas</label>
  <input type="date" class="form-control" name="fecha" id="fecha"> 
  <p id="ms4" style="display:none" class="fallo">El campo fecha no puede ir vacío</p>   
</div>      
  </div> 

<div class="form-row">
<div class="form-group col-md-6">
      <label for="">Empresa</label>
      <select name="empresa" id="empresa" class="form-control">
        <option value="">Seleccione...</option>
        <option value="csn">CSN</option>
        <option value="sea">SEA</option>
        <option value="cta">CTA</option>      
      </select>
    <p id="ms5" style="display:none" class="fallo">El campo empresa no puede ir vacío</p>      
    </div>
<div class="form-group col-md-6">
      <label for="">Departamento</label>
      <select name="departamento" id="departamento" class="form-control">
        <option value="">Seleccione...</option>
        <option value="ventas">Ventas</option>
        <option value="compras">Compras</option>
        <option value="contabilidad">Contabilidad</option>
        <option value="almacen">Almacen</option>
        <option value="sea">Usuarios de SEA</option>
        <option value="cta">Usuarios de CTA</option>
        <option value="gerencia">Gerencia</option>
      </select>
    <p id="ms6" style="display:none" class="fallo">El campo departamento no puede ir vacío</p> 
    </div>
</div>
</form>

      </div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar" class="btn btn-dark">Enivar</button>
      <button type="button"  class="btn btn-dark" onclick="delete1($('#no_unidad').val())">Eliminar</button>      
    </div>
  </div>
</div>
</div>
<!-- Modal -->

<!--codigo para generar la tabla de data-table-->
<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar">
<thead class="thead-dark">
<tr>
<th>No_unidad</th>
<th>Vehículo</th>
<th>Marca</th>
<th>Modelo</th>
<th>Año</th>
<th>Placa</th>
<th>Tipo de vehículo</th>
<th>Fecha Renovación Placas</th>
<th>Depto.</th>
<th>Empresa</th>
<th>Medida_uso</th>
<th>Rendimiento</th>
<th>No_serie</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query2="SELECT  * FROM vehiculo";
$result=mysqli_query($con, $query2) or die (mysqli_error());

while ($row=mysqli_fetch_array($result))
{   
  echo "<tr>";
  echo "<td>".$row['no_unidad']."</td>";
  echo "<td>".$row['vehiculo']."</td>";
  echo "<td>".$row['marca']."</td>";
  echo "<td>".$row['modelo']."</td>";
  echo "<td>".$row['ano']."</td>";
  echo "<td>".$row['placa']."</td>";  
  echo "<td>".$row['tipo']."</td>"; 
  echo "<td>".$row['fecha']."</td>";  
  echo "<td>".$row['departamento']."</td>";   
  echo "<td>".$row['empresa']."</td>";
  echo "<td>".$row['medida_uso']."</td>"; 
  echo "<td>".$row['rendimiento']."</td>";  
  echo "<td>".$row['no_serie']."</td>";
  echo "<td>".$row['status']."</td>"; 
  echo "</tr>";
}

mysqli_query($con,$query2) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>
</tbody>
</table>
</div>
<!--codigo para generar la tabla de data-table-->
 
<script type="text/javascript">
function validaForm(){ 
if($("#no_unidad").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#no_unidad").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }  
if($("#rendimiento").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#rendimiento").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }  
if($("#status").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#status").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }  
if($("#fecha").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#fecha").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }  
 if($("#empresa").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#empresa").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }  
if($("#departamento").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#departamento").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }  
     return true; // Si todo está correcto
}
// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/actualizar_vehiculo.php",$("#frmupdate").serialize(),function(res){ 
                if(res == 1){
                     //alert("Fallo al modificar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Error al modificar Vehículo',                  
                   });
                } else {
                  //alert("Vehículo modificado con éxito!!");
                  //codigo de alert SW2
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Vehículo modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    //codigo de alert SW2
                    document.getElementById("frmupdate").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});


function mifuncion(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/cargar_valores.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos
        $("#rendimiento").val(json.rendimiento);
        $("#status").val(json.status);
        $("#fecha").val(json.fecha);
        $("#empresa").val(json.empresa);
        $("#departamento").val(json.departamento);
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

	//CODIGO PARA MANDAR LLAMAR LA TABLA DE VEHICULOS
   /*function muestradatos3(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de vehiculos...</h5>"
    }
    else
    {
      Ajax3=new XMLHttpRequest();
           Ajax3.open("get","scripts/tabla_inventario.php?c="+cadena,true);
           Ajax3.onreadystatechange=function(){
           var ca=document.getElementById("tabla_3");
           ca.innerHTML=Ajax3.responseText;
            };
           Ajax3.send(null);
    }
  }*/
//CODIGO PARA MANDAR LLAMAR LA TABLA DE VEHICULOS

//CODIGO PARA BORRAR REGISTRO
function delete1(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_registro.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        alert(data);
        document.getElementById("frmupdate").reset();                     
      }
  });
  }  
}//se quita este corchete y el if confirm si no quieres confirmar el eliminar
//CODIGO PARA BORRAR REGISTRO

//limpiar formulario al cerrar modal
function limpiar() {
//document.getElementById("frmupdate").reset();//limpiar form
//$("#ms1").fadeOut();//limpiar mensaje de aviso
location.reload(); 
};
//limpiar formulario al cerrar modal 

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
</script>
</body>
</html>