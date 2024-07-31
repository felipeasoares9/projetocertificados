<?php
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: login.php");
require_once "server.php";

include_once('./vendor/autoload.php');

$id = $_GET['id'];

$url = 'http://localhost/API/inscricao.php'. '?id=' . $id;

//echo "<h1>Gerar QRCode da URL:</h1> 
echo "<a style='float: left;'href='{$url}'>Redirect</a>";


$qrcode = (new \chillerlan\QRCode\QRCode())->render($url);
//var_dump($qrcode);

echo "<img src='$qrcode' style='width: 800px; height: 800px'>";