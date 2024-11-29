<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepagina</title>
</head>

<body>
  <?php include __DIR__ . '/../core/header.php'; ?>

  <main class="homepage">
    <div class="top-image">
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
    </div>
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
</body>

</html>