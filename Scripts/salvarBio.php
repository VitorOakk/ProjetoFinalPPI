<?php
require_once "conexao.php";
require_once "usuarioEntidade.php";
session_start();
$bio = $_POST["bio"];
$ID = $_SESSION["ID"];

$conn = new Conexao();  

$sql = "UPDATE usuario SET Biografia = :bio WHERE ID = :id";

$stmt = $conn->conexao->prepare($sql);

$stmt->bindValue(':id',$ID);
$stmt->bindValue(':bio',$bio);

$result = $stmt->execute();

if($result){
    $sql = "SELECT * FROM usuario WHERE ID = :id";
    $stmt = $conn->conexao->prepare($sql);

    $stmt->bindValue(':id',$ID);
    $res = $stmt->execute();
    if($res){
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                    $_SESSION["bio"] = $row->Biografia;
                }
    }
    echo json_encode(array('success' => true, 'bio' => $_SESSION["bio"]));
}