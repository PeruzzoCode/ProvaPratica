<?php 

class Robo{

    public $nome, $modelo, $energia, $potencia;

    function __construct($nome, $modelo, $energia, $potencia)
    {
        $this -> nome = $nome;
        $this -> modelo = $modelo;
        $this -> energia = $energia;
        $this -> potencia = $potencia;
    }

    function exibirStatus(){
        return "Energia: $this->energia | Potência: $this->potencia";
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastrar.css">

    <title>Document</title>
</head>
<body>
    <div class="tiposrobos">

    <h1>TIPOS DE ROBÔS</h1>
    
    <div class="modelo">
    <h2>MODELOS</h2>
        <p>Explorador</p>
        <p>Engenheiro</p>
        <p>defensor</p>
    </div>
    
    <div class="energia">
        <p>100</p>
        <p>120</p>
        <p>150</p>
    </div>

    <div class="potencia">
        <p>20</p>
        <p>15</p>
        <p>30</p>
    </div>

    <div class="funcao">
        <p>Investigar planetas</p>
        <p>Reparar equipamentos</p>
        <p>Proteger a estação</p>
    </div>

    </div>
    
    <input type="text" id="operador" name="operador">
    <input type="text" id="robo" name="robo">
    <input type="text" id="modelo" name="modelo">

</body>
</html>