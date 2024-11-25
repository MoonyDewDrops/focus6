<?php include_once 'core/admin_header.php'; ?>
<div class="cmsContainer">
    <p class="cmsTitle">Overview existing rows</p>
    <div class="gridsquare">

        <?php
        if (!empty($_GET['id'])) {
            //giving post variable
            $paginaID = $_GET['id'];

            //de sql stmt voor het halen van de grid data
            $sql = "SELECT id, rowPosition, columnType, pageValue FROM paginagrid ORDER BY rowPosition ASC";
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
            <form action="editRow?id=<?= $paginaID ?>" method="post" enctype="multipart/form-data" class="gridsquare">
                <p class="squareTitle">Pagina: <?= $paginaNaam ?></p>
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
                            <!-- Display grid data -->
                            <p>Row: <?= $rowPosition ?></p>
                            <div class="row<?= $columnType ?>">
                                <?php
                                switch ($columnType) {
                                    case 1:
                                        $columnAmount = 1;
                                        break;
                                    case 2:
                                        $columnAmount = 2;
                                        break;
                                    case 3:
                                        $columnAmount = 2;
                                        break;
                                    case 4:
                                        $columnAmount = 3;
                                        break;
                                }
                                for ($i = 1; $i <= $columnAmount; $i++) {
                                    ?>
                                    <div class="columnSettings">
                                        <textarea name="<?= $rowPosition ?>[<?= $i ?>][text]">fuck<?= $i ?></textarea> 
                                        <div>
                                            <label for="<?= $rowPosition ?>[<?= $i ?>][BG]">Background</label>
                                            <div>
                                                <span>No</span>
                                                <input type="radio" name="<?= $rowPosition ?>[<?= $i ?>][BG]" value="No" checked>
                                            </div>
                                            <div>
                                                <span>Yes</span>
                                                <input type="radio" name="<?= $rowPosition ?>[<?= $i ?>][BG]" value="Yes">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="<?= $rowPosition ?>[<?= $i ?>][IMG]">Image</label>
                                            <div>
                                                <span>No</span>
                                                <input type="radio" name="<?= $rowPosition ?>[<?= $i ?>][IMG]" value="No" checked>
                                            </div>
                                            <div>
                                                <span>Yes</span>
                                                <input type="radio" name="<?= $rowPosition ?>[<?= $i ?>][IMG]" value="Yes">
                                            </div>
                                        </div>
                                        <input type="file" name="<?= $rowPosition ?>[<?= $i ?>]['file']">
                                        <input type="hidden" value="<?= $columnType ?>" name="<?= $rowPosition ?>[<?= $i ?>][CT]"
                                            id="columnType">
                                        <input type="hidden" value="<?= $rowPosition ?>" name="<?= $rowPosition ?>[<?= $i ?>][ROW]"
                                            id="welkeRow">
                                        <input type="hidden" value="<?= $i ?>" name="<?= $rowPosition ?>[<?= $i ?>][COL]"
                                            id="hoeveelsteKolom">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                }

                if ($existing !== 1) {
                    echo '<p>Geen rows gevonden voor deze pagina, probeer er een paar toe te voegen.</p>';
                }

                ?>
                <input type="hidden" value="<?= $paginaID ?>" name="paginaID" id="paginaID">
                <input type="submit" value="Edit row" style="grid-column: 1;">

            </form>
        </div>
        <p>Add a row</p>
        <?php
        $rowPosition = isset($rowPosition) ? $rowPosition + 1 : 1;
        ?>
        <form action="addingRow" method="post" enctype="multipart/form-data">
            <label for="columnType">Which column-type?</label><br>
            <label class="columnPicker" for="columnType">
                <input type="radio" name="columnType" value="1" checked>
                <img src="assets/img/cms-style/columntype1.png" alt="placeholder">
            </label>
            <label class="columnPicker" for="columnType">
                <input type="radio" name="columnType" value="2">
                <img src="assets/img/cms-style/columntype2.png" alt="placeholder">
            </label>
            <label class="columnPicker" for="columnType">
                <input type="radio" name="columnType" value="3">
                <img src="assets/img/cms-style/columntype3.png" alt="placeholder">
            </label>
            <label class="columnPicker" for="columnType">
                <input type="radio" name="columnType" value="4">
                <img src="assets/img/cms-style/columntype4.png" alt="placeholder">
            </label>
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