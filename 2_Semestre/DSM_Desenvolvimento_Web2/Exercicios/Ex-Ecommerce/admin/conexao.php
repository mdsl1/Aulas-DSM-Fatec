<?php
    $host = '127.0.0.1:3309';
    $dbname = 'miners_shopping_db';
    $usuario = 'php'; // User padrão do projeto
    $senha = 's3gr3d0';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conexão bem-sucedida!";
    } catch (PDOException $erro) {
        die("Erro na conexão: " . $erro->getMessage());
    }

?>