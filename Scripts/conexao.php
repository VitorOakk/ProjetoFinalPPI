<?php

class Conexao{
    public $conexao;

    function __construct(){
        if(!isset($this->conexao)){
            try{
                $this->conexao = new PDO("mysql:host=localhost;dbname=bd_greenchat;port=3307", 'root', '');
            }
            catch(PDOException $e){
                echo 'Error: '. $e->getMessage();
            }
    }
}

    function fecharConexao(){
        if(isset($this->conexao)){
            $this->conexao = null;
        }
    }

}