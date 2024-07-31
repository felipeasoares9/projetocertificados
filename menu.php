<nav>
    <div>
        <a href="./index.php">Início</a>
        <a href="./certificados.php">Consultar certificados</a>
        <?php 
            if (isset($_SESSION['ativa'])){ ?>
                <a href="./painelAdministrativo.php">Painel administrativo</a>
            <?php } ?>
        <?php 
            if (isset($_SESSION['ativa'])){ ?>
                <a href="./logout.php">Sair</a>
            <?php } else { ?>
                <a href="./login.php">Login</a>
            <?php } ?>
    </div>
</nav>