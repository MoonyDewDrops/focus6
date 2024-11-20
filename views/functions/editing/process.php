<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing process</title>
</head>

<body>
    <!-- check if there are rows, if so load in row data. -->

    <p>Overview existing rows</p>
    <?php
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM paginagrid";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $rows;
            }
        } else {
            // echo "No rows found";
            // exit;
        }

        $con->close();

        if (isset($rows)) {
            foreach ($rows as $row) {

    ?>

                <div class="row">
                    <p><?= $row['id'] ?></p>
                    <p><?= $row['rowPosition'] ?></p>
                    <p><?= $row['columnType'] ?></p>
                    <p><?= $row['page'] ?></p>
                </div>
        <?php
            }
        } else {
            echo 'Geen rows gevonden, probeer opnieuw.';
        }

        ?>
        <br>
        <br>

        <p>Add a row</p>

        <form action="edit?id=<?=$id?>" method="post" enctype="multipart/form-data">
            <label for="columnType">Hoevel kolomen?</label><br>
            <input type="number" name="amountOf" placeholder="1" style="width:10%;" min="1" required>
            <br>
            <br>
            <?php
            $creatingRow = 1;
            if (isset($rows) || isset($rows['id']) || isset($rows['rowPosition'])){
                $rows['rowPosition'] = $creatingRow++;
            } else {
                $creatingRow = 1;
            }

            ?>
            <input type="submit" value="Add a row">
        </form>
    <?php
    } else {
        echo 'Pagina ID is missend, probeer opnieuw!';
    }
    ?>
</body>

</html>