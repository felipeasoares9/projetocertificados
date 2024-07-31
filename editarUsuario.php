<?php
    session_start();
    $seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: login.php");
    require_once "server.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Cadastrar Usuário</title>
</head>

<?php include "menu.php" ?>
<body>
    <main>
        <div>
            <h3>Bem-vindo, <?php echo $_SESSION['nome'] . "!"; ?></h3>
            <br>
            <?php include "navadm.php"?>
            <br><br>
            <?php 
                $tabela = "usuarios";
                $usuarios = buscar($connect, $tabela);
            ?>

            <?php 
                if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $tabela = "usuarios";
                    $usuario = buscaUnica($connect, $tabela, $id);
                    echo $usuario;
            ?>
                <h2>Editando o usuário: <?php echo $_GET['nome']; ?></h2>
                <br>
            <?php } ?>

            <form action="" method="POST">
                <legend>Editar Usuário</legend>
                <input value="<?php echo $usuario['nome']; ?>" type="text" id="nome" name="nome" placeholder="Nome" required>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
                <input type="password" id="repeteSenha" name="repeteSenha" placeholder="Confirme sua senha"required>
                <label for="admin">Administrador:</label>
                <select id="admin" name="admin" required>
                <option value="0">Não</option>
                <option value="1">Sim</option>
                </select>
                <input type="submit" name="cadastrar" value="Cadastrar">
            </form> 
        </div>       
    </main>
</body>
<footer>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.026951888163!2d-51.22981732444652!3d-30.03608462492779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95197906a9d397f5%3A0x514b4935e97fbf4d!2sUniSenac%20-%20Campus%20Porto%20Alegre%20I!5e0!3m2!1spt-BR!2sbr!4v1721177039742!5m2!1spt-BR!2sbr" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</html>