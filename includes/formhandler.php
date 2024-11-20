<?php

//If the page is accessed via a post 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $postVar = $_POST;
    print_r($postVar);
    //we use htmlspecialchars for input sanitzation
    $firt_name = $_POST["firt_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    //we just want to exit if they did not provide a name or email address and not insert to the database
    if (empty($firt_name) || empty($email)){
        header("Location: ../contact.html");
        exit();
    }

    try {
        
        require_once "dbh.inc.php";
        $query = "INSERT INTO form (firt_name, last_name, email, form_subject, form_message)
        VALUES (:firt_name, :last_name, :email, :subject, :message);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":firt_name", $firt_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":subject", $subject);
        $stmt->bindParam(":message", $message);
        $stmt->execute();
        // $stmt->execute([$first_name, $last_name, $email, $subject, $message]);
        $pdo = null;
        $stmt = null;
        header("Location: ../contact.html");
        die();

    } catch (PDOException $e) {
        echo"<br><h1>There's an error</h1>";
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../contact.html");
}