<?php
    session_start();
    $seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: login.php");
    require_once "server.php";
?>

<?php 
    $nome = $_SESSION['nome'];
    $users = buscarAdmin($connect, $nome);

    if (isset($users) AND $users != null){
    } else {
        header("location: painelAdministrativo.php?admin=FALSE");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Gerenciar Usuários</title>
</head>
<?php include "menu.php" ?>
<body>
    <main>
        <div>
            <?php 
                $tabela = "usuarios";
                $usuarios = buscar($connect, $tabela);
                inserirUsuarios($connect);
                //deletar($connect, $tabela, $id);
                if (isset($_GET['id'])){ ?>
                    <h3>Tem certeza que deseja deletar o usuário: "<?php echo $_GET['nome']; ?>"?</h3>
                    <form action="cadastrarUsuario.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"><br>
                        <input type="submit" name="deletar" value="Deletar"><br>
                    </form>
            <?php } ?>
    <?php
        if(isset($_POST['deletar'])){
            if( $_SESSION['id'] != $_POST['id']){
                deletar($connect, "usuarios", $_POST['id']);
            } else {
                echo "Operação inválida!";
            }
            
        }
        
    ?>
        <h3>Bem-vindo, <?php echo $_SESSION['nome'] . "!"; ?></h3>
        <br>
        <?php include "navadm.php" ?>
        <br><br>
        <h2>Gerenciar Usuários</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Admin</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <div>
                    <form action="./cadastrarUsuario.php" method="POST">
                        <legend>Cadastro de Usuário</legend>
                        <input type="text" id="nome" name="nome" placeholder="Nome" required>
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
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php 
                                if ($usuario['admin'] == 1){
                                    echo "Sim";
                                } else {
                                    echo "Não";
                                }?></td>
                            <td><a href="cadastrarUsuario.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo $usuario['nome']; ?>">Excluir</a>
                            |
                            <a href="editarUsuario.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo $usuario['nome']; ?>">Atualizar</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<footer>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.026951888163!2d-51.22981732444652!3d-30.03608462492779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95197906a9d397f5%3A0x514b4935e97fbf4d!2sUniSenac%20-%20Campus%20Porto%20Alegre%20I!5e0!3m2!1spt-BR!2sbr!4v1721177039742!5m2!1spt-BR!2sbr" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</html>