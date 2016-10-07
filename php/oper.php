<?php

switch ($_GET['case']) {
	case 1:
	estado();
	break;
	case 2:
	ciudad();
	break;
	default:
	break;
}


function ciudad(){
	include("conexion2.php");
	$quer = '<option value="0"> Seleccione una ciudad</option>';
	if($_POST['pais'] == "mexico"){
		$res = $conex -> query("select id, nombre from municipios where estado_id=".$_POST['id']);
	}
	else if($_POST['pais'] == "us"){
		$res = $conex -> query("select id, city as nombre from cities where state_code='".$_POST['id']."'");
	}
	else{$res = "nada";}
	while($aux = $res -> fetch_assoc()){
		$quer .= '<option value="'.$aux['id'].'">'.utf8_encode($aux['nombre']).'</option>';
	}
	echo $quer;
}


function estado(){
	include("conexion2.php");
	$quer = '<option value="0"> Seleccione un estado</option>';
	if($_POST['id']=="mexico"){
		$res = $conex -> query("select nombre,id from estados order by nombre");
	}
	else if($_POST['id']=="us"){
		$res = $conex -> query("select state as nombre,state_code as id from states order by nombre");
	}
	else{$res = "nada";}

	while($aux = $res -> fetch_assoc()){
		$quer .= '<option value="'.$aux['id'].'">'.utf8_encode($aux['nombre']).'</option>';
	}
	echo $quer;
}
?>