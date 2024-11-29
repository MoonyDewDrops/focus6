<?php include "core/header.php"; 

// Genereer twee willekeurige getallen voor de captcha
$num1 = rand(1, 10);
$num2 = rand(1, 10);

// Sla het juiste antwoord op in de sessie
$_SESSION['captcha_answer'] = $num1 + $num2;
?>

<div class="container_grid">
  <div class="row">
    <div class="col-6 offset-3">
      <div class="form_box text-center">
        <h4>Contact</h4>
        <h5>Neem contact met ons op!</h5>
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

      <form id="form" method="POST" action="contact_process.php" novalidate>
        <div class="row">
          <div class="input_box col-6">
            <input type="text" id="naam" name="naam" class="form-control" placeholder="Naam" required>
            <label for="naam">Naam</label>
            <span id="naamError" style="color: red;"></span>
          </div>
          <div class="input_box col-6">
            <input type="text" id="email" name="email" class="form-control" placeholder="Email" required>
            <label for="email">Email</label>
            <span id="emailError" style="color: red;"></span>
          </div>
          <div class="input_box col-6">
            <input type="text" id="bericht" name="bericht" class="form-control" placeholder="Bericht" required
              minlength="10">
            <label for="bericht">Bericht</label>
            <span id="berichtError" style="color: red;"></span>
          </div>
          <input type="submit" value="Verzenden">
        </div>
        <div class="input_box col-6">
          <label for="captcha">Los deze som op: <?php echo "$num1 + $num2"; ?></label>
          <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Antwoord" required>
          <span id="captchaError" style="color: red;"></span>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "core/footer.php"; ?>