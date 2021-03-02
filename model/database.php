<?php
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'root';
    $password = 'pa55word';

    try{
        $db = new PDO($dsn, $username);

    }
    catch(PDOException $e){
        $error_message = "Database Error: ";
        $error_message .= $e->getMessage();
        include("view/error.php");
        exit();
    }
?>