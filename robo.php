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

    function recarregar(){
        $this->energia = min(200, $this->energia + 10);
    }

}

?>

