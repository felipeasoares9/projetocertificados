<?php

require_once "server.php";
if (isset($_GET['nome'])){
    $tabela = "inscritos";
    $usuarios = buscar($connect, $tabela);
    foreach ($usuarios as $usuario) :
        echo $usuario['nome'];
    endforeach;
}