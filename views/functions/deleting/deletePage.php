<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $paginaID = $_GET['id'];
        $good1 = false;
        $good2 = false;
        $good3 = false;

        $sql1 = "DELETE FROM paginainfo WHERE whichRow IN (SELECT id FROM paginagrid WHERE pageValue = ?)";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("i", $paginaID);
        if ($stmt1->execute()) {
            $good1 = true;
        } else {
            echo "Error deleting from paginainfo: " . $con->error;
        }

        $sql2 = "DELETE FROM paginagrid WHERE pageValue = ?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("i", $paginaID);
        if ($stmt2->execute()) {
            $good2 = true;
        } else {
            echo "Error deleting from paginagrid: " . $con->error;
        }

        $sql3 = "DELETE FROM paginas WHERE id = ?";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("i", $paginaID);
        if ($stmt3->execute()) {
            $good3 = true;
        } else {
            echo "Error deleting from paginas: " . $con->error;
        }


        if ($good1 && $good2 && $good3){
            header("Location: ?view=admin");
            exit;
        }

        // Close connections
        $stmt1->close();
        $stmt2->close();
        $stmt3->close();
        $con->close();
    } else {
        echo "Missing required GET parameter: id.";
    }
} else {
    echo "Invalid request method. Only GET is allowed.";
}
?>