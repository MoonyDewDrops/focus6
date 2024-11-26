<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && isset($_GET['pageValue'])) {
        $paginaID = $_GET['id'];
        $pageValue = $_GET['pageValue'];

        $good1 = false;
        $good2 = false;

        $sql2 = "DELETE FROM paginainfo WHERE whichRow = ?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("i", $paginaID);
        if ($stmt2->execute()) {
            $good2 = true;
        } else {
            echo "Error deleting from paginainfo: " . $con->error . "<br>";
        }

        $sql1 = "DELETE FROM paginagrid WHERE id = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("i", $paginaID);
        if ($stmt1->execute()) {
            $good1 = true;
        } else {
            echo "Error deleting from paginagrid: " . $con->error . "<br>";
        }

        if ($good1 && $good2) {
            $checkPaginainfo = "SELECT COUNT(*) as count FROM paginainfo";
            $resultPaginainfo = $con->query($checkPaginainfo);
            $rowPaginainfo = $resultPaginainfo->fetch_assoc();
            if ($rowPaginainfo['count'] == 0) {
                $con->query("ALTER TABLE paginainfo AUTO_INCREMENT = 1");
            }

            $checkPaginagrid = "SELECT COUNT(*) as count FROM paginagrid";
            $resultPaginagrid = $con->query($checkPaginagrid);
            $rowPaginagrid = $resultPaginagrid->fetch_assoc();
            if ($rowPaginagrid['count'] == 0) {
                $con->query("ALTER TABLE paginagrid AUTO_INCREMENT = 1");
            }

            header("Location: editProcess?id=" . urlencode($pageValue));
            exit;
        }

        // Close resources
        $stmt1->close();
        $stmt2->close();
        $con->close();
    } else {
        echo "Missing required GET parameter: id or pageValue.";
    }
} else {
    echo "Invalid request method. Only GET is allowed.";
}
?>