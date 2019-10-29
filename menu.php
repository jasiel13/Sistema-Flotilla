<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Document</title>
    
    <!--jquery librerias-->
  <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    
    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap_4.3.1/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap_4.3.1/js/bootstrap.min.js"></script>   

    <!--librerias para crear animaciones-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <script type="text/javascript" src="wowjs/wow.min.js"></script>
    <script type="text/javascript">new WOW().init();</script> 

    <!--librerias para crear efecto hover-->
    <link rel="stylesheet" type="text/css" href="Hover/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">  

    <!--se utilizo para crear el submenu-->
    <link rel="stylesheet" type="text/css" href="css/submenu.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
  <img src="img/carro.png" width="50" height="50" alt="">
  Control de Flotilla
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">      
      
      <li class="nav-item dropdown">        
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-truck"></i> 
          Vehículos
        </a> 
        <!--se cambiara este div por un ul para que funcione el submenu-->     
        <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <!--se cambiara este div por un ul para que funcione el submenu--> 

          <a class="dropdown-item" href="registro_vehiculos.php">Registrar Vehículo</a>
          <a class="dropdown-item" href="inventario.php" >Inventario</a>
          <a class="dropdown-item" href="agregar_combustible.php">Cargas de Combustible</a>
          <!--con este codigo se crea el submenu--> 
           <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">
            Checklist
           </a>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="checklist.php">Checklist Resguardo</a> </li>
          <li><a class="dropdown-item" href="checklist_revision.php">Checklist Revisión</a></li> 
           <li><a class="dropdown-item" href="checklist_mtto.php">Checklist Mantenimiento</a></li> 
            </ul>
          </li>
          <!--con este codigo se crea el submenu-->               
          <div class="dropdown-divider"></div>          
          <!--con este codigo se crea el submenu--> 
           <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">
             Reportes
           </a>
              <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="reporte_factura.php">Reportes por Factura</a></li>
              <li><a class="dropdown-item" href="reporte_fecha.php">Reportes por Fecha</a></li>
              <li><a class="dropdown-item" href="reporte_comparativo.php">Reportes de comparativo</a></li>
               </ul>
          </li>
          <!--con este codigo se crea el submenu-->
          <a class="dropdown-item" href="recordatorios.php">Recordatorios</a>          
                             
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-wrench"></i> 
          Servicios
        </a>
        <!--se cambiara este div por un ul para que funcione el submenu-->     
        <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <!--se cambiara este div por un ul para que funcione el submenu-->    
          <a class="dropdown-item" href="registrar_servicios.php">Cátalogo de Servicios</a>
          <a class="dropdown-item" href="incidentes.php">Reporte de Incidentes</a>
          <a class="dropdown-item" href="reg_mantenimiento.php">Aplicar Mantenimiento</a>       
          <div class="dropdown-divider"></div>                  
          <!--con este codigo se crea el submenu--> 
           <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">
           Alertas
           </a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="notificaciones.php">Alertas Mtto Pendientes</a></li>
        <li><a class="dropdown-item" href="alertas_incidentes.php">Alertas de Incidentes</a></li>
        <li><a class="dropdown-item" href="alertas_mtto_ven.php">Alertas Vencimiento de Mtto</a></li>
        <li><a class="dropdown-item" href="alertas_porcentaje_km.php">Alertas por Factor</a></li>
        </ul>
          </li>
          <!--con este codigo se crea el submenu-->
          <div class="dropdown-divider"></div>  
          <a class="dropdown-item" href="tabla_historial_incidentes.php">Historial de Incidentes</a>
          <a class="dropdown-item" href="tabla_historial_mantenimientos.php">Historial de Mantenimientos</a>  
          <a class="dropdown-item" href="orden_servicio_externa.php">Orden de Servicio Externa</a>  
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">       
        <i class="fa fa-align-justify"></i> 
          Almacen
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registrar_llantas.php">Registrar Neumáticos</a>
          <a class="dropdown-item" href="registrar_listadopartes.php">Listado de Partes</a>
          <a class="dropdown-item" href="registrar_aditivos.php">Aditivos</a>
          <a class="dropdown-item" href="alertas_balatas.php">Alerta de Balatas</a>
              <div class="dropdown-divider"></div>  
          <a class="dropdown-item" href="registrar_accidentes.php">Accidentes</a>
          <a class="dropdown-item" href="registrar_seguros.php">Seguros</a>               
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-drivers-license"></i>   
          Conductores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_conductores.php">Registrar Conductores</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="historial_asignaciones.php">Historial de Asignaciones</a>
          
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-building"></i>  
          Proveedores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_proveedor.php">Registrar Proveedor</a>
          <div class="dropdown-divider"></div>  
          <a class="dropdown-item" href="modificar_proveedor.php">Modificar Proveedor</a>                  
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-group"></i> 
          Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="modificar_usuario.php">Consultar</a>                  
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-life-ring"></i>   
          Soporte
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="solicitud_soporte.php">Enviar Solicitud</a>         
        </div>
      </li>     
    </ul> 
 
 <button type="button" onClick="history.back()" class="btn btn-outline-success my-2 my-sm-0 bot4">
    Regresar
  </button>

  <button type="button" onclick="location.href='close.php'" class="btn btn-outline-success my-2 my-sm-0">
    Cerrar Sesion    
  </button>

</div>
</nav>

<!--se utilizo para crear el submenu-->
<script type="text/javascript">
  $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');

  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });
  return false;
});
</script>
<!--se utilizo para crear el submenu-->
</body>
</html>