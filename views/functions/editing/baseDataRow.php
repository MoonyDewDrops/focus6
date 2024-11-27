<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && isset($_GET['rowPosition']) && isset($_GET['columnType'])) {
        $id = $_GET['id'];
        $informatie = 'Edit de kolom en zet hier iets leuks neer!';
        $whichRow = (int)$_GET['rowPosition'];
        $columnType = (int)$_GET['columnType'];

        // Validating
        $checkRowSql = "SELECT id FROM paginagrid WHERE id = ?";
        $checkStmt = $con->prepare($checkRowSql);
        $checkStmt->bind_param('i', $whichRow);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows === 0) {
            echo "Invalid row position: $whichRow does not exist in paginagrid.";
            $checkStmt->close();
            exit;
        }
        $checkStmt->close();

        $colum = 0;
        if ($columnType === 1) {
            $colum = 1;
        } else if ($columnType === 2 || $columnType === 3) {
            $colum = 2;
        } else if ($columnType === 4) {
            $colum = 3;
        } else {
            echo "Invalid column type.";
            exit;
        }

        $foto = 0;
        $backgroundColor = 0;

        echo "Informatie: $informatie<br>";
        echo "Row Position: $whichRow<br>";
        echo "Column Type: $columnType<br>";
        echo "Column Loop Limit: $colum<br>";
        echo "Foto: $foto<br>";
        echo "Background Color: $backgroundColor<br>";

        $allSuccess = true;
        for ($i = 1; $i <= $colum; $i++) {
            $sql2 = "INSERT INTO paginainfo (informatie, whichRow, colum, foto, backgroundColor) VALUES (?, ?, ?, ?, ?)";
            $insertqry2 = $con->prepare($sql2);

            if ($insertqry2 === false) {
                echo mysqli_error($con);
                $allSuccess = false;
                break;
            } else {
                $insertqry2->bind_param('siiii', $informatie, $whichRow, $i, $foto, $backgroundColor);
                if (!$insertqry2->execute()) {
                    echo "Error adding row: " . $insertqry2->error;
                    $allSuccess = false;
                    break;
                }
            }
            $insertqry2->close();
        }

        if ($allSuccess) {
            header("Location: ?view=editProcess&id=" . $id);
            exit;
        }
    } else {
        echo "Missing required GET parameters: id, rowPosition, or columnType.";
    }
} else {
    echo "Invalid request method. Only GET is allowed.";
}
