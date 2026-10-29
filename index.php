<?php 

session_start();
require "Robo.php";

$arquivo = "robos.json";
$tobos = json_decode(file_get_contents($arquivo), true) ?? [];
$_SESSION["recargas"] ??=0;
$mensagem = "";

$tipos = [
    "Explorador" => [100, 20],
    "Engenheiro" => [120, 15],
    "Defensor" => [150, 30]
];

?>