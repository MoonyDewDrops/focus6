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

    // Als er geen fouten zijn, voer dan de gegevens in de database in
    if (empty($errors)) {
        // Gebruik een prepared statement om gegevens veilig in de database in te voegen
        $stmt = $con->prepare("INSERT INTO contactinfo (naam, email, bericht) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $naam, $email, $bericht);
            if ($stmt->execute()) {
                echo "Formulier succesvol verzonden!";
            } else {
                echo "Er is een fout opgetreden tijdens het verzenden van het formulier.";
            }
            $stmt->close();  // Sluit de statement
        } else {
            echo "Fout in prepared statement: " . $con->error;
        }
    } else {
        // Sla de foutmeldingen op in de sessie en redirect naar de formulierpagina
        $_SESSION['errors'] = $errors;
        header('Location: contact.php');
        exit;  // Stop verdere uitvoering
    }
}


// Sluit de databaseverbinding
$con->close();
?>
<h1>Bedankt!</h1>
<h3>We nemen zo snel mogelijk contact met u op</h3>
  