<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Mantenimiento</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/tableToExcel.js"></script>

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
<h3 align="center">Registro de Mantenimineto
<i class="fa fa-wrench fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Mantienimiento
      <img src="img/servicio.png">
  </legend>

 <form class="container" id="frmmtto" method="POST">
  <div class="form-row">

      <div class="form-group col-md-3">
      <label for="">Fecha Inicio del Mtto</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div> 
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d");
      ?>
     <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" 
      value="<?php echo $fecha; ?>">
    </div>
     </div>

  <div class="form-group col-md-3">
    <label for="">Servicio</label>
    <select  name="servicio1" id="servicio1" class="form-control" onchange="mifuncion(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM tipos_servicios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_servicio'].'">'.$row['tipo_servicio'].'</option>';

          }
        ?>
    </select>
    <p id="ms" style="display:none" class="error">Seleccione una opción</p>      
    </div>
 
  <input type="hidden" class="form-control" name="servicio" id="servicio">

  <div class="form-group col-md-3">
  <label for="">Rango de tiempo para el servicio</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1">Días/Semanas</span>
  </div> 
  <input type="text" class="form-control" name="tiempo" id="tiempo">
</div>
   <p id="ms1" style="display:none" class="error">El campo tiempo de vencimiento no puede estar vacío</p>
</div>

  <div class="form-group col-md-3"> 
  <label for="">Fecha Final del Mtto(vencimiento)</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text btn btn-outline-success" id="enviardato" type="button" disabled><i class="fa fa-check" style="color: #20c997;"></i><i class="fa fa-calendar" style="color: #20c997;"></i></button>
  </div>
  <input type="text" class="form-control" name="fecha_final" id="fecha_final" disabled><div id="resp"></div>
  </div>
  <p id="ms2" style="display:none" class="error">El campo fecha final no puede estar vacío</p>
  
  </div>
</div>

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
    <p id="ms3" style="display:none" class="error">Seleccione una opción</p>      
    </div>

    <div class="form-group col-md-4">
    <label for="">Kilometraje Inicial</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="km_inicial" id="km_inicial">
   </div>
  <p id="ms4" style="display:none" class="error">El campo kilometraje inicial no puede estar vacío</p>
  </div>

  <div class="form-group col-md-4">
    <label for="">Próximo Kilometraje</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="km_proximo" id="km_proximo">
   </div>
  <p id="ms5" style="display:none" class="error">El campo Próximo kilometraje no puede estar vacío</p>
  </div>

  <!--<div class="form-group col-md-3"> 
  <label for="">Fecha del Próximo Mtto</label>
  <div class="input-group mb-4">
  <div class="input-group-prepend">
  <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
  </div>
  <input type="date" class="form-control" name="fecha_proximo" id="fecha_proximo">
</div>
  <p id="ms6" style="display:none" class="error">El campo próximo mtto no puede estar vacío</p>
  </div>-->
</div>

<h6>Desglose de Gastos</h6>
<hr style="border:1px dotted white;">
     <div class="form-row">
     <div class="form-group col-md-4">
      <label for="">Costo por Refacciones</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="costo_refacciones" id="costo_refacciones">
    </div>
  <p id="ms7" style="display:none" class="error">El campo costo refacciones no puede estar vacío</p> 
     </div>

      <div class="form-group col-md-4">
      <label for="">Costo por Mano de Obra</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="costo_manodeobra" id="costo_manodeobra">
    </div>
  <p id="ms8" style="display:none" class="error">El campo costo mano de obra no puede estar vacío</p> 
     </div>

      <div class="form-group col-md-4">
      <label for="">Costo Total del Mtto</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total" id="costo_total" disabled>
    </div>
  <p id="ms9" style="display:none" class="error">El campo costo total no puede estar vacío</p> 
     </div>   
  </div>

<h6>Infromacón de Referencia</h6>
<hr style="border:1px dotted white;">
<div class="form-row">
<div class="form-group col-md-3">
      <label for="">Referencia</label>
      <input type="text" class="form-control" name="referencia" id="referencia" placeholder="Ej: Factura,Folio,Ticket,etc">
      <p id="ms10" style="display:none" class="error">El campo referencia no puede estar vacío</p>
    </div>

     <div class="form-group col-md-3">
      <label for="">Tipo de Mantenimiento</label>
      <select name="tipo_mtto" id="tipo_mtto" class="form-control">
        <option value="">Seleccione...</option>
        <option value="preventivo">Mtto Preventivo</option>
        <option value="correctivo">Mtto Correctivo</option>              
      </select>
      <p id="ms11" style="display:none" class="error">Seleccione una opción</p>
    </div>

    <div class="form-group col-md-3">
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
    <p id="ms12" style="display:none" class="error">Seleccione una opción</p>      
    </div> 

<div class="form-group col-md-3">
<label for="">Observaciones/Comentarios</label>
<textarea name="observaciones" id="observaciones"></textarea> 
</div> 
</div>

