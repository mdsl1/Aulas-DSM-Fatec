<?php
    $dados = isset($_POST["dados"]) ? $_POST["dados"] : "teste";
    $regra = "valor + 2";
    $result = "";
    foreach(str_split($dados) as $val) {
        $result .= chr(ord($val) + 2);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Criptografia de dados</h1>
    <ul>
        <li>Dado original: <?= $dados; ?></li>
        <li>Regra: <?= $regra; ?></li>
        <li>Resultado: <?= $result; ?></li>
    </ul>
</body>
</html>