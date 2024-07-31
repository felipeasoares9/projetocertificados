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
<title>Certificados</title>

</head>

<?php include "menu.php" ?>

<?php 
    $usuarios = buscarCertificado2($connect);
?>
<body>
<main>
    <div>
        <h2>Consultar certificado</h2><br>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="submit" name="consultar" value="Consultar">
        </form>
        <?php if (isset($_POST["email"])){ ?>
        <br>
        <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>   
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php 
                    $tabela = "evento";
                    $where = "id =" . $usuario['inscricao'];
                    $eventos = buscar($connect, $tabela, $where);
                    foreach ($eventos as $evento) :
                        echo $evento['nome'];
                    endforeach; ?></td>
                    <td><a href="pdf.php?id=<?php echo $usuario['id']; ?>&idpalestra=<?php echo $usuario['inscricao']; ?>">Gerar Certificado</a></td>
                </tr>
                <?php endforeach;?>
                <?php 
                    
                ?>
            </tbody>
        </table>
        <?php } ?>
        <br>
    </div>
</main>

</body>
<footer>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.026951888163!2d-51.22981732444652!3d-30.03608462492779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95197906a9d397f5%3A0x514b4935e97fbf4d!2sUniSenac%20-%20Campus%20Porto%20Alegre%20I!5e0!3m2!1spt-BR!2sbr!4v1721177039742!5m2!1spt-BR!2sbr" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</html>
