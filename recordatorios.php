<?php
include 'menu.php';

//consulta y ciclo for para los eventos(recordatorios)
try{
$pdo = new PDO("mysql:host=localhost; dbname=controldeflotilla;","root","");
$sth=$pdo->query("SELECT  * FROM recordatorios");
/*foreach ($sth as $fila) {
echo $fila['id_recordatorio'];
echo $fila['actividad'];
echo $fila['descripcion'];
echo $fila['fecha_inicio'];
echo $fila['fecha_final'];
	
}*/
//echo "conectado";
}
catch(PDOException $e){
echo "no conectado";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recordatorios</title>
<!--librerias para full calendar-->
<link rel="stylesheet" type="text/css" href="fullcalendar-4.2.0/packages/core/main.min.css">
<link rel="stylesheet" type="text/css" href="fullcalendar-4.2.0/packages/daygrid/main.min.css">

<script type="text/javascript" src="fullcalendar-4.2.0/packages/core/main.min.js"></script>
<script type="text/javascript" src="fullcalendar-4.2.0/packages/daygrid/main.min.js"></script>
<script type="text/javascript" src="fullcalendar-4.2.0/packages/interaction/main.min.js"></script>
<script type="text/javascript" src="jquery/moment.js"></script>
<!--cambiar el idioma-->
<script type="text/javascript" src="fullcalendar-4.2.0/packages/core/locales/es.js"></script>

	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid','interaction' ],
          //cambiar el idioma
          locale:'es',

       dateClick: function(info) {
       $("#exampleModal").modal("show");
       $("#fecha_inicio").val(info.dateStr);

       //fecha 
       //alert('Fecha: ' + info.dateStr);

       //posiocion en coordenadas
       //alert('Coordenadas: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);

       //title:mes y año type: dias, meses,años
       //alert('Current view: ' + info.view.type);

       //pinta de color el cuadro de fecha
       info.dayEl.style.backgroundColor = '#76D7C4';
       },
       
       //para ver la informacion de los eventos
       eventClick: function(info){
       $("#exampleModal2").modal("show");
       $("#exampleModalLabel").html(info.event.title);
       $("#desc").val(info.event.extendedProps.description);
       $("#id").val(info.event.id);
       $("#actividad1").val(info.event.title);
       //mostrar la fecha con formato correcto
       $("#fecha_final1").val(moment(info.event.end).format('YYYY-MM-DD'));     
       
       //recuperar la descripcion del recordatorio se añadio _def.extendedProps para poder utilizarlo
       //console.log(info.event._def.extendedProps.description);
       //alert('Event: ' + info.event._def.extendedProps.description);
       
       //recuperar la fecha en formato deseado se tuvo que agregar la libreria de moment.js la que trae fullcalendar no funciona correctamente
       //alert('Event: ' + moment(info.event.end).format('DD/MM/YYYY'));

       //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
       //alert('View: ' + info.view.type);   
       info.el.style.borderColor = '#00e676';
       },
          //limitar los eventos por caja de dia a 3
          eventLimit:true,

          //crear los eventos
          events:[
         <?php
         foreach ($sth as $fila) { 
         ?> 
         {
           id:"<?php echo $fila['id_recordatorio'];?>",
           title:"<?php echo $fila['actividad'];?>",
           description:"<?php echo $fila['descripcion'];?>",
           start:"<?php echo $fila['fecha_inicio'];?>",
           end:"<?php echo $fila['fecha_final'];?>",
           editable:"<?php echo $fila['editable'];?>",
           color:"<?php echo $fila['color'];?>"
           
           //textColor:"white"             
         },
       <?php   
        }
       ?>                   
      ] 
        });
        calendar.render();
      });
