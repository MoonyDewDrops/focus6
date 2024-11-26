<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $paginaID = $_GET['id'];
        $good1 = false;
        $good2 = false;
        $good3 = false;


        $sql1 = "SELECT id FROM paginagrid WHERE pageValue = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("i", $paginaID);
        if ($stmt1->execute()) {
            $result1 = $stmt1->get_result();
            if ($result1->num_rows > 0) {
                $good1 = true;
                $row = $result1->fetch_assoc();
                $paginaGridID = $row['id'];
            } else {
                echo 'No results in paginagrid';
            }
        } else {
            echo 'Error executing paginagrid query: ' . $con->error;
        }

        if (isset($paginaGridID)) {
            $sql2 = "SELECT id FROM paginainfo WHERE whichRow = ?";
            $stmt2 = $con->prepare($sql2);
            $stmt2->bind_param("i", $paginaGridID);
            if ($stmt2->execute()) {
                $result2 = $stmt2->get_result();
                if ($result2->num_rows > 0) {
                    $good2 = true;
                } else {
                    echo 'No results in paginainfo';
                }
            } else {
                echo 'Error executing paginainfo query: ' . $con->error;
            }
        }

        $sql3 = "SELECT paginaNaam FROM paginas WHERE id = ?";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bind_param("i", $paginaID);
        if ($stmt3->execute()) {
            $result3 = $stmt3->get_result();
            if ($result3->num_rows > 0) {
                $good3 = true;
            } else {
                echo 'No results in paginas';
            }
        } else {
            echo 'Error executing paginas query: ' . $con->error;
        }

        echo $good1 ? 'Query 1 succeeded. ' : 'Query 1 failed. ';
        echo $good2 ? 'Query 2 succeeded. ' : 'Query 2 failed. ';
        echo $good3 ? 'Query 3 succeeded. ' : 'Query 3 failed. ';
    } else {
        echo "Missing required GET parameters: id.";
    }
} else {
    echo "Invalid request method. Only GET is allowed.";
}


$con->close();