<h6>Incidentes Reportados</h6>
<hr style="border:1px dotted white;">
<div class="form-row">
<div class="form-group col-md-3"> 
</div>
<div class="form-group col-md-3"> 
  <label for="">Incidencias</label>
  <input type="hidden" class="form-control" name="incidente" id="incidente">
  <select  name="incidente1" id="incidente1" class="form-control" onchange="mifuncion1(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM incidentes";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_incidente'].'">'.$row['incidente'].'</option>';
          }
        ?>
    </select>   
</div>

<div class="form-group col-md-3">
<label for="">Describe la incidencia</label>
<textarea name="descripcion_incidente" id="descripcion_incidente"></textarea> 
</div> 
<div class="form-group col-md-3"> 
</div>
</div>

<hr>
<div class="form-row">
<div class="form-group col-md-12">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<button type="button" onclick="location.href='modificar_mtto.php'" class="btn btn-info hvr-sink">
 Modificar Mtto.    
</button>
    </div>   
  </div>
</form>   

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<script type="text/javascript">
//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('referencia').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});
//este codigo es para bloquear el uso de letras en campos de solo numeros positivos

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

function mifuncion(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valoresmtto.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos
        $("#servicio").val(json.servicio);      
        $("#tiempo").val(json.tiempo);
                         
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

  $(document).ready(function(){
    $("#enviardato").click(function(){
        var tiempo = $("#tiempo").val();
        //tiempo = document.getElementById("tiempo").value

        $.ajax({
            type: "POST",
            url: "scripts/sumar_fecha.php",
            data: {tiempo:tiempo},
            success: function(data){              
                $('#fecha_final').val(data);
            }
        });
    });
});

 /* obtener el valor de un input se imprime en console
 function obtenerValor(){
  valor = document.getElementById("tiempo").value//obtener valor del input
  valorEnvio = valor //declarar valor a la variable a usar en el ajax
  console.log(valorEnvio)  */

  function validaForm30(){
    // Campos de texto
    if($("#servicio").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#servicio").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#tiempo").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#tiempo").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

   if($("#fecha_final").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#fecha_final").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#vehiculo").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }
  if($("#km_inicial").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#km_inicial").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

  if($("#km_proximo").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#km_proximo").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

     /*if($("#fecha_proximo").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#fecha_proximo").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }*/

     if($("#costo_refacciones").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#costo_refacciones").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

     if($("#costo_manodeobra").val() == ""){        
        $("#ms8").delay(100).fadeIn("slow");
        $("#costo_manodeobra").focus();
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }

     if($("#costo_total").val() == ""){        
        $("#ms9").delay(100).fadeIn("slow");
        $("#costo_total").focus();
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }

     if($("#referencia").val() == ""){        
        $("#ms10").delay(100).fadeIn("slow");
        $("#referencia").focus();
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }

     if($("#tipo_mtto").val() == ""){        
        $("#ms11").delay(100).fadeIn("slow");
        $("#tipo_mtto").focus();
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }

     if($("#proveedor").val() == ""){        
        $("#ms12").delay(100).fadeIn("slow");
        $("#proveedor").focus();
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    }
    
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm30()){ 
  $.post("scripts/reg_mantenimiento.php",$("#frmmtto").serialize(),function(res){
 
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
                     title: 'Mantenimiento agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmmtto").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});
//CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal").click(function(){
        var costo_refacciones = $("#costo_refacciones").val();
        var costo_manodeobra = $("#costo_manodeobra").val();
        //tiempo = document.getElementById("tiempo").value

        $.ajax({
            type: "POST",
            url: "scripts/suma_costo.php",
            data: {costo_refacciones:costo_refacciones,costo_manodeobra:costo_manodeobra},
            success: function(data){              
                $('#costo_total').val(data);
            }
        });
    });
});

//habilitar el boton por medio del select
$( function() {
    $("#servicio1").change( function() {
        if ($(this).val() === "0") {
            $("#enviardato").prop("disabled", true);
        } else {
            $("#enviardato").prop("disabled", false);
        }
    });
});
//habilitar el input pór medio del boton
$( function() {
  $("#enviardato").on("click", function(){
        if ($(this).val() === "0") {
            $("#fecha_final").prop("disabled", true);
        } else {
            $("#fecha_final").prop("disabled", false);
        }
    });
});

$( function() {
  $("#enviartotal").on("click", function(){
        if ($(this).val() === "0") {
            $("#costo_total").prop("disabled", true);
        } else {
            $("#costo_total").prop("disabled", false);
        }
    });
});

//para traer los datos del select de incidencias
function mifuncion1(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valoresinci.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos
         $("#incidente").val(json.incidente);   
        $("#descripcion_incidente").val(json.descripcion_incidente);
                         
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }
</script>
</body>
</html>

