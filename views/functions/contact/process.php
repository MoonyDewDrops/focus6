<?php
    $sql="SELECT c.id as contactId, c.naam, c.email, c.bericht, (SELECT GROUP_CONCAT(DISTINCT CONCAT(n.id, '-' ,n.notitie)) FROM notities AS n WHERE c.id = n.contact_id ) FROM contactinfo as c"
    ; $contactqry=$con->prepare($sql);
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
                        <div class="berichtinfo">
                            <p class="bericht_id">ID:<?php
                            if ($contactId < 10) {
                                echo '000' . $contactId;
                            } else if ($contactId < 100) {
                                echo '00' . $contactId;
                            } else if ($contactId < 1000) {
                                echo '0' . $contactId;
                            } else {
                                echo $contactId;
                            }

                            ?>
                            </p>
                            <p class="verwijderen" onclick="document.getElementById('del<?= $contactId; ?>').style.display='grid'">
                                Verwijderen</p>
                            <p class="bericht_titel">
                                <span><?= $name; ?></span> -
                                <span><?= $email; ?></span>
                            </p>
                            <p class="berichtTekst"><?= $message; ?></p>
                        </div>
                        <div class="notitieContainer">
                            <?php
                            if ($notities != null) {
                                $notities = explode(',', $notities);
                                foreach ($notities as $notitie) {
                                    $notitie = explode('-', $notitie);
                                    ?>
                                    <div class="berichtNotitie">
                                        <p class="notitieNummer">Notitie: <?= $notitie[0]; ?></p>
                                        <p class="verwijderen" onclick="document.getElementById('notDel<?= $notitie[0]; ?>').style.display='grid'">
                                            Verwijderen
                                        </p>
                                        <p class="notitieTekst"><?= $notitie[1]; ?></p>
                                        <p class="aanpassen" onclick="document.getElementById('editNotitie<?= $notitie[0] ?>').style.display='grid'">
                                            Notitie
                                            aanpassen</p>
                                    </div>
                                    <div id="notDel<?= $notitie[0]; ?>" class="modal">
                                        <div class="modal-content">
                                            <p class="modalTitle">Weet je zeker dat je deze notitie wilt verwijderen?</p>
                                            <span class="close"
                                                onclick="document.getElementById('notDel<?= $notitie[0]; ?>').style.display='none'">&times;</span>
                                            <a class="deleteYes" href='deleteNotitieProcess?id=<?= $notitie[0]; ?>'>Ja</a>
                                            <p class="deleteNo"
                                                onclick="document.getElementById('notDel<?= $notitie[0]; ?>').style.display='none'">
                                                Nee</p>
                                        </div>
                                    </div>
                                    <div id="editNotitie<?= $notitie[0]; ?>" class="modal">
                                        <div class="modal-content">
                                            <form action="editNotitieProcess" method="post">
                                                <p>Notitie aanpassen</p>
                                                <input type="hidden" name="id" value="<?= $notitie[0]; ?>">
                                                <label for="notitie">Notitie:</label>
                                                <textarea name="notitie" required><?= $notitie[1]; ?></textarea>
                                                <input type="submit" value="Aanpassen">
                                            </form>
                                            <span class="close"
                                                onclick="document.getElementById('editNotitie<?= $notitie[0]; ?>').style.display='none'">&times;
                                                </d>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <p class="aanpassen" onclick="document.getElementById('newNote<?= $contactId; ?>').style.display='grid'">Nieuwe
                                notitie
                                toevoegen</p>
                        </div>
                        <div id="del<?= $contactId; ?>" class="modal">
                            <div class="modal-content">
                                <p class="modalTitle">Weet je zeker dat je dit bericht wilt verwijderen?</p>
                                <span class="close"
                                    onclick="document.getElementById('del<?= $contactId; ?>').style.display='none'">&times;</span>
                                <a class="deleteYes" href='deleteContactProcess?id=<?= $contactId; ?>'>Ja</a>
                                <p class="deleteNo"
                                    onclick="document.getElementById('del<?= $contactId; ?>').style.display='none'">
                                    Nee</p>
                            </div>
                        </div>
                        <div id="newNote<?= $contactId; ?>" class="modal">
                            <div class="modal-content">
                                <form action="?view=addNotitieProcess" method="post">
                                    <p>Notitie toevoegen</p>
                                    <input type="hidden" name="id" value="<?= $contactId; ?>">
                                    <label for="notitie">Notitie:</label>
                                    <textarea name="notitie" required></textarea>
                                    <input type="submit" value="Toevoegen">
                                </form>
                                <span class="close"
                                    onclick="document.getElementById('newNote<?= $contactId; ?>').style.display='none'">&times;
                                    </d>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo mysqli_error($con);
            }
            ?>
            <p class="aanpassen" onclick="document.getElementById('newMessage').style.display='grid'">Nieuw bericht toevoegen
            </p>
            <div id="newMessage" class="modal">
                <div class="modal-content">

                    <form action="?view=contactAdd" method="post">
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