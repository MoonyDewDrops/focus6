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
            <?php
            if (isset($paginas)) {
                foreach ($paginas as $pagina) {
                    ?>
                    <div>
                        <p><?= $pagina['paginaNaam']; ?></p>
                        <a href='editProcess?id=<?= $pagina['id']; ?>' style="text-decoration:none;color:black;">Edit</a>
                        <a href='deleteProcess?id=<?= $pagina['id']; ?>' style="text-decoration:none;color:black;">Delete</a>
                    </div>
                    <?php
                }
            }
            ?>
            <a href="create" style="text-decoration:none;color:black;"> Pagina toevoegen </a>
            <a href="contact" style="text-decoration:none;color:black;">Contacten bekijken</a>
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