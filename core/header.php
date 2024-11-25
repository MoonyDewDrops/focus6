<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus6</title>
    <link rel="stylesheet" href="<?= 'assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/header.css' ?>">
    <link rel="stylesheet" href="<?= 'assets/css/footer.css' ?>">
    <?php
    if ($style != '') {
    ?>
        <link rel="stylesheet" href="<?= 'assets/css/' . $style ?>">
    <?php
    }
    ?>
    <script src="<?= 'assets/js/app.js' ?>" defer></script>
    <?php
    if ($js != '') {
    ?>
        <script src="<?= 'assets/js/' . $js ?>" defer></script>
    <?php
    }
    ?>
</head>

<body>
    <header class="header">
        <a class="logo" href="">
            <img class="logo-img" src="assets/images/logo.svg" alt="focus 6 logo">
        </a>

        <nav class="header-links">
            <a class="header-link" href="">Spiegelconcept</a>
            <a class="header-link" href="">Dienstverlening</a>
            <a class="header-link" href="">Contact</a>
        </nav>
    </header>

</body>