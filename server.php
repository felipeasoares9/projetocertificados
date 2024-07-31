<?php

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "certificados";
// Conexão com o DB
$connect = mysqli_connect($host, $db_user, $db_pass, $db_name);

function login($connect){
    if (isset($_POST["acessar"]) AND !empty($_POST['email']) AND !empty($_POST['senha'])) {
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'];
        $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $executar = mysqli_query($connect, $query);
        $return = mysqli_fetch_assoc($executar);
        if (!empty($return["email"])) {
            echo "Bem-vindo, " . $return['nome'] . "!";
            session_start();
            $_SESSION['nome'] = $return['nome'];
            $_SESSION['email'] = $return['email'];
            $_SESSION['id'] = $return['id'];
            $_SESSION['admin'] = $return['admin'];
            $_SESSION['ativa'] = TRUE;
            header("location: painelAdministrativo.php");
        } else {
            echo "Usuário ou senha não encontrado!";
        }
    }
}

function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("location: login.php");
}

/* Seleciona(busca) no BD apenas um resultado com base no ID */
function buscaUnica($connect, $tabela, $id){
    $query = "SELECT * FROM $tabela WHERE id =" . (int) '$id';
    $execute = mysqli_query($connect, $query);
    $result = mysqli_fetch_assoc($execute);
    return $result;
}

/* Seleciona(busca) no BD todos os resultado com base no WHERE */
function buscar($connect, $tabela, $where = 1, $order = ""){
    if (!empty($order)){
        $order = "ORDER BY $order";
    }
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $execute = mysqli_query($connect, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}

/* Inserir novos usuários */
function inserirUsuarios($connect){
    if (isset($_POST["cadastrar"]) AND !empty($_POST['email']) AND !empty($_POST['senha'])) {
        $erros = array();
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $senha = $_POST['senha'];
        $admin = $_POST['admin'];


        if ($_POST['senha'] != $_POST['repeteSenha']){
            $erros[] = "Senhas não conferem!";
        }
        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email'";
        $buscaEmail = mysqli_query($connect, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);
        if (!empty($verifica)){
            $erros[] = "E-mail já cadastrado!";
        }
        if (empty($erros)){
            //Inserir o usuário no BD
            $query = "INSERT INTO usuarios (nome, senha, email, admin) VALUES ('$nome', '$senha', '$email', '$admin')";
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
}

//Deletar algum dado
function deletar($connect, $tabela, $id){
    if (!empty($id)){
        $query = "DELETE FROM $tabela WHERE id =" . (int) $id;
        $execute = mysqli_query($connect, $query);
        if ($execute){
            echo "Dado deletado com sucesso!";
        } else {
            echo "Erro ao deletar!";

        }
    }
    
}

/* Inserir novos eventos */
function inserirEventos($connect){
    if ((isset($_POST["cadastrar"]) AND !empty($_POST['nome_evento'] AND !empty($_POST['nome_palestrante'] AND !empty($_POST['descricao'] AND !empty($_POST['data_evento'] AND !empty($_POST['horas_evento']))))))) {
        $erros = array();
        $nome = mysqli_real_escape_string($connect, $_POST['nome_evento']);
        $data = $_POST['data_evento'];
        $horas = $_POST['horas_evento'];
        $palestrante = mysqli_real_escape_string($connect, $_POST['nome_palestrante']);
        $descricao = $_POST['descricao'];


        $queryNome = "SELECT nome FROM evento WHERE nome = '$nome'";
        $buscaNome = mysqli_query($connect, $queryNome);
        $verifica = mysqli_num_rows($buscaNome);
        if(!empty($verifica)){
            $erros[] = "Já existe um evento com esse nome!";
        }
        if (empty($erros)) {
            //Inserir o evento no BD
            $query = "INSERT INTO evento (nome, data, horas, palestrante, descricao) VALUES ('$nome', '$data', '$horas', '$palestrante', '$descricao')";
            $executar = mysqli_query($connect, $query);
            if ($executar){
                echo "Evento criado com sucesso!";
            } else {
                echo "Erro ao criar evento!";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}

/* Seleciona(busca) no BD tidis is resultados com base no WHERE*/
function updateUser($connect){
    if (isset($_POST["atualizar"]) AND !empty($_POST['email'])){
        $erros = array();
        $id = filter_input(INPUT_POST,'id', FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $senha = "";
        $data = mysqli_real_escape_string($connect, $_POST['data_cadastro']);

        if(empty($data)){
            $erros[] = "Preencha a data de cadastro!"; 
        }
        if(empty($email)){
            $erros[] = "Preencha seu e-mail corretamente!"; 
        }
        if( strlen($nome) < 4){
            $erros[] = "Preencha seu nome completo!"; 
        }
        if (!empty($_POST['senha'])){
            if ($_POST['senha'] == $_POST['repeteSenha']){
                $senha = $_POST['senha'];
            } else {
                $erros[] = "Senhas não conferem!";
            }
        }
        $queryEmailAtual = "SELECT email FROM usuarios WHERE id = $id";
        $buscaEmailAtual = mysqli_query($connect, $queryEmailAtual);
        $retornoEmail = mysqli_fetch_assoc($buscaEmailAtual);
        
        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email' <> email =" . $retornoEmail['email'];
        $buscaEmail = mysqli_query($connect, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);
        if (!empty($verifica)){
            $erros[] = "E-mail já cadastrado!";
        }
        if (empty($erros)){
            // UPDATE USUARIO
            if(!empty($senha)){
                $query = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha' WHERE id =". (int) $id;
            } else {
                $query = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id =". (int) $id;
            }
            $executar = mysqli_query($connect, $query);
            if ($executar){
                echo "Usuário atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar usuário!";

            }
        } else {
            foreach ($erros as $erro) {
                echo "<p>$erro</p>";
            }
        }
    }
}

/* */

function inserirInscritos($connect){
    if (isset($_POST["cadastrar"]) AND !empty($_POST['nome']) AND !empty($_POST['email'])) {
        $erros = array();
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $telefone = filter_input(INPUT_POST,'telefone', FILTER_VALIDATE_INT);
        $inscricao = filter_input(INPUT_POST,'inscricao', FILTER_VALIDATE_INT);

        $queryEmail = "SELECT email FROM inscritos WHERE email = '$email'";
        $buscaEmail = mysqli_query($connect, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);
        if (!empty($verifica)){
            $erros[] = "E-mail já cadastrado!";
        }
        if (empty($erros)){
            //Inserir o usuário no BD
            $query = "INSERT INTO inscritos (nome, email, telefone, inscricao) VALUES ('$nome', '$email', '$telefone', '$inscricao')";
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
}

// Consultar certificado
function buscarCertificado($connect, $nome){
    $query = "SELECT * FROM inscritos WHERE nome = '$nome'";
    $execute = mysqli_query($connect, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}

//

function buscarAdmin($connect, $nome){
    $query = "SELECT * FROM usuarios WHERE nome = '$nome' AND admin = 1";
    $execute = mysqli_query($connect, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}

function buscarCertificado2($connect){
    if (isset($_POST["consultar"]) AND !empty($_POST['email'])){
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $query = "SELECT * FROM inscritos WHERE email = '$email'";
        $execute = mysqli_query($connect, $query);
        $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
        return $results;
    }
    
}