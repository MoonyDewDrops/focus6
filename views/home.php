<?php include __DIR__ . '/../core/header.php'; ?>
<?php
$page = 1;
$sql1 = "SELECT id, columnType FROM paginagrid WHERE pageValue = ? ORDER BY rowPosition ASC;";
$stmt1 = $con->prepare($sql1);
if ($stmt1 === false) {
  echo mysqli_error($con);
}
$stmt1->bind_param('i', $page);
$stmt1->execute();
$result = $stmt1->get_result();
$paginaGrid = $result->fetch_all(MYSQLI_ASSOC) ?: [];
$stmt1->close();

$sql2 = "SELECT informatie, foto, backgroundColor, bold, italic, opacity, kleur FROM paginainfo WHERE whichRow = ? AND colum = ?;";
$stmt2 = $con->prepare($sql2);
if ($stmt2 === false) {
  echo mysqli_error($con);
}
$stmt2->bind_param('ii', $rowId, $columnID);
$stmt2->bind_result($informatie, $foto, $backgroundColor, $bolded, $italic, $opacity, $kleur);



?>

<main class="homepage">
  <?php
  if (!empty($paginaGrid)) {
    foreach ($paginaGrid as $row) {
      $rowId = $row['id'];
      $columnType = $row['columnType'];
      ?>
      <div class="rowContainer">
        <?php
        switch ($columnType) {
          case 1:
            $columnAmount = 1;
            break;
          case 2:
            $columnAmount = 2;
            break;
          case 3:
            $columnAmount = 2;
            break;
          case 4:
            $columnAmount = 3;
            break;
          default:
            $columnAmount = 1;
            break;
        }
        if ($columnType == 1) {
          ?>
          <div class="top-content">
            <?php
        } else if ($columnType == 2 || $columnType == 3) {
          ?>
            <div class="middle-content">
          <?php
        } else{
          ?>
            <div class="row<?= $columnType ?>">
              <?php
        }
        for ($i = 1; $i < $columnAmount + 1; $i++) {
          $columnID = $i;
          $stmt2->execute();
          $stmt2->store_result();
          $stmt2->fetch();
          $opacity = $opacity / 10;
          if ($foto == 0) {
            if ($italic == 1 && $bolded == 1) {
              if ($backgroundColor == 1) {
                ?>
                <div class="coloredColumn">
                  <?php
              } else {
                ?>
                <div class="normalColumn">
                  <?php
              }
              ?>
                  
                <p class="home-text italic bold" style="opacity:<?= $opacity ?>; color:<?= $kleur ?>"><?= $informatie ?></p>
              </div>
                <?php
            } else if ($italic == 1) {
              if ($backgroundColor == 1) {
                ?>
                <div class="coloredColumn">
                  <?php
              } else {
                ?>
                <div class="normalColumn">
                  <?php
              }
              ?>
                <p class="home-text italic" style="opacity:<?= $opacity ?>; color:<?= $kleur ?>"><?= $informatie ?></p>
            </div>
            <?php
            } else if ($bolded == 1) {
              if ($backgroundColor == 1) {
                ?>
                <div class="coloredColumn">
                  <?php
              } else {
                ?>
                <div class="normalColumn">
                  <?php
              }
              ?>
                <p class="home-text bold" style="opacity:<?= $opacity ?>; color:<?= $kleur ?>"><?= $informatie ?></p>
            </div>
            <?php
            } else {
              if ($backgroundColor == 1) {
                ?>
                <div class="coloredColumn">
                  <?php
              } else {
                ?>
                <div class="normalColumn">
                  <?php
              }
              ?>
                <p class="home-text" style="opacity:<?= $opacity ?>; color:<?= $kleur ?>"><?= $informatie ?></p>
            </div>
            <?php
            }
          } else {
            if ($columnType == 1) {
              ?>
                  <div class="top-image">
                    <img class="team-image" src="assets/img/fotos/<?= $informatie ?>"
                      style="opacity:<?= $opacity ?>; color:<?= $kleur ?>" alt="foto">
                  </div>
                  <?php
            } else {
              ?>
                  <img src="assets/img/fotos/<?= $informatie ?>" style="opacity:<?= $opacity ?>; color:<?= $kleur ?>" alt="foto">
                  <?php
            }
          }
        }
        ?>

        </div>
      </div>
      <?php
    }
  }
  ?>
  <!-- <div class="top-image">
      <img class="team-image" src="assets/images/IMG_9579.jpeg" alt="focus 6 team picture">
    </div>

    <div class="top-content container">
      <h1 class="heading">Wat doet Focus6</h1>
      <p class="home-text">Focus6 biedt met haar Spiegelconcept een inspirerende en doeltreffende aanpak voor de ontwikkeling van een lerende organisatie. Ons Spiegelconcept combineert reflectie, actie en groei om teams en organisaties naar een hoger niveau te tillen. Dit innovatieve concept kan eenvoudig worden ingezet op teamniveau, waardoor de focus ligt op directe samenwerking en resultaten. Tegelijkertijd biedt het de flexibiliteit om snel op te schalen naar organisatieniveau, zodat de gehele organisatie kan profiteren van de geleerde inzichten en verbeterde dynamiek.</p>
    </div>

    <div class="middle-content container">
      <h3 class="middle-text">Wat Focus6 uniek maakt, is dat het Spiegelconcept volledig in de praktijk is ontwikkeld en getest. Het is geen theoretisch model, maar een aanpak die zijn waarde heeft bewezen in echte organisatiesituaties. We geloven sterk in de kracht van teams: een goed functionerend team is de motor van innovatie, samenwerking en groei. In onze visie onderscheidt een team zich wanneer het in staat is om effectief samen te werken, continu te leren van ervaringen, en vernieuwend te zijn om steeds betere prestaties te leveren.</h3>

      <img class="middle-img" src="assets/images/image1.png" alt="">
    </div>

    <div class="bottom-content container">
      <p class="home-text">
        Met het Spiegelconcept geven we teams niet alleen de tools om succesvoller te worden, maar ook om als inspiratie te dienen voor de rest van de organisatie. Samen bouwen we aan een cultuur van leren, verbeteren en presteren.
      </p>

      <h3 class="bottom-text">Kortom: focus op succes!</h3>
    </div> -->
</main>

<?php include __DIR__ . '/../core/footer.php'; ?>










<!-- <?php
$sql = "SELECT id, naam, email, bericht FROM contactinfo;";
include_once __DIR__ . '/../core/db_connect.php';
include __DIR__ . '/../core/header.php';

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
?> -->
