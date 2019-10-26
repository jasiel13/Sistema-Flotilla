<?php
$vehiculo=$_POST['vehiculo'];
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="SELECT  SUM(odometro) AS totalkilometros, vehiculo FROM carga_combustible WHERE vehiculo ='$vehiculo'";
$result=mysqli_query($con, $query) or die (mysqli_error());

$total=0;
 while ($row=mysqli_fetch_array($result)){
 $totalkm=$total+$row[0];
 $auto=$row['vehiculo'];
}

if($totalkm>=5 and $totalkm<=10){

	echo"<script type='text/javascript'>
		Push.create('ALERTA DE MANTENIMIENTO NIVEL MEDIO',{
	body:'Usted tiene un mantenimiento del Vehículo: $auto, pendiente!!! con un Kilometraje de $totalkm km',
			icon:'img/alerta_media.png',
			requireInteraction:true,
			//timeout:4000,
			onClick: function(){
				window.location='reg_mantenimiento.php';
				this.close();
			}
		});
	</script>";
}
elseif ($totalkm>=10){
	echo"<script type='text/javascript'>
		Push.create('ALERTA DE MANTENIMIENTO NIVEL ALTO',{
	body:'Usted tiene un mantenimiento del Vehículo: $auto, pendiente!!! con un Kilometraje de $totalkm km',
			icon:'img/alerta_alta.png',
			requireInteraction:true,
			//timeout:4000,
			onClick: function(){
				window.location='reg_mantenimiento.php';
				this.close();
			}
		});
	</script>";
}
else{
	echo "<script type='text/javascript'>
		Push.create('ALERTA DE MANTENIMIENTO',{
			body:'Aun no hay mantenimiento de vehículo!!!',
			icon:'img/alerta_baja.png',
			requireInteraction:true,
			//timeout:4000,			
			onClick: function(){
				window.location='reg_mantenimiento.php';
				this.close();
			}
		});
	</script>";

 }
mysqli_close($con);
?>