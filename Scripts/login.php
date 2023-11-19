<?php
session_start();
require_once "conexao.php";
require_once "usuarioEntidade.php";
$email = $_POST["email"];
$senha = $_POST["senha"];
$conn = new Conexao();

$sql = "SELECT * FROM `usuario` WHERE Email = :email and Senha = :senha";

$stmt = $conn->conexao->prepare($sql);
$stmt->bindValue(':email',$email);
$stmt->bindValue(':senha',$senha);

$result = $stmt->execute();

if($stmt->rowCount() == 1){
    $usuario = new usuarioEntidade();

    while($row = $stmt->fetch(PDO::FETCH_OBJ)){
        $usuario->setEmail($row->Email);
        $usuario->setNome($row->Nome);
        $usuario->setSobrenome($row->Sobrenome);
        $usuario->setBio($row->Biografia);
        $usuario->setTipo($row->TipoUsuario);
        $_SESSION["nome"] = $usuario->getNome();
        $_SESSION["sobrenome"] = $usuario->getSobrenome();
        $_SESSION["bio"] = $usuario->getBio();
        $_SESSION["ID"] = $row->ID;
    }
    echo json_encode(array('success' => true,
                            'message' => 'Usuario encontrado' ,
                            'email' => $usuario->getEmail(),
                            'nome' => $usuario->getNome(),
                            'sobrenome' => $usuario->getSobrenome(),
                            'bio' => $usuario->getBio(),
                            'tipo' => $usuario->getTipo()));
    
}else{
    echo json_encode(array('success' => false, 'message' => 'Usuario não encontrado'));
}