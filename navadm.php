<?php 
    $nome = $_SESSION['nome'];
    $users = buscarAdmin($connect, $nome);

    if (isset($users) AND $users != null){ ?>
        <a href="cadastrarUsuario.php">Gerenciar Usuários</a>
    <?php } else {
        //header("location: painelAdministrativo.php?admin=FALSE");
    }?>
    <a href="cadastrarEvento.php">Gerenciar Eventos</a>
    <?php 
        if (isset($_GET['admin']) AND $_GET['admin'] == "FALSE"){
            echo "Você não tem privilégios para gerenciar usuários.";
        }