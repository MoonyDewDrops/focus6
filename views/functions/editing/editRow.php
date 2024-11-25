<?php
//checking if its a post/get
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $_POST;
    var_dump($result);
    //setting the things as the posts so we acc got sum to work with   
    $id = $_GET['id'];
    $sql = "SELECT id, informatie FROM paginaInfo WHERE whichRow = ? AND colum = ?";
    $selectqry = $con->prepare($sql);
    $selectqry->bind_param('ii', $welkeRow, $hoeveelsteKolom);

    $sql2 = "UPDATE paginainfo SET informatie = ?, foto = ?, backgroundColor = ? WHERE whichRow = ? AND colum = ?";
    $updateqry2 = $con->prepare($sql2);
    $updateqry2->bind_param('siiii', $informatie, $image, $backgroundColor, $welkeRow, $hoeveelsteKolom);
    if ($updateqry2 === false) {
        echo mysqli_error($con);
    }

    foreach ($result as $rows) {
        if (is_array($rows)) {
            foreach ($rows as $columns) {
                $kolomType = $columns['CT'];
                $hoeveelsteRow = $columns['ROW'];

                $welkeRow = $columns['ROW'];
                $hoeveelsteKolom = $columns['COL'];
                $image = $columns['IMG'];
                $backgroundColor = $columns['BG'];

                if ($image == 'Yes') {
                    $selectqry->execute();
                    $selectqry->bind_result($col_ID, $oudeInformatie);
                    $selectqry->fetch();

                    if (isset($_FILES[$col_ID])) {
                        if ($_FILES[$col_ID]['error'] === UPLOAD_ERR_OK) {
                            if ($_FILES == null) {
                                $informatie = $oudeInformatie;
                            } else {
                                $imageNaam = basename($_FILES[$col_ID]['name']);
                                $imageTempName = $_FILES[$col_ID]['tmp_name'];
                                $wantedDirectory = 'assets/img/fotos/';
                                $wantedPath = $wantedDirectory . $imageNaam;

                                if (move_uploaded_file($imageTempName, to: $wantedPath)) {
                                    if (file_exists($oudeInformatie) && strpos($oudeInformatie, $wantedDirectory) !== false) {
                                        unlink($oudeInformatie);
                                    }
                                    $informatie = $imageNaam;
                                } else {

                                    $informatie = $oudeInformatie;
                                }
                            }
                        } else if (!empty($columns['text'])) {
                            $informatie = $columns['text'];
                        } else {
                            $informatie = " ";
                        }
                    }
                } else {
                    $informatie = $columns['text'];
                }
                $selectqry->free_result();

                if ($image == 'Yes') {
                    $image = 1;
                } else {
                    $image = 0;
                }

                if ($backgroundColor == 'Yes') {
                    $backgroundColor = 1;
                } else {
                    $backgroundColor = 0;
                }

                if ($updateqry2->execute()) {
                    // header("Location: editProcess?id=" . urlencode($id));
                } else {
                    echo "Error updating recensie: " . $updateqry2->error;
                }

            }
        }
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
            header("Location: editProcess?id=" . urlencode($id));
        } else {
            echo "Error updating recensie: " . $updateqry->error;
        }
    }
    $updateqry->close();
    $updateqry2->close();
    $selectqry->close();
}

$con->close();



