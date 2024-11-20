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

    $con->close();
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
                                <a href='editProcess?id=<?= $pagina['id']; ?>' style="text-decoration:none;color:black;">Edit</a>
                            </td>
                            <td>
                                <a href='deleteProcess?id=<?= $pagina['id']; ?>'
                                    style="text-decoration:none;color:black;">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <a class="add" href="create"> Pagina toevoegen </a>
        </div>
        <div id="socials" class="cmsOptions">
            <p class="optionTitle">Socials</p>
            <a href="createSocial" style="text-decoration:none;color:black;">Social toevoegen</a>
        </div>
        <div id="contactberichten" class="cmsOptions">
            <p class="optionTitle">Contacten</p>
            <a href="contact" style="text-decoration:none;color:black;">Contacten bekijken</a>
        </div>
    </div>
    <?php
} else if (!isset($_SESSION['gebruikersnaam'])) {
    ?>
        <script>
            location.replace("http://localhost/focus6/login");
        </script>
    <?php
}
?>
</body>

</html>