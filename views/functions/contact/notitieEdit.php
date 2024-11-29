<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notitie = $_POST['notitie'];
    $id = $_POST['id'];
    $stmt = "UPDATE notities SET notitie = ? WHERE id = ?";
    $qry = $con->prepare($stmt);
    $qry->bind_param('si', $notitie, $id);
    if ($qry->execute()) {
        header('Location: ?view=contactProcess');
    } else {
        echo mysqli_error($con);
    }
}