<?php
include('server.php');

// Carrega o Composer
require './vendor/autoload.php';

$tabela = "inscritos";
$where = "id=" . $_GET['id'];
$pessoas = buscar($connect, $tabela, $where);

$html = "<!DOCTYPE html>";
$html .= "<html lang='pt-br'>";
$html .= "<head>";
$html .= "<meta charset='UTF-8'>";
$html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$html .= "<style>
*{
    margin: 0;
    padding: 0;
    height: 1131px;
    width: 1600px;
}
main {

}

body {
    // background-image: url('img/modelo.png');
}

h1 {
    padding-top: 100px;
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
    margin-top: -970px;
    text-transform: uppercase;
    font-size: 50pt;
    text-align: center;
}

h4 {
    display: block;
    margin-top: -1000px;
    margin-bottom: 0px;
    font-size: 40pt;
    font-weight: 400;
    text-align: center;
}
h5{
    display: block;
    margin-top: -500px;
    font-size: 40pt;
    font-weight: 400;
    text-align: center;
} 
</style>";

$html .= "<title>Certificado</title>";
$html .= "</head>";
$html .= "<body>";
$html .= "<main>";
$html .= "<h1>CERTIFICADO</h1>";
//$html .= "<h2>Certificamos que, para os devidos fins, o aluno</h2>";
foreach ($pessoas as $pessoa) :
    $html .= "<h3>" . $pessoa['nome'] . "</h3>";
endforeach;
$tabela = "evento";
$where = "id =" . $_GET['idpalestra'];
$eventos = buscar($connect, "evento", $where);


foreach ($eventos as $evento) :
    if ($evento['horas'] < 10){
        $evento['horas'] = "0" . $evento['horas'];
    } else {
        $evento['horas']; 
    }
    $html .= "<h4>". 'concluiu o curso "' . $evento['nome'] . '", ministrado pelo profissional ' .  $evento['palestrante'] . ', com carga horária de ' . $evento['horas'] . ' horas, no Centro Universitário Senac.' .  "</h4>";
endforeach;
$html .= "<h5>Diretor</h5>";
$html .= "<img src='img/modelo.png' alt='background' style='margin-top: -2095px; float: right;'>";
$html .= "</main>";
$html .= "</body>";

//print $html;
//Gerar o PDF


// Referencia o namespace Dompdf
use Dompdf\Dompdf;

// Instancia e usa a classe Dompdf

$dompdf = new Dompdf();

// Instancia o metodo
$dompdf->load_html($html);

$dompdf->set_option("defaultFont","sans");

$dompdf->setPaper("A3", "landscape");

$dompdf->render();

$dompdf->stream();