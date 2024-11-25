<?php
//checking if its a post/get
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $_POST;
    var_dump($result);
    //setting the things as the posts so we acc got sum to work with   
    $id = $_GET['id'];
    $sql = "SELECT informatie FROM paginaInfo WHERE whichRow = ? AND colum = ?";
    $selectqry = $con->prepare($sql);
    $selectqry->bind_param('ii', $welkeRow, $hoeveelsteKolom);

    $sql2 = "UPDATE paginainfo SET informatie = ?, foto = ?, backgroundColor = ? WHERE whichRow = ? AND colum = ?";
    $updateqry2 = $con->prepare($sql2);
    if ($updateqry2 === false) {
        echo mysqli_error($con);
    }
    $updateqry2->bind_param('siiii', $informatie, $image, $backgroundColor, $welkeRow, $hoeveelsteKolom);

    echo "<br>______<br>";

    foreach ($result as $rows) {
        echo "<br><br>";
        var_dump($rows);
        echo "<br>+++<br>";
        if (is_array($rows)) {
            foreach ($rows as $columns) {
                echo "<br><br>";
                var_dump($columns);

                $kolomType = $columns['CT'];
                $hoeveelsteRow = $columns['ROW'];

                // if ($result[1][1]["IMG"] == 'no') {
                //     $informatie = $_POST['informatie'];
                // } else {
                //     $image = 1;
                // }

                $welkeRow = $columns['ROW'];
                $hoeveelsteKolom = $columns['COL'];
                $image = $columns['IMG'];
                $backgroundColor = $columns['BG'];



                if ($image == 'Yes') {
                    if (isset($_FILES[$welkeRow][$hoeveelsteKolom]['file']) && $_FILES[$welkeRow][$hoeveelsteKolom]['file']['error'] === UPLOAD_ERR_OK) {
                        $imageNaam = basename($_FILES[$welkeRow][$hoeveelsteKolom]['file']['name']);
                        $imageTempName = $_FILES[$welkeRow][$hoeveelsteKolom]['file']['tmp_name'];
                        $wantedDirectory = 'assets/img/fotos/';
                        $wantedPath = $wantedDirectory . $imageNaam;

                        $selectqry->execute();
                        $selectqry->bind_result($oudeInformatie);
                        $selectqry->fetch();

                        if (move_uploaded_file($imageTempName, to: $wantedPath)) {
                            if (file_exists($oudeInformatie) && strpos($oudeInformatie, $wantedDirectory) !== false) {
                                unlink($oudeInformatie);
                            }
                            $informatie = $wantedPath;
                        } else {
                            $informatie = $oudeInformatie;
                        }
                    } else if (!empty($columns['text'])) {
                        $informatie = $columns['text'];
                    } else {
                        $informatie = " ";
                    }
                } else {
                    $informatie = $columns['text'];
                }

                echo $informatie;
                echo "<br>";
                if ($image == 'Yes') {
                    $image = 1;
                } else {
                    $image = 0;
                }
                echo $image;
                echo "<br>";
                if ($backgroundColor == 'Yes') {
                    $backgroundColor = 1;
                } else {
                    $backgroundColor = 0;
                }
                echo $backgroundColor;
                echo "<br>";
                echo $welkeRow;
                echo "<br>";
                echo $hoeveelsteKolom;

                if ($updateqry2->execute()) {
                    // header("Location: editProcess?id=" . urlencode($id));
                    echo "gelukt";
                } else {
                    echo "Error updating recensie: " . $updateqry2->error;
                }

            }
        }

        echo "<br>+++<br>";
    }



    //sql command nog niet belangrijk
    $sql = "UPDATE paginagrid SET columnType = ? WHERE pageValue = ? AND rowPosition = ?";
    $updateqry = $con->prepare($sql);

    //if there aint a update querry, show an error 
    if ($updateqry === false) {
        echo mysqli_error($con);
    } else {
        //else it just updates
        $updateqry->bind_param('iii', $kolomType, $id, $hoeveelsteRow);
        if ($updateqry->execute()) {
            // header("Location: editProcess?id=" . urlencode($id));
        } else {
            echo "Error updating recensie: " . $updateqry->error;
        }
    }
    $updateqry->close();
    $selectqry->close();

    // Handle file upload if provided
  
//     if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//         $imageNaam = basename($_FILES['photo']['name']);
//         $imageTempName = $_FILES['photo']['tmp_name'];
//         $wantedDirectory = 'assets/fotos/';
//         $wantedPath = $wantedDirectory . $imageNaam;

//         if (move_uploaded_file($imageTempName, $wantedPath)) {
//             if (file_exists($oudeInformatie) && strpos($oudeInformatie, $wantedDirectory) !== false) {
//                 unlink($oudeInformatie);
//             }
//             $informatie = $wantedPath;
//         } else {
//             $informatie = $oudeInformatie;
//         }
//     } else if (!empty($_POST['informatie'])) {
//         $informatie = $_POST['informatie'];
//     } else {
//         $informatie = $oudeInformatie;
//     }





    //if there aint a update querry, show an error 

    //else it just updates



}

$con->close();



