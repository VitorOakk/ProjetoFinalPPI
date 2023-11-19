<?php

require_once "conexao.php";

$conn = new Conexao;

$sql = "SELECT * FROM publicacoes";
$stmtPublicacoes = $conn->conexao->prepare($sql);

$resPublicacoes = $stmtPublicacoes->execute();

if ($resPublicacoes) {
    while ($rowPublicacoes = $stmtPublicacoes->fetch(PDO::FETCH_OBJ)) {

        $sqlUsuario = "SELECT nome, sobrenome, biografia FROM usuario WHERE id = :id";
        $stmtUsuario = $conn->conexao->prepare($sqlUsuario);
        $stmtUsuario->bindValue(":id", $rowPublicacoes->UsuarioID);

        if ($stmtUsuario->execute()) {
            while ($rowUsuario = $stmtUsuario->fetch(PDO::FETCH_OBJ)) {
                $response = array(
                    "IDPublicacao" => $rowPublicacoes->ID,
                    "conteudo" => $rowPublicacoes->Conteudo,
                    "IDUsuario" => $rowPublicacoes->UsuarioID,
                    "nome" => $rowUsuario->nome,
                    "sobrenome" => $rowUsuario->sobrenome,
                    "biografia" => $rowUsuario->biografia
                );

                // Faça algo com $response, como imprimir ou armazenar em um array
                $publicacoes[] = $response;
            }
        }
    }
}
echo json_encode($publicacoes);