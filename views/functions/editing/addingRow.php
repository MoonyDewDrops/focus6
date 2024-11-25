<?php
//checking if its a post 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pageValue']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $question1 = false;
        $question2 = false;
        //checking if it isn't empty
        $columnType = (int)$_POST['columnType'];
        $rowPosition = $_POST['rowPosition'];
        $pageValue = $_POST['pageValue'];

        $informatie = 'Edit de kolom en zet hier iets leuks neer!';
        $whichRow = $rowPosition;
        $colum = 0;
        if ($columnType === 1){
            $colum = 1;
        } else if ($columnType === 2 || $columnType === 3) {
            $colum = 2;
        } else if ($columnType === 4) {
            $colum = 3;
        }

        $foto = 0;
        $backgroundColor = 0;

        $sql = "INSERT INTO paginagrid (rowPosition, columnType, pageValue) VALUES (?, ?, ?)";
        $insertqry = $con->prepare($sql);

        if ($insertqry === false) {
            echo mysqli_error($con);
        } else {
            $insertqry->bind_param('iii', $rowPosition, $columnType, $pageValue);
            if ($insertqry->execute()) {
                //if it succesfully adds the thing
                $question1 = true; //this 1 works
            } else {
                //if it fails
                echo "Error adding row: " . $insertqry->error;
            }
        }
        $insertqry->close();


        for ($i = 1; $i < $colum + 1; $i++) {
            $sql2 = "INSERT INTO paginainfo (informatie, whichRow, colum, foto, backgroundColor) VALUES (?, ?, ?, ?, ?)";
            $insertqry2 = $con->prepare($sql2);

            if ($insertqry2 === false) {
                echo mysqli_error($con);
            } else {
                $insertqry2->bind_param('siiii', $informatie, $whichRow, $i, $foto, $backgroundColor);
                if ($insertqry2->execute()) {
                    //if it succesfully adds the thing
                    $question2 = true;
                } else {
                    //if it fails
                    echo "Error adding row: " . $insertqry2->error;
                }
            }
            $insertqry2->close();
        }
        if ($question1 && $question2){
            header("Location: editProcess?id=" . $id);     
        }
    } else {
        echo "Fill in id.";
    }
} else {
    echo "Fill in all required spaces.";
}

$con->close();
