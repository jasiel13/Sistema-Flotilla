<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Listado de Partes</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
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
<div class="bg-info clearfix">
<h3 align="center">Listado de Partes
<i class="fa fa-clipboard fa-2x"></i>
</h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Listado de Partes
    <img src="img/listado.png">
  </legend>

<form class="container" id="listadopartes" method="POST">
   <div class="form-row">

    <div class="form-group col-md-4">
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
    <p id="ms1" style="display:none" class="error">El campo vehículo no puede estar vacío</p>      
    </div>

    <div class="form-group col-md-4">
      <label for="">Fecha de Registro</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div> 
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d");
      ?>
     <input type="text" class="form-control" name="fecha" id="fecha" 
      value="<?php echo $fecha; ?>">
    </div>
  </div>

    <div class="form-group col-md-4">
    <label for="">Partes</label>
    <select  name="partes" id="partes" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM refacciones";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['partes'].'">'.$row['partes'].'</option>';
          }
        ?>
    </select>
    <p id="ms2" style="display:none" class="error">El campo partes no puede estar vacío</p>      
    </div>   
   </div>

  <div class="form-row">
  <div class="form-group col-md-4">
   <label for="">Tipo</label>
      <select name="tipo" id="tipo" class="form-control">
        <option value="">Seleccione...</option>
        <option value="garantía">Garantía</option>
        <option value="garantía">Garantía Expirada</option>                 
      </select>
      <p id="ms3" style="display:none" class="error">El campo tipo no puede estar vacío</p> 
    </div>
    
     <div class="form-group col-md-4">
      <label for="">Monto</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="monto" id="monto">
    </div>
  <p id="ms4" style="display:none" class="error">El campo monto no puede estar vacío</p> 
     </div> 

    <div class="form-group col-md-4">
    <label for="">Proveedor</label>
    <select  name="proveedor" id="proveedor" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM proveedores";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';
          }
        ?>
    </select>
    <p id="ms5" style="display:none" class="error">El campo proveedor no puede estar vacío</p>      
    </div>   
  </div> 

 <hr>
 <div class="form-row">
 <div class="form-group col-md-4">
<button type="button" class="btn btn-warning hvr-sink" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar
</button>
 </div> 
 <div class="form-group col-md-4">
<button type="button" id="btnguardar1" class="btn btn-info hvr-rotate">Enviar</button>

<!--BOTON DROPDOWN-->
 <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Listado de Refacciones
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

    <a class="dropdown-item" onclick="muestradatos()" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye fa-fw"></i> Ver Marcas</a>

      <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-sm">
      <i class="fa fa-plus fa-fw"></i>Agregar</a>
    </div>
  </div>
</div>
</div>

<div class="form-group col-md-4">
 <button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
 <button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>
</div>
</div>
</form>

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<!--MODAL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Refacciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="container" id="frmagregar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-12">
      <label for="">Nombre</label>
    <input type="text" class="form-control" name="refacciones" id="refacciones" placeholder="Ej: Piston">
    <p id="ns" style="display:none" class="fallo">El campo refacciones no puede estar vacío</p>
  
      </div>        
      </div>   
    </form>
     
    </div>
    <div class="modal-footer bg-info"> 
    <button type="button" id="btnagregar" class="btn btn-dark">Enivar</button>    
     
    </div>
    </div>
  </div>
</div>
<!--modal-->

<!--modal para la tabla-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver <i class="fa fa-eye fa-fw"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Codigo para mostrar tabla de datos -->
      <div id="tabla_1" class="table-responsive-sm"></div>     
    </div>
  </div>
</div>
<!--modal para la tabla-->


<!--codigo de modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Listado de Partes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="updaterefacciones" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >Id Refacciones</label>
      <select  name="id_refacciones" id="id_refacciones" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM listado_partes";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_refacciones'].'">'.$row['id_refacciones'].'</option>';
          }
        ?>
      </select>
     <p id="ns1" style="display:none" class="fallo">Coloque el id de la refaccion que desea modificar</p>
   </div>

   <div class="form-group col-md-6">
    <label for="" >Vehículo</label>
      <select  name="vehiculo1" id="vehiculo1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
      </select>
     <p id="ns2" style="display:none" class="fallo">El campo vehículo no puede ir vacío</p>
   </div>
 </div>


 <div class="form-row">
<div class="form-group col-md-6">
 <label for="">Partes</label>
    <select  name="parte1" id="parte1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM refacciones";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['partes'].'">'.$row['partes'].'</option>';
          }
        ?>
    </select>
    <p id="ns3" style="display:none" class="fallo">El campo partes no puede estar vacío</p>   
</div>

    <div class="form-group col-md-6">
      <label for="">Tipo</label>
      <select name="tipo1" id="tipo1" class="form-control">
        <option value="">Seleccione...</option>
        <option value="garantía">Garantía</option>
        <option value="garantía expirada">Garantía Expirada</option>                 
      </select>
      <p id="ns4" style="display:none" class="fallo">El campo tipo no puede estar vacío</p> 
      </div>
</div>
 
<div class="form-row">
 <div class="form-group col-md-6">
 <label for="">Monto</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="monto1" id="monto1">
    </div>
  <p id="ns5" style="display:none" class="fallo">El campo monto no puede estar vacío</p> 
</div>

    <div class="form-group col-md-6">
    <label for="">Proveedor</label>
    <select  name="proveedor1" id="proveedor1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM proveedores";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';
          }
        ?>
    </select>
    <p id="ns6" style="display:none" class="fallo">El campo proveedor no puede estar vacío</p>
     </div>    
    </div>
