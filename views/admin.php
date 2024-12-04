<?php
if (isset($_SESSION['gebruikersnaam'])) {
    //sql command
    $sql = "SELECT * FROM paginas";
    $result = $con->query($sql);

    //thing to do the stuff so i can call it in the body of the html
    if ($result->num_rows > 0) {
        $paginas = array();
        while ($row = $result->fetch_assoc()) {
            $paginas[] = $row;
        }
    } else {
        echo "No paginas found";
    }

    $sqlc = "SELECT naam, email, bericht FROM contactinfo ORDER BY id DESC LIMIT 3;";
    $contactqry = $con->prepare($sqlc);
    $contactqry->bind_result($name, $email, $message);
    if ($contactqry === false) {
        echo mysqli_error($con);
    }


    $sqlSocials = "SELECT id, naam, link, image FROM socials ORDER BY id";
    $socialsQry = $con->prepare($sqlSocials);
    $socialsQry->bind_result($socialsID, $socialsNaam, $link, $image);
    if ($socialsQry === false) {
        echo mysqli_error($con);
    }
    ?>

    <?php include __DIR__ . '/../core/admin_header.php'; ?>
    <div class="container">
        <div id="paginas" class="cmsOptions">
            <p class="optionTitle">Pagina's</p>
            <table>
                <tr class="pagesRow">
                    <th>Naam</th>
                    <th colspan="2">Opties</th>
                </tr>
                <?php
                if (isset($paginas)) {
                    foreach ($paginas as $pagina) {
                        ?>
                        <tr class="pagesRow">
                            <td><?= $pagina['paginaNaam']; ?></td>
                            <td>
                                <a href='?view=editProcess&id=<?= $pagina['id']; ?>'>Edit</a>
                            </td>
                            <td>
                                <p onclick="document.getElementById('del<?= $pagina['id']; ?>').style.display='grid'">Delete</p>
                            </td>
                        </tr>

                        <div id="del<?= $pagina['id']; ?>" class="modal">
                            <div class="modal-content">
                                <p class="modalTitle">Weet je zeker dat je deze pagina (<?= $pagina['paginaNaam']; ?>) wilt
                                    verwijderen?</p>
                                <span class="close"
                                    onclick="document.getElementById('del<?= $pagina['id']; ?>').style.display='none'">&times;</span>
                                <a class="deleteYes" href='?view=deletePageProcess&id=<?= $pagina['id']; ?>'>Ja</a>
                                <p class="deleteNo"
                                    onclick="document.getElementById('del<?= $pagina['id']; ?>').style.display='none'">Nee</p>
                            </div>

                        </div>
                        <?php

                    }
                }
                ?>
            </table>
            <a class="add" href="?view=createProcess"> Pagina toevoegen </a>
        </div>
        <div id="socials" class="cmsOptions">
            <p class="optionTitle">Socials</p>
            <table>
                <tr class="socialsRow">
                    <th>Naam</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th></th>
                </tr>
                <tr class="socialsRow">
                    <?php
                    if ($socialsQry->execute()) {
                        while ($socialsQry->fetch()) {
                            ?>
                            <td><a href="<?= $link ?>"><?= $socialsNaam ?></a> </td>
                            <td><?= $link ?></td>
                            <td><img src="<?= $image ?>" style="height:50px;width:auto;"></td>
                            <td><a href="?view=deleteSocial?id=<?= $socialsID ?>">Delete</a></td>
                            <?php
                        }
                    }
                    $socialsQry->close();
                    ?>
                </tr>
            </table>
            <a class="add" onclick="document.getElementById('newSocial').style.display='grid'">Social toevoegen</a>
            <div id="newSocial" class="modal">
                <div class="modal-content">
                    <form action="?view=createSocial" method="post" enctype="multipart/form-data">
                        <p>Social toevoegen</p>
                        <label for="photo">Photo:</label>
                        <input type="file" id="photo" name="photo">
                        <label for="media">Social media:</label>
                        <input type="text" id="media" name="media" required>
                        <label for="Link">Link:</label>
                        <textarea type="text" id="Link" name="Link" required></textarea>
                        <input type="submit" value="Social toevoegen">
                    </form>
                    <span class="close" onclick="document.getElementById('newSocial').style.display='none'">&times;</>
                </div>
            </div>
        </div>
            <div id="contactberichten" class="cmsOptions">
                <p class="optionTitle">Berichten</p>
                <?php
                if ($contactqry->execute()) {
                    $encryptionKey = "If6q[n93WDc',c>(!EIsRc/_lnrCz&l*"; // Gebruik een veilige sleutel
                    $cipherMethod = "aes-256-cbc"; // Encryptiemethode
            
                    while ($contactqry->fetch()) {
                        $name_decrypt = openssl_decrypt($name, $cipherMethod, $encryptionKey, 0);
                        $email_decrypt = openssl_decrypt($email, $cipherMethod, $encryptionKey, 0);
                        $message_decrypt = openssl_decrypt($message, $cipherMethod, $encryptionKey, 0);
                        ?>
                        <div class="berichtencontainer">
                            <p><?= $name_decrypt ?></p>
                            <p><?= $email_decrypt ?></p>
                            <p><?= $message_decrypt ?></p>
                        </div>
                        <?php
                    }
                }
                $contactqry->close();
                ?>
                <a class="add" href="contactProcess">Alle berichten</a>
                <p class="add" onclick="document.getElementById('newMessage').style.display='grid'">Bericht toevoegen</p>
                <div id="newMessage" class="modal">
                    <div class="modal-content">

                        <form action="?view=contactAdd" method="post">
                            <p>Bericht toevoegen</p>
                            <label for="name">Naam:</label>
                            <input id="name" type="text" name="name" required>
                            <label for="email">Email:</label>
                            <input id="email" type="email" name="email" required>
                            <label for="message">Bericht:</label>
                            <textarea id="message" name="message" required></textarea>
                            <input type="submit" value="Toevoegen">
                        </form>
                        <span class="close" onclick="document.getElementById('newMessage').style.display='none'">&times;</>
                    </div>
                </div>
            </div>
        </div>
        <?php

} else if (!isset($_SESSION['gebruikersnaam'])) {
    header("Location: ?view=login");
}
$con->close();

?>

    </body>

    </html>