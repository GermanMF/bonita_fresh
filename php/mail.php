<?php 
include("conexion2.php");
$name = $_POST['Cname'];
$from="gmartinezfragoso@gmail.com";
$email = $_POST['email'];
$comm = $_POST['comments'];
$asunto = "Mail desde la página de Bonita Fresh";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: ".$email." "."\r\n";

if(!isset($_POST['zip'])){
	$zip = $_POST['zip'];
	$bandera = 1;
}

if(isset($_POST['tel'])){
	$tel = $_POST['tel'];
}
else{
	$tel = "Sin teléfono registrado";
}
if($_POST['pais'] != "no")
{
	if($_POST['pais'] == "mexico")
	{
		$pais ="México";
		$estado = $conex -> query("select nombre from estados where id='".$_POST['estado']."'") -> fetch_assoc();
		$ciudad = $conex -> query("select nombre from municipios where id='".$_POST['ciudad']."'") -> fetch_assoc();
	}
	else if($_POST['pais'] == "us"){
		$pais = "Estados Unidos de América";
		$estado = $conex -> query("select state as nombre from states where state_code='".$_POST['estado']."'") -> fetch_assoc();
		$ciudad = $conex -> query("select city as nombre from cities where id='".$_POST['ciudad']."'") -> fetch_assoc();
	}

}

if(!isset($bandera)){
	$message = "
	<html>
	<head>
		<title>Email</title>
	</head>
	<body>
		<section style='padding-right: 15%; padding-left: 15%; padding-top: 2%;'>
			<div style='padding-right: 10%; padding-left: 10%; text-align: center;'>
				<div><img src='http://bonita.magicpets.site11.com/img/bonita.png' style='width: 30%; padding-bottom: 10%; padding-top: 10%; text-align: center;'></div>
				<div style='text-align: justify; padding-right: 20%; padding-left: 20%;'><p>Buen día.</p><p><b>".$name."</b> le escribe con el correo capturado: ".$email." y teléfono ".$tel." desde ".$pais.", ".$estado['nombre'].", ".$ciudad['nombre']." con un código postal ".$zip.", sus comentarios son los siguientes:</p></div>
				<div style='text-align: justify; padding-right: 20%; padding-left: 20%;'>
					<p>".$comm."</p>
				</div>
			</div>
		</section>
		<footer style='margin-top:20px; padding-top:20px; background-color: #ee6e73'>
			<div style='font-weight: 300;overflow: hidden;
			height: 50px;
			line-height: 50px;
			color: rgba(255,255,255,0.8);
			background-color: rgba(51,51,51,0.08);'>
			<div style='text-align: left; color:white; line-height: 50px; width:70%; margin: 0 auto;'>
				Powered by<a style='color:#fff; text-decoration: none;' href='https://www.facebook.com/german.martinezfragoso'> Germán Martínez Fragoso 
			</div>
		</div>
	</footer>
</body>
</html>
";
}
else{
	$message = "
	<html>
	<head>
		<title>Email</title>
	</head>
	<body>
		<section style='padding-right: 15%; padding-left: 15%; padding-top: 2%;'>
			<div style='padding-right: 10%; padding-left: 10%; text-align: center;'>
				<div><img src='http://bonita.magicpets.site11.com/img/bonita.png' style='width: 30%; padding-bottom: 10%; padding-top: 10%; text-align: center;'></div>
				<div style='text-align: justify; padding-right: 20%; padding-left: 20%;'><p>Buen día.</p><p><b>".$name."</b> le escribe con el correo capturado: ".$email." y teléfono ".$tel." sus comentarios son los siguientes:</p></div>
				<div style='text-align: justify; padding-right: 20%; padding-left: 20%;'>
					<p>".$comm."</p>
				</div>
			</div>
		</section>
		<footer style='margin-top:20px; padding-top:20px; background-color: #ee6e73'>
			<div style='font-weight: 300;overflow: hidden;
			height: 50px;
			line-height: 50px;
			color: rgba(255,255,255,0.8);
			background-color: rgba(51,51,51,0.08);'>
			<div style='text-align: left; color:white; line-height: 50px; width:70%; margin: 0 auto;'>
				Powered by<a style='color:#fff; text-decoration: none;' href='https://www.facebook.com/german.martinezfragoso'> Germán Martínez Fragoso 
			</div>
		</div>
	</footer>
</body>
</html>
";
}
$message = str_replace("\n.", "\n..", $message);
$result = mail($from,$asunto,$message,$headers);
?>