<?php

require_once "conexao.php";

$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$conn = new Conexao();

$sql = "INSERT INTO usuario(nome,sobrenome,email,senha, tipousuario) VALUES (:nome,:sobrenome,:email,:senha, 'USR')";
$stmt = $conn->conexao->prepare($sql);

$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":sobrenome", $sobrenome);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":senha", $senha);

$res = $stmt->execute();
if ($res) {
    
    echo json_encode(array('success' => true, 'message' => 'Success', ));
}

