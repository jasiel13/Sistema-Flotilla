<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login</title>	
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">   
</head>
<body class="bg-image">
<div class="container">
 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

	<div class="input-group">
		<i class="fa fa-user-o icons" aria-hidden="false"></i>
		<input type="text" name="usuario" placeholder="Usuario" class="form-control" required>
	</div>

	<div class="input-group">
	  <i class="fa fa-lock icons" aria-hidden="false"></i>
	<input type="password" name="password" placeholder="Contraseña" class="form-control" required>
	</div>

	<ul>
        <?php if (!empty($errores)): ?>
          <?php echo $errores ?>
        <?php endif; ?>
      </ul>
<div class="input-group">
<button type="submit" name="submit" class="btn btn-flat-green">Ingresar</button>   
</div>
<div class="input-group">
<button type="button" class="btn btn-dark hvr-float" onclick="location.href='index.html'">
 Inicio</button>
 </div> 
    <!--<a href="<?php //echo RUTA.'registro.php' ?>" class="login-link">¿No tienes cuenta?</a>-->
</form>
</div>

<div class="input-group">
<div class="textologin">
<h1 id="titulologin" class="wow bounceInDown">Una Solucion Fluida Para Tu Proyecto</h1>
</div>
</div>
</body>
</html>