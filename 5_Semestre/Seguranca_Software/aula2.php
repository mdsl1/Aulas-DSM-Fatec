<?php 
    $msg = "BUSQUEM CONHECIMENTO";
    $chave = "Z";

    $cifras = [];
    $result = "";

    foreach(str_split($msg) as $l) {
        $val = (ord($l) ^ ord($chave)) + 50;
        $result .= chr($val);
        $cifras[] = $val;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Criptografia</h4>
    <p><?= $result ?></p>

    <h4>Números ASCII da Criptografia</h4>
    <p><?php 
        foreach($cifras as $l) {
            echo "#" . $l . "; ";
        }
    ?></p>

    <h4>Descriptografia</h4>
    <p><?php
        foreach(str_split($result) as $l) {
            echo chr((ord($l) - 50) ^ ord($chave));
        }
    ?></p>
</body>
</html>
