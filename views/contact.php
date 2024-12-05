<?php include "core/header.php";

// Genereer twee willekeurige getallen voor de captcha
$num1 = rand(1, 10);
$num2 = rand(1, 10);

// Sla het juiste antwoord op in de sessie
$_SESSION['captcha_answer'] = $num1 + $num2;
?>

<main class="contact container">
  <div class="contact-text">
    <h1>Contact</h1>
    <h2>Neem contact met ons op!</h2>
  </div>
  <div id="error" style="color: red;"></div>

  <?php
  // Foutmeldingen uit de sessie halen en weergeven
  if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
      echo "<p style='color: red;'>$error</p>";
    }
    unset($_SESSION['errors']); // Verwijder de fouten na het tonen
  }
  ?>

  <form id="form" method="POST" action="verwerkContact" novalidate>
    <div class="input">
      <div class="text-fields">
        <div class="input_box">
          <div class="input-text">
            <label for="naam">Naam:</label>
            <span id="naamError" style="color: red;"></span>
          </div>
          <input type="text" id="naam" name="naam" class="" required>
        </div>

        <div class="input_box">
          <div class="input-text">
            <label for="email">Email:</label>
            <span id="emailError" style="color: red;"></span>
          </div>
          <input type="text" id="email" name="email" class="" required>
        </div>
        <div class="input_box">
          <div class="input-text">
            <label for="bericht">Bericht:</label>
            <span id="berichtError" style="color: red;"></span>
          </div>
          <input type="text" id="bericht" name="bericht" class="" required minlength="10">
        </div>
        <div class="input_box">
          <div class="input-text">
            <label for="captcha">Los deze som op: <?php echo "$num1 + $num2"; ?></label>
            <span id="captchaError" style="color: red;"></span>
          </div>
          <input type="text" id="captcha" name="captcha" class="" required>
        </div>
        </div>
        </form>
        <div class="secure">
        <button id="myBtn">Privacy policy</button>
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php include "views/privacy_statement.php" ?></p>
          </div>
        </div>
        <input class="button" type="submit" value="Verzenden">
      </div>
  <h4 class="h4_privacy">(Als u op verzenden drukt gaat u akkoord met onze privacy beleid)</h4>
  </div>
  </div>
  </form>
</main>

<?php include __DIR__ . '/../core/footer.php'; ?>