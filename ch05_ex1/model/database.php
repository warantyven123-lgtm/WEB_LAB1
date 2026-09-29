<?php
    $dsn = 'mysql:host=127.0.0.1;dbname=my_guitar_shop1;charset=utf8';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>