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

function e($valor){
    return htmlspecialchars((string)$valor, ENT_QUOTES, "UTF-8");
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        if(isset($_POST["cadastrar"])) {
            $nome = trim($_POST["nome"] ?? "");
            $modelo = $_POST["modelo"] ?? "";
            $operador = trim($_POST["operador"] ?? "");

            if ($nome && $operador && isset($tipos[$modelo])) {
                $robo = new Robo($nome, $modelo, ...$tipos[$modelo]);
                $_SESSION ["operador"] = $operador
            }
        }
    }
}
?>