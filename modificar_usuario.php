<?php session_start();

require 'admin/config.php';
require 'functions.php';

//este codigo es para que el usuario de tipo usuario no entre a registro.php
if (!isset($_SESSION['usuario'])) 
{
  header('Location: '.RUTA.'login.php');
}
$conexion = conexion($bd_config);
$admin = iniciarSession('usuarios', $conexion);

if ($admin['tipo'] == 'administrador')
 {
  // traer el nombre del usuario
  $admin = iniciarSession('usuarios', $conexion);
   }
   else
   {
   	header('Location: '.RUTA.'modificar_usuario2.php');

   }


   include 'menu.php';
   $con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error()); 
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Modificar Usuarios</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>    
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
 

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
  </head>

<body>
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix">
<h3 align="center">Modificar Usuarios
<i class="fa fa-group fa-2x"></i></h3> 
</div>

<!--modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tabla de Usuarios</h5>
        <!--boton para exportar a excel-->
        <button type="button" class="btn btn-outline-dark btn-sm mx-auto" id="excel">Exportar a excel</button> 

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Codigo para mostrar tabla de datos -->
      <div id="tabla_1" class="table-responsive-sm"></div>       
    </div>
  </div>
</div>
<!--modal-->

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">

<form class="container" id="frmusuario" method="POST">
<legend>Información del Usuario</legend>
<div class="form-row">
  <div> 
<img src="img/img_avatar3.png" class="rounded-circle img-thumbnail" alt="imagen de perfil" style="margin:20px; width:150px;"> 
 </div>
 <div class="form-group col-md-2" style="margin:20px;">
 <label for="">Usuarios</label>
  <select  name="usuario1" id="usuario1" class="form-control" onchange="mifuncion4(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM usuarios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_usuario'].'">'.$row['usuario'].'</option>';
          }
        ?>  
      </select>
      <p id="ms" style="display:none" class="error">Seleccione el usuario que desea modificar</p>
    </div>

  <div class="form-group col-md-2" style="margin:20px;">
   <label for="">Usuario</label>
<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
    <p id="ms1" style="display:none" class="error">El campo usuario no puede estar vacío</p>
  </div>
    
   <div class="form-group col-md-2" style="margin:20px;">
     <label for="">Contraseña</label>
     <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" autocomplete="on">
     <p id="ms2" style="display:none" class="error">El campo contraseña no puede estar vacío</p>
  </div>

  <div class="form-group col-md-2" style="margin:20px;">
      <label for="">Rol</label>
      <select class="form-control" name="tipo" id="tipo">
    		<option value="">Seleccionar</option>
    		<option value="administrador">Administrador</option>
    		<option value="usuario">Usuario</option>
    	</select>
      <p id="ms3" style="display:none" class="error">Seleccione una opción</p>
    </div> 
</div>      

<hr>
<button type="button" id="btneditar" class="btn btn-warning hvr-rotate"> <i class="fa fa-edit" style="color:black;"></i> Modificar</button>
<button type="button" class="btn btn-warning hvr-rotate" onclick="deleteusu($('#usuario1').val())"><i class="fa fa-trash" style="color:black;"></i>  Eliminar</button>
<button class="btn btn-primary hvr-sink" type="button" onclick="muestradatos7()" data-toggle="modal" data-target=".bd-example-modal-lg">Ver tabla</button>
</form>                
 
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<script type="text/javascript">		
	function validaForm6(){
    // Campos de texto
    if($("#usuario1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#usuario1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#usuario").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#usuario").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

     if($("#password").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#password").focus();
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
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btneditar").click( function() {
// Primero validará el formulario.
  if(validaForm6()){ 
  $.post("scripts/actualizar_usuario.php",$("#frmusuario").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al modificar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Usuario modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmusuario").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});


function mifuncion4(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/cargar_valoresusuario.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos  
        $("#usuario").val(json.usuario);
        $("#password").val(json.password);
        $("#tipo").val(json.tipo);       
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

 //CODIGO PARA BORRAR REGISTRO
function deleteusu(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_usuario.php',
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

//CODIGO PARA MANDAR LLAMAR LA TABLA DE USUARIOS
   function muestradatos7(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de los usuarios...</h5>"
    }
    else
    {
      Ajax7=new XMLHttpRequest();
           Ajax7.open("get","scripts/tabla_usuarios.php?c="+cadena,true);
           Ajax7.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax7.responseText;
            };
           Ajax7.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DE USUARIOS

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Usuarios del Sistema",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>