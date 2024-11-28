<?php include __DIR__ . '/../core/header.php'; ?>

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
            <input type="text" id="bericht" name="bericht" class="form-control" placeholder="Bericht" required minlength="10">
            <label for="bericht">Bericht</label>
            <span id="berichtError" style="color: red;"></span>
          </div>
          <input type="submit" value="Verzenden">
        </div>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../core/footer.php'; ?>
