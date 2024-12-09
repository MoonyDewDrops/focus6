<?php include_once __DIR__ . '/../../../core/admin_header.php'; ?>
<div class="cmsContainer">
    <p class="cmsTitle">Overzicht bestaande rijen.</p>
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

            $columnqry = $con->prepare("SELECT id, informatie, colum, foto, backgroundColor, bold, italic, opacity, kleur FROM paginainfo WHERE WhichRow = ? AND colum = ?");
            $columnqry->bind_param('ii', $rowID, $columnID);
            $columnqry->bind_result($col_id, $col_info, $colum, $col_foto, $col_bg, $col_bold, $col_italic, $col_opacity, $col_kleur);
            $existing = 0;
            ?>
            <form action="?view=editRow&id=<?= $paginaID ?>" method="post" enctype="multipart/form-data">
                <p class="squareTitle">Pagina: <?= $paginaNaam ?></p>
                <?php
                if (!empty($paginaGrid)) {

                    foreach ($paginaGrid as $row) {
                        // Use loose comparison for IDs to avoid type mismatch
                        if ($paginaID == $row['pageValue']) {
                            $existing = 1;
                            $rowPosition = $row['rowPosition'];
                            $rowID = $row['id'];
                            $columnType = $row['columnType'];
                            //9
                            $pageValue = $row['pageValue']; //9
            

                            ?>
                            <!-- Display grid data -->
                            <div class="rowLayout">
                                <p>Row: <?= $rowPosition ?></p>

                                <a class="verwijderen" href="?view=deleteRow&id=<?= $rowID ?>&pageValue=<?= $pageValue ?>">verwijderen</a>
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
                                        $columnID = $i;
                                        $columnqry->execute();
                                        $columnqry->store_result();
                                        $columnqry->fetch();
                                        ?>
                                        <div class="columnSettings">
                                            <textarea name="<?= $rowID ?>[<?= $i ?>][text]"><?= $col_info ?></textarea>
                                            <div>
                                                <?php
                                                if ($col_bg == '0') {
                                                    ?>
                                                    <p class="label">Background</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BG]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BG]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][BG]" value="No" checked>
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BG]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BG]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][BG]" value="Yes">
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p class="label">Background</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BG]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BG]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][BG]" value="No">
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BG]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BG]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][BG]" value="Yes" checked>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <?php
                                                if ($col_foto == '0') {
                                                    ?>
                                                    <p class="label">Image</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][IMG]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][IMG]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][IMG]" value="No" checked>
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][IMG]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][IMG]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][IMG]" value="Yes">
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p class="label">Image</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][IMG]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][IMG]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][IMG]" value="No">
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][IMG]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][IMG]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][IMG]" value="Yes" checked>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <?php
                                                if ($col_bold == '0') {
                                                    ?>
                                                    <p class="label">Bold</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BOLD]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BOLD]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][BOLD]" value="No" checked>
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BOLD]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BOLD]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][BOLD]" value="Yes">
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p class="label">Bold</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BOLD]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BOLD]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][BOLD]" value="No">
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][BOLD]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][BOLD]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][BOLD]" value="Yes" checked>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <?php
                                                if ($col_italic == '0') {
                                                    ?>
                                                    <p class="label">Italic</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][ITALIC]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][ITALIC]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][ITALIC]" value="No" checked>
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][ITALIC]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][ITALIC]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][ITALIC]" value="Yes">
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p class="label">Italic</p>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][ITALIC]NO">No</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][ITALIC]NO" type="radio" name="<?= $rowID ?>[<?= $i ?>][ITALIC]" value="No">
                                                    </div>
                                                    <div>
                                                        <label for="<?= $rowID ?>[<?= $i ?>][ITALIC]YES">Yes</label>
                                                        <input id="<?= $rowID ?>[<?= $i ?>][ITALIC]YES" type="radio" name="<?= $rowID ?>[<?= $i ?>][ITALIC]" value="Yes" checked>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <label for="<?= $rowID ?>[<?= $i ?>][OPACITY]">Opacity</label>
                                                <input id="<?= $rowID ?>[<?= $i ?>][OPACITY]" type="number" name="<?= $rowID ?>[<?= $i ?>][OPACITY]" min="1" max="10" step="1" value="<?= $col_opacity ?>">
                                            </div>
                                            <div>
                                                <label for="<?= $rowID ?>[<?= $i ?>][KLEUR]">Color</label>
                                                <input id="<?= $rowID ?>[<?= $i ?>][KLEUR]" type="color" name="<?= $rowID ?>[<?= $i ?>][KLEUR]" value="<?= $col_kleur ?>">
                                            </div>
                                            <input type="file" name="<?= $col_id ?>">
                                            <input type="hidden" value="<?= $columnType ?>" name="<?= $rowID ?>[<?= $i ?>][CT]"
                                                >
                                            <input type="hidden" value="<?= $rowID ?>" name="<?= $rowID ?>[<?= $i ?>][ROW]" >
                                            <input type="hidden" value="<?= $i ?>" name="<?= $rowID ?>[<?= $i ?>][COL]"
                                                >
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
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
        <?php
        $rowPosition = isset($rowPosition) ? $rowPosition + 1 : 1;
        ?>

        <form action="?view=addingRow&id=<?= $paginaID; ?>" method="post" enctype="multipart/form-data">
            <p class="label">Which column-type?</p><br>
            <label class="columnPicker" for="columnType1">
                <input id="columnType1" type="radio" name="columnType" value="1" checked>
                <img src="assets/img/cms-style/columntype1.png" alt="placeholder">
            </label>
            <label class="columnPicker" for="columnType2">
                <input id="columnType2" type="radio" name="columnType" value="2">
                <img src="assets/img/cms-style/columntype2.png" alt="placeholder">
            </label>
            <label class="columnPicker" for="columnType3">
                <input id="columnType3" type="radio" name="columnType" value="3">
                <img src="assets/img/cms-style/columntype3.png" alt="placeholder">
            </label>
            <label class="columnPicker" for="columnType4">
                <input id="columnType4" type="radio" name="columnType" value="4">
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