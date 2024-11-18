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
    <div>
        <?php
        if (isset($paginas)) {
            foreach ($paginas as $pagina) {
        ?>


            <button class="CMSbuttons">
                <?= $pagina['paginaNaam']; ?>
            </button>
            
            <br>



        <?php
            }
        }
        ?>
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