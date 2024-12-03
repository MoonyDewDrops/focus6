<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM contactinfo WHERE id = ?";
    $sql2 = "DELETE FROM notities WHERE contact_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param('i', $id);
    if ($stmt2->execute()) {
        if ($stmt->execute()) {
            header('Location: ?view=contactProcess');
        } else {
            echo mysqli_error($con);
        }
    } else {
        echo mysqli_error($con);
    }
    
}