<?php

$sql = "SELECT c.id as contactId, c.naam, c.email, c.bericht, (SELECT GROUP_CONCAT(DISTINCT CONCAT(n.id, '-' ,n.notitie)) FROM notities AS n WHERE c.id = n.contact_id ) FROM contactinfo as c";
$contactqry = $con->prepare($sql);
$contactqry->bind_result($contactId, $name, $email, $message, $notities);
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
                    <p class="berichtid"><?= $contactId ?></p>
                    <p style="color:red;" onclick="document.getElementById('del<?= $contactId; ?>').style.display='grid'">
                        Verwijderen</p>
                    <p class="berichtNaam"><?= $name; ?></p>
                    <p class="berichtEmail"><?= $email; ?></p>
                    <p class="berichtBericht"><?= $message; ?></p>
                    <?php
                    if ($notities != null) {
                        $notities = explode(',', $notities);
                        foreach ($notities as $notitie) {
                            $notitie = explode('-', $notitie);
                            ?>
                            <div class="berichtNotitie">
                                <p><?= $notitie[0]; ?></p>
                                <p onclick="document.getElementById('notDel<?= $notitie[0]; ?>').style.display='grid'">Verwijderen</p>
                                <p><?= $notitie[1]; ?></p>
                                <a href="editNotitie?id=<?= $notitie[0]; ?>">Notitie aanpassen</a>
                            </div>
                            <div id="notDel<?= $notitie[0]; ?>" class="modal">
                                <div class="modal-content">
                                    <p class="modalTitle">Weet je zeker dat je deze notitie wilt verwijderen?</p>
                                    <span class="close"
                                        onclick="document.getElementById('notDel<?= $notitie[0]; ?>').style.display='none'">&times;</span>
                                    <a class="deleteYes" href='deleteContactProcess?id=<?= $notitie[0]; ?>'>Ja</a>
                                    <p class="deleteNo" onclick="document.getElementById('del<?= $notitie[0]; ?>').style.display='none'">
                                        Nee</p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <p>Nieuwe notitie toevoegen</p>
                    <div id="del<?= $contactId; ?>" class="modal">
                        <div class="modal-content">
                            <p class="modalTitle">Weet je zeker dat je dit bericht wilt verwijderen?</p>
                            <span class="close"
                                onclick="document.getElementById('del<?= $contactId; ?>').style.display='none'">&times;</span>
                            <a class="deleteYes" href='deleteContactProcess?id=<?= $contactId; ?>'>Ja</a>
                            <p class="deleteNo" onclick="document.getElementById('del<?= $contactId; ?>').style.display='none'">
                                Nee</p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo mysqli_error($con);
        }
        ?>
        <p class="add" onclick="document.getElementById('newMessage').style.display='grid'">Nieuw bericht toevoegen</p>
        <div id="newMessage" class="modal">
            <div class="modal-content">

                <form action="contactAdd" method="post">
                    <p>Bericht toevoegen</p>
                    <label for="name">Naam:</label>
                    <input type="text" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                    <label for="message">Bericht:</label>
                    <textarea name="message" required></textarea>
                    <input type="submit" value="Toevoegen">
                </form>
                <span class="close" onclick="document.getElementById('newMessage').style.display='none'">&times;</>
            </div>
        </div>
    </div>
</div>