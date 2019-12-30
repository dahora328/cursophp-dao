<?php
require_once("Config.php");

$sql = new SQL();

$usuarios = $sql->Select("SELECT * FROM usuario");
echo json_encode($usuarios);
?>