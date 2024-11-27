<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $socialID = $_GET['id'];
        $good1 = false;

        $sql1 = "DELETE FROM socials WHERE id = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("i", $socialID);
        if ($stmt1->execute()) {
            $good1 = true;
        } else {
            echo "Error deleting from paginagrid: " . $con->error . "<br>";
        }

        if ($good1){
            header("Location: admin");
        }
    }
}