//////////////////////////////////////////////////////////////////////////////////////////////
//funcion para registrar
 function validaForm(){    
    
    if($("#actividad").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#actividad").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

   if($("#descripcion").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#descripcion").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#fecha_final").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#fecha_final").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }
  if($("#color").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#color").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }  
     return true; 
}

$(document).ready( function() {  
 $("#btnguardar").click( function() {
  if(validaForm()){ 
  $.post("scripts/reg_recordatorios.php",$("#frmrecordatorios").serialize(),function(res){
 
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
                     title: 'Recordatorio agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmrecordatorios").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//actualizar pagina al cerrar modal para ver el nuevo evento en el calendario
function refresh() {
location.reload();
};

//borrar recordatorios/////////////////////////////////////////////////////////////
$(document).ready( function() {  
 $("#btnborrar").click( function() {
 if(confirm("Esta seguro que desea eliminar este registro?")){   
  $.post("scripts/borrar_recordatorio.php",$("#frmborrar").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al borrar',                  
                   });
                } else {
                    //alert("Conductor agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Recordatorio borrado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });                    
                   }
               });
             }        
          });    
      });

//funcion para modificar
 function validaForm1(){    
    
    if($("#actividad1").val() == ""){        
        $("#ns1").delay(100).fadeIn("slow");
        $("#actividad1").focus();
        return false;
    }
    else
    {
      $("#ns1").fadeOut();      
    }

    if($("#fecha_final1").val() == ""){        
        $("#ns2").delay(100).fadeIn("slow");
        $("#fecha_final1").focus();
        return false;
    }
    else
    {
      $("#ns2").fadeOut();      
    }  

   if($("#desc").val() == ""){        
        $("#ns3").delay(100).fadeIn("slow");
        $("#desc").focus();
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }  
     return true; 
}

$(document).ready( function() {  
 $("#btnmodificar").click( function() {
  if(validaForm1()){ 
  $.post("scripts/actualizar_recordatorios.php",$("#frmborrar").serialize(),function(res){
 
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
                     title: 'Recordatorio modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    //document.getElementById("frmborrar").reset();
                }
            });
        }
    });    
});
	</script>
</head>
<body>
<div class="bg-info clearfix">
<h3 align="center">Recordatorios 
<i class="fa fa-sticky-note fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Registrar Recordatorios
    <img src="img/note.png">
  </legend>
<button type="button" onclick="location.href='reg_mantenimiento.php'" class="btn btn-info hvr-sink">
 Aplicar Mantenimiento    
</button>
<button type="button" onclick="location.href='notificaciones.php'" class="btn btn-info hvr-sink">Alertas Mtto Pendientes  
</button>
<div class="ola badge badge-warning">?
<span class="ola2">NOTA: La fecha final no se visualiza en el calendario,<br> solo las fechas previas.</span>
</div>
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->
<br>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div id='calendar'></div>
  </div>
  <div class="col-md-2"></div>
</div>

<!-- Modal se le agrego un 1 a exampleModalLabel pa diferenciarlo del segundo-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel1">Registre Recordatorio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form class="container" id="frmrecordatorios" method="POST">
      <div class="form-row">
      <div class="form-group col-md-6">   
      <label>Fecha inicial:</label>
      <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" style=" border: 0;" readonly>      
      </div>
      <div class="form-group col-md-6">
      <label>Actividad:</label>
      <input type="text" class="form-control" name="actividad" id="actividad">
      <p id="ms1" style="display:none" class="fallo">El campo actividad no puede estar vacío</p>
      </div>  
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
      <label>Descripción:</label>
      <input type="text" class="form-control" name="descripcion" id="descripcion">
      <p id="ms2" style="display:none" class="fallo">El campo descripción no puede estar vacío</p>
      </div>
      <div class="form-group col-md-6">
      <label>Fecha final:</label>
      <input type="date" class="form-control" name="fecha_final" id="fecha_final">
      <p id="ms3" style="display:none" class="fallo">El campo fecha final no puede estar vacío</p>
      </div>    
      </div>
      <div class="form-row">      
      <div class="form-group col-md-6">
      <label>Color:</label>
      <input type="color" class="form-control" name="color" id="color">
      <p id="ms4" style="display:none" class="fallo">El campo color no puede estar vacío</p>
      </div>
      <div class="form-group col-md-6">      
      <input type="hidden" class="form-control" name="editable" id="editable" value="1">
      </div>    
      </div>     
      </form>
      </div>
      <div class="modal-footer  bg-info">       
        <button type="button" class="btn btn-dark" id="btnguardar">Enviar</button>
      </div>
    </div>
  </div>
</div>
<!--Modal--> 

<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="container" id="frmborrar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-6">  
      <label>ID:</label>  
      <input type="text" class="form-control" name="id" id="id" readonly>
      </div>      
      <div class="form-group col-md-6">
      <label>Actividad:</label>
      <input type="text" class="form-control" name="actividad1" id="actividad1">
      <p id="ns1" style="display:none" class="fallo">El campo actividad no puede estar vacío</p>
      </div>    
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
      <label>Fecha final:</label>
      <input type="date" class="form-control" name="fecha_final1" id="fecha_final1">
      <p id="ns2" style="display:none" class="fallo">El campo fecha final no puede estar vacío</p> 
      </div>  
      <div class="form-group col-md-6">
      <label>Descripción:</label>  
      <textarea name="desc" id="desc"></textarea>
      <p id="ns3" style="display:none" class="fallo">El campo descripción no puede estar vacío</p>
      </div>
      </div>  
      </form>
      </div>
      <div class="modal-footer bg-info">
        <button type="button" class="btn btn-dark" id="btnmodificar">Modificar</button>
        <button type="button" class="btn btn-danger" id="btnborrar">Borrar</button>              
      </div>
    </div>
  </div>
</div>
<!-- Modal2 -->

 <!--librerias para jquery,boostrap-->
 <!--<script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
 <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
 <script type="text/javascript" src="bootstrap_4.3.1/js/popper.min.js"></script>-->
 <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
 <link rel="stylesheet" type="text/css" href="css/error.css">
 <link rel="stylesheet" type="text/css" href="css/boton.css">
</body>
</html>
