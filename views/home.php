<?php include 'core/header.php'; ?>
    <?php
      $sql = "SELECT id, naam, email, bericht FROM contactinfo;";

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
        <p>Naam: <?=$name?></p>
        <p>Email: <?=$email?></p>
        <p>Bericht: <?=$message?></p>
    </div>
    <?php
          }
        }
        $qry->close();
      }
    ?>
<?php include 'core/footer.php'; ?>