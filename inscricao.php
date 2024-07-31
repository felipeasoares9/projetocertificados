<?php
    session_start();
    require_once "server.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Inscrição</title>
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
            
            if (isset($_GET['id'])){
                $tabela = 'evento';
                $where = "id=" . $_GET['id'];
                $informacoes = buscar($connect, $tabela, $where);
                foreach ($informacoes as $informacao) : ?>
                    <h2>Informações do evento: <?php echo $informacao['nome']; ?></h2>
                    <h3>Palestrante: <?php echo $informacao['palestrante']; ?></h3>
                    <h3>Data: <?php echo $informacao['data']; ?></h3>
                    <h3>Duração do curso: 
                        <?php if ($informacao['horas'] < 10){
                            echo "0" . $informacao['horas'];
                        } else {
                            echo $informacao['horas']; 
                        }?> horas</h3>
                        <h3>Descrição do evento: <?php echo $informacao['descricao']?></h3>
                <?php endforeach; 
                $id = $_GET['id'];
                inserirInscritos($connect);
            }
            ?>
            <div>
                <form action="" method="POST">
                    <input type="text" id="nome" name="nome" placeholder="Nome Completo" required>
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                    <input type="number" id="telefone" name="telefone" placeholder="Telefone"
                    >
                    <input value="<?php echo $id; ?>" type="hidden" id="inscricao" name="inscricao" placeholder="id palestra"
                    required>
                    <input type="submit" name="cadastrar" value="Cadastrar">

                </form>
            </div>


    </main>
</body>
<footer>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.026951888163!2d-51.22981732444652!3d-30.03608462492779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95197906a9d397f5%3A0x514b4935e97fbf4d!2sUniSenac%20-%20Campus%20Porto%20Alegre%20I!5e0!3m2!1spt-BR!2sbr!4v1721177039742!5m2!1spt-BR!2sbr" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</html>