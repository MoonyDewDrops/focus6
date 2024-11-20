<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing process</title>
</head>

<body>
    <p>Overview existing rows</p>
    <?php
    if (!empty($_GET['id'])) {
        //giving post variable
        $paginaID = $_GET['id'];

        //de sql stmt voor het halen van de grid data
        $sql = "SELECT id, rowPosition, columnType, pageValue FROM paginagrid";
        $stmt = $con->prepare($sql);
        //voor als er een error is
        if (!$stmt) {
            die("SQL error: " . $con->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        //noemt de paginaGrid als de data, en anders een lege array.
        $paginaGrid = $result->fetch_all(MYSQLI_ASSOC) ?: [];
        //VOLGENDEEEE

        //sql stmt
        $sql = "SELECT id, paginaNaam FROM paginas WHERE id = ?";
        $stmt = $con->prepare($sql);
        if (!$stmt) {
            //error ding
            die("SQL error: " . $con->error);
        }
        //bindt de parameter voor de paginaID vast.
        $stmt->bind_param('i', $paginaID);
        $stmt->execute();

        //bind de resultaat van de query voor pagina's vast aan de variabels.
        $stmt->bind_result($pageID, $paginaNaam);
        $stmt->fetch();
        $stmt->close();

        $existing = 0;

        if (!empty($paginaGrid)) {
            foreach ($paginaGrid as $row) {
                // Use loose comparison for IDs to avoid type mismatch
                if ($paginaID == $row['pageValue']) {
                    $existing = 1;
                    $rowPosition = $row['rowPosition'];
                    $columnType = $row['columnType'];
                    //9
                    $pageValue = $row['pageValue']; //9
    ?>
                    <!-- Display grid data -->
                    <div class="row">
                        <!-- dit is de hoeveelste row -->
                        <p>Row: <br> <?= $rowPosition ?></p>
                        <!-- dit is hoeveel kollomen er zijn -->
                        <p>Kolom hoeveid: <br> <?= $columnType ?></p>
                        <!-- en dit is welke pagina het is, de numerieke waarde hiervan heeft een comment met '9' erboven EN ernaast -->
                        <p>Pagina: <br> <?= $paginaNaam ?></p>
                    </div>
                    <br>
        <?php
                }
            }
        }

        if ($existing !== 1) {
            echo '<p>Geen rows gevonden voor deze pagina, probeer er een paar toe te voegen.</p>';
        }

        ?>

        <p>Add a row</p>
        <?php
        $rowPosition = isset($rowPosition) ? $rowPosition + 1 : 1;
        ?>
        <form action="addingRow" method="post" enctype="multipart/form-data">
            <label for="columnType">How many columns?</label><br>
            <input type="number" name="columnType" placeholder="1" style="width:10%;" min="1" required>
            <br><br>
            <input type="hidden" value="<?= $rowPosition ?>" name="rowPosition" id="rowPosition">
            <input type="hidden" value="<?= $paginaID ?>" name="pageValue" id="pageValue">
            <input type="submit" value="Add a row">
        </form>

    <?php
    } else {
        echo 'Pagina ID is missend, probeer opnieuw!';
    }

    $con->close();
    ?>
</body>

</html>