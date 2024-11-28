<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= 'assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/login.css' ?>">
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
                        header("Location: ?view=admin");
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

                    <div class="inputField">
                        <label for="gebruikersnaam">Gebruikersnaam</label>
                        <input type="text" name="gebruikersnaam" id="gebruikersnaam" required>
                    </div>

                    <div class="inputField">
                        <label for="wachtwoord">Wachtwoord</label>
                        <input type="wachtwoord" name="wachtwoord" id="wachtwoord" required>
                    </div>

                    <div class="inputField">
                        <input type="submit" name="submit" value="Inloggen">
                    </div>


                    <div class="link">
                        Heb je nog niet een account? <a href="?view=registreren">Registreer jezelf hier!</a>
                    </div>
                </form>
        </div>
    <?php } ?>
    </div>
</body>

</html>