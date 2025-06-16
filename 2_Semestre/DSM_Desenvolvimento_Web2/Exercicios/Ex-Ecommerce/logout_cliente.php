<?php
    session_start();

    // Opção mais pesada: Destroi a sessão por completo
    // session_destroy();

    // Opção mais leve: limpa as variaveis de sessão
    $_SESSION = array();
    header("Location: index.php");
?>
