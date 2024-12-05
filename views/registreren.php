<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= 'assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/'. $style ?>">
    <title>Gebruikersgegevens Bijwerken</title>
</head>
<body>
    <div class="container">
        <div class="loginForm">

        <?php
        $user_id = 1;
        $sqlFetch = mysqli_prepare($con, "SELECT gebruikersnaam FROM logininfo WHERE id = ?");
        mysqli_stmt_bind_param($sqlFetch, 'i', $user_id);
        mysqli_stmt_execute($sqlFetch);
        mysqli_stmt_bind_result($sqlFetch, $existing_gebruikersnaam);
        mysqli_stmt_fetch($sqlFetch);
        mysqli_stmt_close($sqlFetch);

        if (isset($_POST['submit'])) {
            $gebruikersnaam = !empty($_POST['gebruikersnaam']) ? $_POST['gebruikersnaam'] : $existing_gebruikersnaam;
            $wachtwoord = !empty($_POST['wachtwoord']) ? password_hash($_POST['wachtwoord'], PASSWORD_BCRYPT) : null;

            if ($wachtwoord) {
                $sqlUpdate = mysqli_prepare($con, "UPDATE logininfo SET gebruikersnaam = ?, wachtwoord = ? WHERE id = ?");
                mysqli_stmt_bind_param($sqlUpdate, 'ssi', $gebruikersnaam, $wachtwoord, $user_id);
            } else {
                $sqlUpdate = mysqli_prepare($con, "UPDATE logininfo SET gebruikersnaam = ? WHERE id = ?");
                mysqli_stmt_bind_param($sqlUpdate, 'si', $gebruikersnaam, $user_id);
            }

            if (mysqli_stmt_execute($sqlUpdate)) {
                ?>
                <div class="pop-up">
                    <p>Gebruikersgegevens zijn succesvol bijgewerkt!</p>
                    <p>Klik <a href="admin">hier</a> om terug te gaan naar admin!</p>
                </div>
                <?php
            } else {
                ?>
                <div class="pop-up">
                    <p>Er is een fout opgetreden bij het bijwerken van de gegevens.</p>
                </div>
                <?php
            }
            mysqli_stmt_close($sqlUpdate);
        }
        ?>

        <form action="" method="post">
            <header>Bijwerken</header>
            <br>

                <div class="inputField">
                    <label for="gebruikersnaam">Gebruikersnaam</label>
                    <input type="text" name="gebruikersnaam" id="gebruikersnaam" placeholder="<?= htmlspecialchars($existing_gebruikersnaam) ?>">
                </div>

                <div class="inputField">
                    <label for="wachtwoord">Wachtwoord</label>
                 <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Laat leeg om wachtwoord te behouden">
                </div>
                <br>
                <div class="inputField">
                    <input type="submit" name="submit" value="Bijwerken">
                </div>
            </form>
        </div>
    </div>
</body>
</html>