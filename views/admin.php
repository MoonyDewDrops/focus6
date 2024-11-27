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
?>

    <?php include 'core/admin_header.php'; ?>
    <div class="container">
        <div id="paginas" class="cmsOptions">
            <p class="optionTitle">Pagina's</p>
            <table>
                <tr>
                    <th>Naam</th>
                    <th colspan="2">Opties</th>
                </tr>
                <?php
                if (isset($paginas)) {
                    foreach ($paginas as $pagina) {
                ?>
                        <tr>
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
                                <p class="modalTitle">Weet je zeker dat je deze pagina (<?= $pagina['paginaNaam']; ?>) wilt verwijderen?</p>
                                <span class="close" onclick="document.getElementById('del<?= $pagina['id']; ?>').style.display='none'">&times;</span>
                                <a class="deleteYes" href='deletePageProcess?id=<?= $pagina['id']; ?>'>Ja</a>
                                <p class="deleteNo" onclick="document.getElementById('del<?= $pagina['id']; ?>').style.display='none'">Nee</p>
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
                <tr>
                    <th>Naam</th>
                    <th colspan="2">Opties</th>
                </tr>
                <tr>
                    <td>Social media?</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </table>
            <a class="add" href="?view=createSocial">Social toevoegen</a>
        </div>
        <div id="contactberichten" class="cmsOptions">
            <p class="optionTitle">Berichten</p>
            <?php
            if ($contactqry->execute()) {
                while ($contactqry->fetch()) {
            ?>
                    <div class="berichtcontainer">
                        <p><?= $name ?></p>
                        <p><?= $email ?></p>
                        <p><?= $message ?></p>
                    </div>
            <?php
                }
            }
            $contactqry->close();
            ?>
            <!-- Link klop nog niet! -->
            <a class="add" href="contactProcess">Alle berichten</a>
            <p class="add" onclick="document.getElementById('newMessage').style.display='grid'">Bericht toevoegen</p>
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
<?php
} else if (!isset($_SESSION['gebruikersnaam'])) {
    header("Location: ?view=login");
}
$con->close();
?>
</body>

</html>