<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contactinfo (naam, email, bericht) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $name, $email, $message);
    if ($stmt === false) {
        echo mysqli_error($con);
    }
    if($stmt->execute()) {
        header("Location: admin");
    } else {
        echo "Er is iets fout gegaan!";
    }
    $stmt->close();
}