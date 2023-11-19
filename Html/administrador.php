<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../Css/bootstrap.min.css">
    <script src="../Scripts/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
    <header>
    <nav class="navbar bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">GreenChat</a>
    <form action="" method ="post"><input type="submit" value="Sair" name="sair" class="btn btn-success px-3 mx-5"></form>
  </div>
</nav>
    </header>
    <main class="d-flex container c-10 flex-column my-4">
        <h1 class="mx-6">Ola, <?php echo $_SESSION['nome']; ?>!</h1>
        <?php
            if(isset($_POST["sair"])){
        
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit();
            }
        ?>
        
        <table id="table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Action</th>
        
        
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "../Scripts/conexao.php";
                    $conn = new Conexao();
                    $sql = "SELECT * FROM usuario";
                    $stmt = $conn->conexao->prepare($sql);
        
                    if($stmt->execute()){
                        while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                            echo "<tr>
                                        <td>$rs->ID</td>
                                        <td>$rs->Nome</td>
                                        <td>
                                            <form method = 'POST'>
                                                <input type='hidden' name='remover' value='$rs->ID'>
                                                <input type='submit' value='Remover' class='btn btn-success' >
                                            </form>
                                        </td>
                                    </tr>";
                        }
                    }else{
                        echo "Erro na recuperação de dados";
                    }
        
                    if(isset($_POST['remover'])) {
                        // Obtém o ID do usuário a ser removido
                        $remove_id = $_POST['remover'];
        
                        // Prepara e executa a consulta de exclusão
                        $sql_delete = "DELETE FROM usuario WHERE ID = ?";
                        $stmt_delete = $conn->conexao->prepare($sql_delete);
                        $stmt_delete->bindParam(1, $remove_id);
        
                        if($stmt_delete->execute()) {
                            
                            echo "Usuário removido com sucesso!";
                        } else {
                            echo "Erro ao remover usuário.";
                        }
                    }
                ?>
        
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Action</th>
                </tr>
        
            </tfoot>
        
        </table>
        <div class="d-flex flex-column form">
            <h1>Cadastrar Novo Administrador</h1>
                <form action="" class="" method="post" class="">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                    <div class="mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" name="sobrenome" id="sobrenome">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password " class="form-control" name="senha" id="senha">
                    </div>
            
                    <input type="submit" value="Cadastrar" name="cadastrar" class="btn btn-success">
                </form>
        </div>
            <?php
                if(isset($_POST["cadastrar"])){
                    require_once "../Scripts/conexao.php";
                    

                    $nome = $_POST["nome"];
                    $sobrenome = $_POST["sobrenome"];
                    $email = $_POST["email"];
                    $senha = $_POST["senha"];
                    $tipo = "ADM";

                    $conn = new Conexao();
                    $sql = "INSERT INTO usuario(Nome, Sobrenome,Email, Senha, TipoUsuario ) VALUES (:nome, :sobrenome, :email,:senha,:tipo)";

                    $stmt = $conn->conexao->prepare($sql);

                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':sobrenome', $sobrenome);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':senha', $senha);
                    $stmt->bindParam(':tipo', $tipo);

                    $result = $stmt->execute();

                    if($result){
                        echo "<h2>Sucesso</h2>";
                    }
                    else echo "<h2>Falha<h2>";

                }

            
            ?>
        <h3>Atualize a tabela para ver as alterações <a href="administrador.php"><input type="button" value="Atualizar" class="btn btn-success"></a></h3>
    </main>
    <script>
        $(document).ready(function() {
            new DataTable("#table");
        } );
    </script>
</body>
</html>