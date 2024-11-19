<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepagina</title>
</head>

<body>
  <?php
  $sql = "SELECT id, naam, email, bericht FROM contactinfo;";
  include_once "../core/db_connect.php";
  // include "core/header.php";

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
          <p>Naam: <?= $name ?></p>
          <p>Email: <?= $email ?></p>
          <p>Bericht: <?= $message ?></p>
        </div>
  <?php
      }
    }
    $qry->close();
  }
  ?>
</body>

</html>