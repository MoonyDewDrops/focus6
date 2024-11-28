<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= 'assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/login.css' ?>">
    <title>Registratie pagina</title>
</head>
<body>
    <div class="container">
        <div class="loginForm">

        <?php  

          if (isset($_POST['submit'])){
            $gebruikersnaam = $_POST['gebruikersnaam'];
            $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_BCRYPT);
          }


          $sqlQuery = mysqli_prepare($con, "SELECT gebruikersnaam FROM logininfo WHERE gebruikersnaam = ?");
          mysqli_stmt_bind_param($sqlQuery, 's', $gebruikersnaam);
          mysqli_stmt_execute($sqlQuery);
          mysqli_stmt_store_result($sqlQuery);


          if(mysqli_stmt_num_rows($sqlQuery) !=0 && isset($_POST['submit']) != null) {

            ?>

            <div class="pop-up">
                <p>Deze gebruikersnaam is al in gebruik!</p>
            </div>
            <?php
          } else if (isset($_POST['submit']) != null) {
            $insert_query = mysqli_prepare($con, "INSERT INTO logininfo(gebruikersnaam, wachtwoord) VALUES(?, ?)");
            mysqli_stmt_bind_param($insert_query, 'ss', $gebruikersnaam, $wachtwoord);
            mysqli_stmt_execute($insert_query);

            ?>
            
            <div class="pop-up">
                <p>De registratie is compleet!</p>
            </div>

            <?php
            mysqli_stmt_close($sqlQuery);
            mysqli_stmt_close($insert_query);
          }
            ?>
            <form action="" method="post">
                <header>Registreer</header>
                <br>

                <div class="inputField">
                    <label for="gebruikersnaam">Gebruikersnaam</label>
                    <input type="text" name="gebruikersnaam" id="gebruikersnaam" required>
                </div>

                <div class="inputField">
                    <label for="wachtwoord">Wachtwoord</label>
                    <input type="wachtwoord" name="wachtwoord" id="wachtwoord" required>
                </div>
                <br>
                <div class="inputField">
                    <input type="submit" name="submit" value="Registreer nu!">
                </div>
                <br>
                <div class="link">
                    Heb je al een account? <a href="?view=login">Log hier in.</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>