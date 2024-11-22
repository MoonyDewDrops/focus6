<?php include_once 'core/admin_header.php'; ?>
<div class="cmsContainer">
    <p class="cmsTitle">Overview existing rows</p>
    <div class="gridsquare">
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
        ?>
        <p>Pagina: <?= $paginaNaam ?></p>
        <?php
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
                    <form action="editRow?id=<?=$pageValue?>" method="post" enctype="multipart/form-data">
                    <!-- Display grid data -->
                    <div class="row">
                        <!-- dit is de hoeveelste row -->
                        <p>Row: <br> <?= $rowPosition ?></p>
                        <!-- dit is hoeveel kollomen er zijn -->
                        <?php 
                        for ($i = 1; $i <= $columnType; $i++) {
                            ?>
                            
                            
                            <textarea name="informatie" id="content" cols="30" rows="10"></textarea>
                            <label for="photo">Photo:</label><br>
                            <input type="file" id="photo" name="photo" required><br>
                            <br><br>
                            <input type="hidden" value="<?=$i?>" name="welkeRow">
                            <!-- <label for="file">file</label>
                            <input type="file" id="image" name="image"><br> -->
                            <br><br>
                            <label for="backgroundColor">backgroundColor</label>
                            <input type="checkbox" name="backgroundColor"></textarea>   
                            <br><br> 
                            <br><br>
                            <?php
                        }
                        ?>
                          <input type="hidden" id="columnType" name="columnType" value="<?=$columnType?>" />
                            <input type="submit" value="Edit a row">
                    </div>
                    </form>
                    <br>
                    <?php
                }
            }
        }

        if ($existing !== 1) {
            echo '<p>Geen rows gevonden voor deze pagina, probeer er een paar toe te voegen.</p>';
        }

        ?>
        </div>
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

</div>
</body>

</html>