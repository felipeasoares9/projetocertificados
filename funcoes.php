<?php
    include("./server.php");

    function buscaUnica($connect, $tabela, $id){
        $query = "SELECT * FROM $tabela WHERE id =". (int) $id;
        $execute = mysqli_query($connect, $query);
        $result = mysqli_fetch_assoc($execute);
        return $result;
    }
    
    function buscar($connect, $tabela, $where = 1, $order = ""){
        if (!empty($order)){
            $order - "ORDER BY $order";
        }
        $query = "SELECT * FROM $tabela WHERE $where $order";
        $execute = mysqli_query($connect, $query);
        $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        return $results;
    }
    
    function inserirUsuarios($connect){
        if ((isset($_POST['cadastrar']) AND !empty($_POST['email']) AND !empty($_POST['senha']))){
            $erros = array();
            $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
            $nome = mysqli_real_escape_string($connect, $_POST['nome']);
            $senha = $_POST['senha'];
            if($_POST['senha'] != $_POST['repeteSenha'])
            $erro[] = "Senhas não conferem!";
        }
        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email'";
        $buscaEmail = mysqli_query($connect, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);
        if (!empty($verifica)){
            $erro[] = "E-mail já cadastrado!";
        }

        if(empty($erros)){
            $query = "INSERT INTO usuarios (nome, senha, email) VALUES ('$nome', '$senha','$email')";
            $executar = mysqli_query($connect, $query);
            if ($executar){
                echo "Usuário inserido com sucesso!";
            } else {
                echo "Erro ao inserir usuário!";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }

