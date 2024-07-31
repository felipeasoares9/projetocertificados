<?php
    require_once('server.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">

<title>Login</title>

</head>

<?php include "menu.php" ?>

<body>
<main>
    <div>
        <form action="login.php" method="POST"> 
                <h2>Login</h2>
                <br>
                <label for="email">E-mail:</label><br>
                <input type="text" id="email" name="email" required><br><br>

                <label for="senha">Senha:</label><br>
                <input type="password" id="senha" name="senha" required><br><br>

                <input type="submit" name="acessar" value="Acessar"><br><br>
                <?php 
                    if (isset($_POST['acessar'])){
                        login($connect);
                    }
                ?>
        </form>
    </div>
</main>
</body>
<footer>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.026951888163!2d-51.22981732444652!3d-30.03608462492779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95197906a9d397f5%3A0x514b4935e97fbf4d!2sUniSenac%20-%20Campus%20Porto%20Alegre%20I!5e0!3m2!1spt-BR!2sbr!4v1721177039742!5m2!1spt-BR!2sbr" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</html>
