<?php
    require_once "server.php";
?>

<?php
/* QUERY PARA RECUPERAR OS REGISTROS DO BANCO DE DADOS */
if (isset($_GET['id'])){
    $tabela = "inscritos";
    $where = "id =" . $_GET['id'];
    $usuarios = buscar($connect, $tabela, $where);
    foreach ($usuarios as $usuario) :
        $usuario['nome'];
    endforeach;
} ?>

<?php 
    if (isset($_GET['id'])){
        $tabela = 'evento';
        $where = 'id='. $_GET['idpalestra'];
        $eventos = buscar($connect, $tabela, $where);
        foreach ($eventos as $evento) :
            $evento['nome'];
        endforeach;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
            height: 1131px;
            width: 1600px;
        }
        main {
        }

        h1 {
            padding-top: 200px;
            text-align: center;
            font-size: 80pt;
            display: block;
        }

        h2 {
            display: block;
            margin-top: -980px;
            font-weight: 400;
            text-align: center;
            font-size: 31pt;
        }

        h3 {
            display: block;
            margin-top: -1030px;
            text-transform: uppercase;
            font-size: 50pt;
            text-align: center;
        }

        h4 {
            display: block;
            margin-top: -1030px;
            font-size: 40pt;
            font-weight: 400;
            text-align: center;
        }
        h5{
            display: block;
            margin-top: -720px;
            font-size: 40pt;
            font-weight: 400;
            text-align: center;
        }
    </style>
    <title><?php echo $usuario['nome']; ?></title>
</head>
<body>
    <main>
        <h1><b>CERTIFICADO</b></h1>
        <h2>Certificamos que, para os devidos fins, a aluna</h2>
        <h3><?php echo $usuario['nome']; ?></h3>
        <h4>concluiu o curso "<?php echo $evento['nome']; ?>", ministrado pelo profissional <?php echo $evento['palestrante']; ?>, com carga horária de <?php if ($evento['horas'] < 10){
            echo "0" . $evento['horas'];
        } else {
            echo $evento['horas']; 
        }
        ?> horas, no Centro Universitário Senac.</h4>
        <h5>Diretor</h5>
        <img src="img/modelo.png" alt="" style="margin-top: -2095px; float: right;">
    </main>
    <button id="generate-pdf">Gerar PDF</button>
</body>
</html>


