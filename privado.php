<?php
    if(!isset($_SESSION)){
        session_start();

    }

    if(!isset($_SESSION["id"])){
        die("Você não tem acesso à esta página. <p><a href=\"login.html\">Logar</a></p>");
    }
?>