<?php
//checking if its a post/get
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //setting the things as the posts so we acc got sum to work with   
    $id = $_GET['id'];
    $kolomType = $_POST['columnType'];
    $hoeveelsteRow = $_POST['welkeRow'];

    $informatie = $_POST['informatie'];
    $welkeRow = $_POST['welkeRow'];
    $hoeveelsteKolom = 1;
    $image = 0;
    $backgroundColor =  0;

    //sql command 
    $sql = "UPDATE paginagrid SET columnType = ? WHERE pageValue = ? AND rowPosition = ?";
    $updateqry = $con->prepare($sql);

    //if there aint a update querry, show an error 
    if ($updateqry === false) {
        echo mysqli_error($con);
    } else {
        //else it just updates
        $updateqry->bind_param('iii', $kolomType, $id, $hoeveelsteRow);
        if ($updateqry->execute()) {
            header("Location: editProcess?id=" . urlencode($id));
        } else {
            echo "Error updating recensie: " . $updateqry->error;
        }
    }

    $updateqry->close();

    $id = $_GET['id'];
    $sql = "SELECT informatie FROM paginaInfo WHERE whichRow = ? AND colum = ?";

    $selectqry = $con->prepare($sql);
    $selectqry->bind_param('ii', $welkeRow, $hoeveelsteKolom);
    $selectqry->execute();
    $selectqry->bind_result($oudeInformatie);
    $selectqry->fetch();
    $selectqry->close();

    // Handle file upload if provided
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $imageNaam = basename($_FILES['photo']['name']);
        $imageTempName = $_FILES['photo']['tmp_name'];
        $wantedDirectory = 'assets/fotos/';
        $wantedPath = $wantedDirectory . $imageNaam;

        if (move_uploaded_file($imageTempName, $wantedPath)) {
            if (file_exists($oudeInformatie) && strpos($oudeInformatie, $wantedDirectory) !== false) {
                unlink($oudeInformatie);
            }
            $informatie = $wantedPath;
        } else {
            $informatie = $oudeInformatie;
        }
    } else if (!empty($_POST['informatie'])) {
        $informatie = $_POST['informatie'];
    } else {
        $informatie = $oudeInformatie;
    }

    $sql2 = "UPDATE paginainfo SET informatie = ?, foto = ?, backgroundColor = ? WHERE whichRow = ? AND colum = ?";
    $updateqry2 = $con->prepare($sql2);
    //if there aint a update querry, show an error 
    if ($updateqry2 === false) {
        echo mysqli_error($con);
    } else {
        //else it just updates
        $updateqry2->bind_param('siiii', $informatie, $image, $backgroundColor, $welkeRow, $hoeveelsteKolom);
        if ($updateqry2->execute()) {
            header("Location: editProcess?id=" . urlencode($id));
        } else {
            echo "Error updating recensie: " . $updateqry2->error;
        }
    }
}

$con->close();
