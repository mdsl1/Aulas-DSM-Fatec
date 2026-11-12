<?php
    $host = "localhost";
    $port = "5432"; 
    $db_name = "postgres";
    $user = "postgres";
    $senha = "Postgre@142536.";

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db_name", $user, $senha);

        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // echo "Conexão bem sucedida.";
    } catch(PDOException $e) {
        die("Erro de conexão: " . $e ->getMessage());
    }
?>