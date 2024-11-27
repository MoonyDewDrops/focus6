<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $notitie = $_POST['notitie'];
    $id = $_POST['id'];
    $stmt = "INSERT INTO notities (notitie, contact_id) VALUES (?, ?)";
    $qry = $con->prepare($stmt);
    $qry->bind_param('si', $notitie, $id);
    if($qry->execute()){
        header('Location: contactProcess');
    } else {
        echo mysqli_error($con);
    }
}