<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Verkrijg en trim  (/) de formuliergegevens
    $naam = testInput($_POST['naam']);
    $email = testInput($_POST['email']);
    $bericht = testInput($_POST['bericht']);
    $captcha = isset($_POST['captcha']) ? (int) testInput($_POST['captcha']) : null;

    // Controleer de captcha
    if (!isset($_SESSION['captcha_answer']) || $captcha !== $_SESSION['captcha_answer']) {
        $errors['captcha'] = "De rekenvraag is onjuist.";
    }

    // Foutmeldingen array
    $errors = [];
    
    // Server-side validatie
    if (empty($naam)) {
        $errors['naam'] = "Naam is verplicht";
    }
    if (empty($email)) {
        $errors['email'] = "Email is verplicht";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Voer een geldig e-mailadres in.";
    }
    if (empty($bericht)) {
        $errors['bericht'] = "Bericht is verplicht";
    } elseif (strlen($bericht) < 10) {
        $errors['bericht'] = "Bericht moet minimaal 10 tekens bevatten.";
    }

    // Verwerk formulier als er geen fouten zijn
    if (empty($errors)) {
        // Geheime sleutel en encryptie methode
        $encryptionKey = "If6q[n93WDc',c>(!EIsRc/_lnrCz&l*"; // Gebruik een veilige sleutel
        $cipherMethod = "aes-256-cbc"; // Encryptiemethode

        // Versleutel de naam, email en bericht
        $encryptedNaam = openssl_encrypt($naam, $cipherMethod, $encryptionKey, 0);
        $encryptedEmail = openssl_encrypt($email, $cipherMethod, $encryptionKey, 0);
        $encryptedBericht = openssl_encrypt($bericht, $cipherMethod, $encryptionKey, 0);

        // Databaseconnectie 
        // $con = new mysqli('localhost', 'root', 'root', 'focus6');
        // if ($con->connect_error) {
        //     die("Verbinding mislukt: " . $con->connect_error);
        // }

        // prepared statement om gegevens veilig in de database op te slaan
        $stmt = $con->prepare("INSERT INTO contactinfo (naam, email, bericht) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $encryptedNaam, $encryptedEmail, $encryptedBericht);
            if ($stmt->execute()) {
                header('Location: contact');
                echo "<h1>Bedankt!</h1><h3>We nemen zo snel mogelijk contact met u op</h3>";
            } else {
                echo "<p style='color: red;'>Er is een fout opgetreden tijdens het verzenden van het formulier.</p>";
            }
        } else {    
            echo "<p style='color: red;'>Fout in prepared statement: " . $con->error . "</p>";
        }
    } else {
        // Sla de foutmeldingen op in de sessie en verwijs terug naar de formulierpagina
        $_SESSION['errors'] = $errors;
        header('Location:  ?view=contact&message=sent');
        exit; 
    }
}
?>
