<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM contactinfo WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header('Location: ?view=contactProcess');
    } else {
        echo mysqli_error($con);
    }
}