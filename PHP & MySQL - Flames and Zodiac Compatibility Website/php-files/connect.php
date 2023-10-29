<?php
    $db_name = "flamesdb";
    $db_username = "root";
    $db_pass = "";
    $db_host = "localhost";

    // Create and check connection
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $db_username, $db_pass);
    
        if ($pdo) {
            setcookie("success", "Connected to the $db_name database successfully!", time()+300);
        }
    } catch (PDOException $e) {
        setcookie("error", "Connection to the $db_name database failed!", time()+300);
    }
?>