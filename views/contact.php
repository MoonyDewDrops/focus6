<?php include "core/header.php"?>

<div class="contact_grid">

 <div class="contact_tekst">
    <h1>Contact</h1>
    <h3>Neem contact met ons op!</h3>
 </div>
    
<form class="contact_form" action="connect.php" method="post"> 
  <!-- <form action="/action_page.php" target="_blank"></form> -->
  <label for="naam">Naam:</label><br>
  <input type="text" id="naam" name="Vnaam" value="Volledige Naam"><br>
  <label for="email">Emailadres:</label><br>
  <input type="text" id="email" name="email" value=""><br><br>
  <label for="bericht">Bericht:</label><br>
  <input type="text" id="bericht" name="bericht" value="...."><br>

  <input type="submit" value="Submit" target=" ">
</form> 
</div>



















<?php include "core/footer.php" ?>