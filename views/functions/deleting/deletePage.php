<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $paginaID = $_GET['id'];
        $good1 = false;
        $good2 = false;
        $good3 = false;


        // $sql = "DELETE FROM paginas WHERE id = ?";

        // $stmt = $con->prepare($sql);
        // $stmt->bind_param("i", $id);
        // if ($stmt->execute()) {
        //     //to see if there was any of the things affected, and if it isnt, it'll display an error  
        //     if ($stmt->affected_rows > 0) {
        //         $good1 = true;
        //     } else {
        //       echo "Error";
        //     }
        // } else {
        //     echo "Error deleting page: " . $con->error;
        // }

        // $sql2 = "SELECT id FROM paginagrid";

        // $stmt = $con->prepare($sql);
        // $stmt->bind_param("i", $id);
        // if ($stmt->execute()) {
        //     //to see if there was any of the things affected, and if it isnt, it'll display an error  
        //     if ($stmt->affected_rows > 0) {
        //         $good1 = true;
        //     } else {
        //       echo "Error";
        //     }
        // } else {
        //     echo "Error deleting page: " . $con->error;
        // }

        // $sql3 = "DELETE FROM paginagrid WHERE id = ?";

        // $stmt = $con->prepare($sql);
        // $stmt->bind_param("i", $id);
        // if ($stmt->execute()) {
        //     //to see if there was any of the things affected, and if it isnt, it'll display an error  
        //     if ($stmt->affected_rows > 0) {
        //         $good1 = true;
        //     } else {
        //       echo "Error";
        //     }
        // } else {
        //     echo "Error deleting page: " . $con->error;
        // }



    } else {
        echo "Missing required GET parameters: id.";
    }
} else {
    echo "Invalid request method. Only GET is allowed.";
}


$con->close();
