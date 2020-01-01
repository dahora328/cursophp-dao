<?php
require_once("Config.php");
$usuario = new Usuario();
$usuario->LoadById(1);
echo $usuario;
?>