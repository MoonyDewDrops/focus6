<?php
//checking if its a post 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //checking if it isn't empty
    $naam = $_POST['naam'];
    $sql = "INSERT INTO paginas (paginaNaam) VALUES (?)";
    $insertqry = $con->prepare($sql);

    if ($insertqry === false) {
        echo mysqli_error($con);
    } else {
        $insertqry->bind_param('s', $naam);
        if ($insertqry->execute()) {
            //if it succesfully adds the thing
            header("Location: admin");
        } else {
            //if it fails
            echo "Error bij pagina toevoegen: " . $insertqry->error;
        }
    }
    $insertqry->close();
} else {
    echo "Vul alles in.";
}


$con->close();
