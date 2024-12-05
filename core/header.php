<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus6</title>
    <link rel="icon" type="image/x-icon" href="assets/images/image1.png">
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
    <?php
    $headsql = "SELECT id, paginaNaam FROM paginas";
    $headstmt = $con->prepare($headsql);
    $headstmt->bind_result($paginaId, $paginaNaam);
    ?>
    <header class="header container">
        <div class="header-content">
            <a class="logo" href="?view">
                <img class="logo-img" src="assets/images/logo.png" alt="focus 6 logo">
            </a>

            <nav class="header-links">
                <?php
                if ($headstmt->execute()) {
                    while ($headstmt->fetch()) {
                        if ($paginaNaam != 'Home') {
                        ?>
                        <a class="header-link" href="?view=pages&id=<?= $paginaId ?>"><?= $paginaNaam ?></a>
                <?php
                        }
                    }
                }
                $headstmt->close();
                ?>
                <a class="header-link" href="?view=contact">Contact</a>
            </nav>
        </div>

    </header>

