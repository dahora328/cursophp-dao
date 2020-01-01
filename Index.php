<?php
require_once("Config.php");
$usuario = new Usuario();
$usuario->LoadById(1);
$lista = Usuario::getList();
$busca = Usuario::BusacarLogin("jo");
$usuario->login("dahora","123456");
//echo json_encode($busca);
echo $usuario;
?>