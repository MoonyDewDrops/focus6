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

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CMS</title>
    </head>

    <body>
        <?php
        if (isset($paginas)) {
            foreach ($paginas as $pagina) {
        ?>
                <div>
                    <button class="CMSbuttons">
                        <?= $pagina['paginaNaam']; ?>
                    </button>
                    <button class="">
                        <a href='editProcess?id=<?= $pagina['id'];?>' style="text-decoration:none;color:black;">Edit</a>
                    </button>
                    <button class="">
                        <a href='deleteProcess?id=<?= $pagina['id'];?>' style="text-decoration:none;color:black;">Delete</a>
                    </button>

                    <br>
                </div>
        <?php
            }
        }
        ?>
        <button class="CMSbuttons">
            <a href="create" style="text-decoration:none;color:black;"> Pagina toevoegen </a>
        </button>

        <br>
        <br>

        <button>
            <a href="contact" style="text-decoration:none;color:black;">Contacten bekijken</a>
        </button>


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