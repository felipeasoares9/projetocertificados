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

    <title>Gerenciar eventos</title>
</head>
<?php include "menu.php" ?>
<body>
    <main>
        <div>
        <h3>Bem-vindo, <?php echo $_SESSION['nome'] . "!"; ?></h3>
        <br>
        <?php include "navadm.php" ?>
        <br><br>
        <h2>Cadastro de Evento</h2>
            <?php 
            if (isset($_POST['deletar'])){
                deletar($connect, "evento", $_POST['id']);
                } 
            ?>
        <br>
        <?php
            $tabela = "evento";
            $eventos = buscar($connect, $tabela);
        ?>
        <form action="./cadastrarEvento.php" method="POST">
            <label for="nome_evento">Nome do Evento:</label>
            <input type="text" id="nome_evento" name="nome_evento" required>

            <label for="nome_palestrante">Nome do Palestrante:</label>
            <input type="text" id="nome_palestrante" name="nome_palestrante" required>

            <label for="data_evento">Data:</label>
            <input type="date" id="data_evento" name="data_evento" required>

            <label for="duração">Horas</label>
            <input type="number" id="horas_evento" name="horas_evento" required>

            <br><label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea>

            <input type="submit" name="cadastrar" value="Cadastrar">
        </form>
        <div>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do evento</th>
                        <th>Nome do Palestrante</th>
                        <th>Data</th>
                        <th>Duração do curso (horas)</th>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento) : ?>
                        <tr>
                            <td><?php echo $evento['id']; ?></td>
                            <td><?php echo $evento['nome']; ?></td>
                            <td><?php echo $evento['palestrante']; ?></td>
                            <td><?php echo $evento['data']; ?></td>
                            <td><?php if ($evento['horas'] < 10){
                                echo "0" . $evento['horas']; 
                                    } else {
                                        echo $evento['horas'];
                                }?></td>
                            <td>
                                <a href="cadastrarEvento.php?id=<?php echo $evento['id']; ?>&nome=<?php echo $evento['nome']; ?>">Excluir</a>
                                |
                                <a href="qrcode.php?id=<?php echo $evento['id']; ?>">Gerar QrCode</a>
                                |
                                <a href="gerenciarEvento.php?id=<?php echo $evento['id'];?>">Gerenciar evento</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
                $tabela = "evento";
                inserirEventos($connect);
                if (isset($_GET['id'])){ ?>
                    <br>
                    <h3>Tem certeza que deseja deletar o evento: "<?php echo $_GET['nome']; ?>"?</h3>
                    <form action="cadastrarEvento.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']?>"><br>
                        <input type="submit" name="deletar" value="Deletar">
                    </form>
            <?php } ?>
        </div>
    </main>
</body>
<footer>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.026951888163!2d-51.22981732444652!3d-30.03608462492779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95197906a9d397f5%3A0x514b4935e97fbf4d!2sUniSenac%20-%20Campus%20Porto%20Alegre%20I!5e0!3m2!1spt-BR!2sbr!4v1721177039742!5m2!1spt-BR!2sbr" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</html>