</form> 
</div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar" class="btn btn-dark">Modificar</button>
      <button type="button" class="btn btn-dark" onclick="delete1($('#id_refacciones').val())">Eliminar</button>          
    </div>
  </div>
</div>
</div>
<!-- Modal -->

<!--codigo para generar la tabla de data-table-->
<div class="container">
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
<th>ID</th>  
<th>Vehículo</th>
<th>Fecha de Registro</th>
<th>Partes</th>
<th>Tipo</th>
<th>Monto</th>
<th>Proveedor</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="select id_refacciones,vehiculo,fecha,parte,tipo,monto,proveedor from listado_partes order by id_refacciones desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){ 

$datos=$row['id_refacciones']."||".
$row['vehiculo']."||".
$row['fecha']."||".
$row['parte']."||".
$row['tipo']."||".
$row['monto']."||".
$row['proveedor'];
?>
  <tr> 
    <td class="text-center"><?php echo$row['id_refacciones']?></td>  
    <td class="text-center"><?php echo$row['vehiculo']?></td>
    <td class="text-center"><?php echo$row['fecha']?></td>
    <td class="text-center"><?php echo$row['parte']?></td>
    <td class="text-center"><?php echo$row['tipo']?></td>
    <td class="text-center"><?php echo$row['monto']?></td>
    <td class="text-center"><?php echo$row['proveedor']?></td>
  </tr>  
<?php
 }
mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>
</tbody>
</table>
</div>
</div>
<!--codigo para generar la tabla de data-table-->

<script type="text/javascript"> 
  function validaForm(){
    // Campos de texto
    if($("#vehiculo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms1").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

    if($("#partes").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#partes").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

   if($("#tipo").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#tipo").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

  if($("#monto").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#monto").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }
  if($("#proveedor").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#proveedor").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    } 
   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar1").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_listadopartes.php",$("#listadopartes").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {
                    //alert("Conductor agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Registro de Listado de Partes agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("listadopartes").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//VALIDAR QUE SEAN SOLO NUMEROS ENTEROS Y DECIMALES DENEGAR LETRAS
const inputs = document.querySelectorAll('.numerico');

Array.from(inputs).forEach(function(input) {
  input.addEventListener('keypress', function(e) {
    // keyCode del punto decimal, también se puede cambiar por la coma que sería el 44
    const decimalCode = 46;
    // chequeo que el keyCode corresponda a las teclas de los números y al punto decimal
    if ((e.keyCode < 48 || e.keyCode > 57) && e.keyCode != decimalCode) {
      e.preventDefault();
    }
    // chequeo que sólo exista un punto decimal
    else if (e.keyCode == decimalCode && /\./.test(this.value)) {
      event.preventDefault();
    }
  }, true)
});


//registrar datos del modal////////////////////////////////////////////////////////
function validaForm2(){
    // Campos de texto
    if($("#refacciones").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns").delay(100).fadeIn("slow");
        $("#refacciones").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns").fadeOut();      
    }

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnagregar").click( function() {
// Primero validará el formulario.
  if(validaForm2()){ 
  $.post("scripts/reg_refacciones.php",$("#frmagregar").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Refacciones agregada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmagregar").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//CODIGO PARA MANDAR LLAMAR LA TABLA DEL MODAL
   function muestradatos(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de las refacciones...</h5>"
    }
    else
    {
      Ajax2=new XMLHttpRequest();
           Ajax2.open("get","scripts/tabla_refacciones.php?c="+cadena,true);
           Ajax2.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax2.responseText;
            };
           Ajax2.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DEL MODAL

//funcion modificar////////////////////////////////////////////////////////////////////
 function validaForm5(){
    // Campos de texto
    if($("#id_refacciones").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#id_refacciones").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns1").fadeOut();      
    }
    // Campos de texto
    if($("#vehiculo1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns2").delay(100).fadeIn("slow");
        $("#vehiculo1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns2").fadeOut();      
    }

    if($("#parte1").val() == ""){        
        $("#ns3").delay(100).fadeIn("slow");
        $("#parte1").focus();
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }

   if($("#tipo1").val() == ""){        
        $("#ns4").delay(100).fadeIn("slow");
        $("#tipo1").focus();
        return false;
    }
    else
    {
      $("#ns4").fadeOut();      
    }

  if($("#monto1").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#monto1").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }
  if($("#proveedor1").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#proveedor1").focus();
        return false;
    }
    else
    {
      $("#ns6").fadeOut();      
    }    
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm5()){ 
  $.post("scripts/actualizar_refacciones.php",$("#updaterefacciones").serialize(),function(res){
 
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
                     title: 'Listado de Partes modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("updaterefacciones").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valores_refacciones.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos    
        $("#vehiculo1").val(json.vehiculo1);
        $("#parte1").val(json.parte1);
        $("#tipo1").val(json.tipo1);
        $("#monto1").val(json.monto1);
        $("#proveedor1").val(json.proveedor1);        
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }


 //CODIGO PARA BORRAR REGISTRO
function delete1(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_refacciones.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        alert(data);
        document.getElementById("updaterefacciones").reset();        
      }
  });
  }  
}//se quita este corchete y el if confirm si no quieres confirmar el eliminar*/

function limpiar() {
//document.getElementById("frmupdate").reset();//limpiar form
//$("#ms1").fadeOut();//limpiar mensaje de aviso
location.reload(); 
};

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

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Registro de Listado de Partes",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>