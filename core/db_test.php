    <?php
    $sql = "SELECT id, naam, email, bericht FROM contactinfo;";
    include_once __DIR__ . '/../core/db_connect.php';
    include __DIR__ . '/../core/header.php';

    $qry = $con->prepare($sql);
    if ($qry === false) {
        echo mysqli_error($con);
    } else {
        if ($qry->execute()) {
            $qry->bind_result($id, $name, $email, $message);
            while ($qry->fetch()) {
    ?>
                <div class="container">
                    <p>Dit is een test, verwijder als u begint met werken.</p>
                    <p>Naam: <?= $name ?></p>
                    <p>Email: <?= $email ?></p>
                    <p>Bericht: <?= $message ?></p>
                </div>
    <?php
            }
        }
        $qry->close();
    }
    ?>