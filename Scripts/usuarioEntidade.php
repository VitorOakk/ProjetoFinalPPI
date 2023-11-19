<?php

class usuarioEntidade{
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $bio;
    private $tipo;
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getSobrenome(){
        return $this->sobrenome;
    }
    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getBio(){
        return $this->bio;
    }
    public function setBio($bio){
        $this->bio = $bio;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}