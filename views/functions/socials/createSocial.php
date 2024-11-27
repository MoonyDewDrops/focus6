<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //checking if it isn't empty
    $naam = $_POST['media'];
    $Link = $_POST['Link'];

    $bow1 = false;

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoName = $_FILES['photo']['name'];
        $photoTempName = $_FILES['photo']['tmp_name'];
        $photoSize = $_FILES['photo']['size'];

        $wantedDirectory = 'assets/img/fotos/';
        $wantedPath = $wantedDirectory . $photoName;

        if (move_uploaded_file($photoTempName, $wantedPath)) {
            $sql = "INSERT INTO socials (naam, link, image) VALUES (?, ?, ?)";
            $insertqry = $con->prepare($sql);
        
            if ($insertqry === false) {
                echo mysqli_error($con);
            } else {
                $insertqry->bind_param('sss', $naam, $Link, $wantedPath);
                if ($insertqry->execute()) {
                    //if it succesfully adds the thing\
                    $bow1 = true;
                    // header("Location: index.php");
                } else {
                    //if it fails
                    echo "Error adding social: " . $insertqry->error;
                }
            }
            $insertqry->close();
        } else {
            echo 'Upload image of social media.';
        }

        if ($bow1){
            header("Location: admin");
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Fill in all required spaces.";
}


$con->close();
