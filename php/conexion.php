<?php
$server = "mysql13.000webhost.com";
$user = "a4640530_bd";
$pass = "123321qwerty";
$bd = "a4640530_bd";

$conex = new mysqli($server,$user,$pass,$bd);
// if($conex -> errno) echo'No se pudo realizar la conexion';
$conex -> set_charset("utf-8");

?>