<?php

$dsn = "mysql:host=localhost;dbname=bowhotels";
$dbusername = "root";
$dbpassword = "root";

try {
    //We use PDO as it is more secure and not prone to sql injection
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    
}