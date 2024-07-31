<?php

include_once('./vendor/autoload.php');

$url = 'http://google.com';

echo "<h2>Gerar QRCode da URL: $url</h2>";

$qrcode = (new \chillerlan\QRCode\QRCode())->render($url);
//var_dump($qrcode);

echo "<img src='$qrcode' style='width: 500px; height: 500px'>";