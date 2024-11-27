<?php

$sql = "SELECT c.id as contactId, c.naam, c.email, c.bericht, n.id as notitieId, n.notitie  FROM contactinfo as c JOIN notities as n ON c.id = n.contact_id";
$contactqry = $con->prepare($sql);
$contactqry->bind_result($contactId, $name, $email, $message, $notitieId, $notitie);
if ($contactqry === false) {
    echo mysqli_error($con);
}
?>
<?php include 'core/admin_header.php'; ?>
<div class="cmsContainer">
    <p class="cmsTitle">Contactberichten</p>
    <div class="berichtcontainer">
        <?php 
        if ($contactqry->execute()) {
            while ($contactqry->fetch()) {
                ?>
                <div class="bericht">
                    <p class="berichtNaam"><?= $name; ?></p>
                    <p class="berichtEmail"><?= $email; ?></p>
                    <p class="berichtBericht"><?= $message; ?></p>
                    <p class="berichtNotitie"><?= $notitie; ?></p>
                    <a class="berichtNotitie" href="editNotitie?id=<?= $notitieId; ?>">Notitie aanpassen</a>
                </div>
                <?php
            }
        } else {
            echo mysqli_error($con);
        }
        ?>
    </div>
</div>