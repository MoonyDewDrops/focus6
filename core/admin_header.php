<?php
if (isset($_SESSION['gebruikersnaam'])) {
?>    
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= 'assets/css/style.css' ?>">
        <link rel="stylesheet" href="<?= 'assets/css/admin_header.css' ?>">
        <?php
        if ($style !== '') {
            ?>
            <link rel="stylesheet" href="<?= 'assets/css/' . $style ?>">
        <?php
        }
        ?>
        <title>CMS</title>
    </head>

    <body>
        <header>
            <img src="https://placeholder.co/200x100"></img>
            <p>Welkom <?= $_SESSION['gebruikersnaam']; ?></p>
            <div class="adminlink">
                <a href="admin#paginas">Paginas</a>
                <a href="admin#socials">Socials</a>
                <a href="admin#contactberichten">Berichten</a>
                <a href="changeLoginInfo">Account informatie veranderen?</a>
            </div>
        </header>
<?php 
} else if (!isset($_SESSION['gebruikersnaam'])) {
    header("Location: ?view=login");
}
?>