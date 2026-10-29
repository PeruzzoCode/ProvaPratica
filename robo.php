
<?php
session_start();
require "Robo.php";

$arquivo = "robos.json";
if (!file_exists($arquivo)) file_put_contents($arquivo, "[]");

$robos = json_decode(file_get_contents($arquivo), true) ?? [];
$_SESSION["recargas"] ??= 0;
$mensagem = "";

$tipos = [
    "Explorador" => [100, 20],
    "Engenheiro" => [120, 15],
    "Defensor" => [150, 30]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cadastrar"])) {
        $nome = trim($_POST["nome"] ?? "");
        $operador = trim($_POST["operador"] ?? "");
        $modelo = $_POST["modelo"] ?? "";

        if ($nome && $operador && isset($tipos[$modelo])) {
            $robo = new Robo($nome, $modelo, ...$tipos[$modelo]);
            $robos[] = (array)$robo;
            $_SESSION["operador"] = $operador;
            $mensagem = "Robô cadastrado!";
        } else {
            $mensagem = "Preencha todos os campos!";
        }
    }

    if (isset($_POST["recarregar"])) {
        $id = (int)$_POST["recarregar"];

        if (isset($robos[$id])) {
            $r = $robos[$id];
            $robo = new Robo($r["nome"], $r["modelo"], $r["energia"], $r["potencia"]);
            $robo->recarregar();
            $robos[$id] = (array)$robo;
            $_SESSION["recargas"]++;
            $mensagem = "Recarga realizada!";
        }
    }

    file_put_contents($arquivo, json_encode($robos, JSON_PRETTY_PRINT));
}

$filtro = $_GET["modelo"] ?? "Todos";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Central de Robôs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Central de Robôs</h1>

<p>Operador: <?= htmlspecialchars($_SESSION["operador"] ?? "Visitante") ?></p>
<p>Recargas: <?= $_SESSION["recargas"] ?></p>
<p><?= $mensagem ?></p>

<section>
    <h2>Cadastrar Robô</h2>
    <form method="POST">
        <input name="nome" placeholder="Nome do robô" required>

        <select name="modelo" required>
            <option value="">Selecione o modelo</option>
            <option>Explorador</option>
            <option>Engenheiro</option>
            <option>Defensor</option>
        </select>

        <input name="operador" placeholder="Operador" required>
        <button name="cadastrar" value="1">Cadastrar</button>
    </form>
</section>

<section>
    <h2>Frota cadastrada</h2>

    <form method="GET">
        <select name="modelo">
            <option>Todos</option>
            <option>Explorador</option>
            <option>Engenheiro</option>
            <option>Defensor</option>
        </select>
        <button>Filtrar</button>
    </form>

    <?php foreach ($robos as $id => $r):
        if ($filtro != "Todos" && $r["modelo"] != $filtro) continue;
        $robo = new Robo($r["nome"], $r["modelo"], $r["energia"], $r["potencia"]);
    ?>
        <div class="robo <?= htmlspecialchars($robo->modelo) ?>">
            <h3><?= htmlspecialchars($robo->nome) ?> - <?= htmlspecialchars($robo->modelo) ?></h3>
            <p><?= htmlspecialchars($robo->exibirStatus()) ?></p>

            <form method="POST">
                <button name="recarregar" value="<?= $id ?>">Recarregar +10</button>
            </form>
        </div>
    <?php endforeach; ?>
</section>

</body>
</html>