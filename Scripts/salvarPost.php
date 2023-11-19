<?php

require_once "conexao.php";

$userID = $_POST['usuarioID'];
$content = $_POST['content'];

$conn = new Conexao();
$sql = "INSERT INTO publicacoes(Conteudo, UsuarioID) VALUES (:conteudo, :usuarioID)";
$stmt = $conn->conexao->prepare($sql);
$stmt->bindValue(":conteudo", $content);
$stmt->bindValue(":usuarioID", $userID);
if($stmt->execute()){
    echo "Mensagem enviada com sucesso";
}else{
    echo "Falha ao enviar mensagem";
}