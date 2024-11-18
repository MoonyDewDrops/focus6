<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login pagina</title>
</head>

<body>
    <div class="container">
        <div class="loginForm">


            <?php
            if (isset($_POST['submit'])) {
                //getting wachtwoord & user
                $gebruikersnaam = mysqli_real_escape_string($con, $_POST['gebruikersnaam']);
                $wachtwoord = $_POST['wachtwoord'];

                //query
                $query = "SELECT gebruikersnaam, wachtwoord FROM logininfo WHERE gebruikersnaam='$gebruikersnaam'";

                $result = $con->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    //hashing that hoe to protect us from the haters
                    $hash_pass = $row['wachtwoord'];

                    if (password_verify($wachtwoord, $hash_pass)) {
                        $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                        header("Location: admin");
                        exit();
                    } else {
            ?>
                        <div class="pop-up">
                            <p>Fout wachtwoord of gebruikersnaam.</p>
                        </div>
                    <?php
                    }
                } else { ?>
                    <div class="pop-up">
                        <p>Geen account gevonden.</p>
                    </div>
                <?php
                }
            } else {
                ?>

                <form action="" method="post">
                    <header>Login</header>
                    <br>

                    <div class="inputField">
                        <label for="gebruikersnaam">Gebruikersnaam</label>
                        <input type="text" name="gebruikersnaam" id="gebruikersnaam" required>
                    </div>

                    <div class="inputField">
                        <label for="wachtwoord">Wachtwoord</label>
                        <input type="wachtwoord" name="wachtwoord" id="wachtwoord" required>
                    </div>

                    <div class="inputField">
                        <input type="submit" name="submit" value="Log nu in!">
                    </div>
                </form>
        </div>
    <?php } ?>
    </div>
</body>

</html>