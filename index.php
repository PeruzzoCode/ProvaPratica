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
                $robos[] = (array)$robo;
                $_SESSION ["operador"] = $operador;
                $mensagem = "Robô cadastrado!";
            }
            else {
                $mensagem = "Preencha todos os campos!";
            }
        }
        if (isset($_POST["recarregar"])) {
            $id = filter_var($_POST["recarregar"], FILTER_VALIDATE_INT);
            if ($id !== false && isset($robos[$id])) {
                $r = $robos[$id];
                $robo = new Robo ($r["nome"], $r["modelo"], $r["energia"], $r["potencia"]);
                $robo->recarregar();
                $robos[$id] = (array)$robo;
                $_SESSION("recargas")++;
                $mensagem = "Recarga realizada!";
            }
        }
    }
}
?>