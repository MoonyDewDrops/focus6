<?php
//checking if its a post 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pageValue'])) {
        //checking if it isn't empty
        $columnType = $_POST['columnType'];
        $rowPosition = $_POST['rowPosition'];
        $pageValue = $_POST['pageValue'];     


        $sql = "INSERT INTO paginagrid (rowPosition, columnType, pageValue) VALUES (?, ?, ?)";
        $insertqry = $con->prepare($sql);

        if ($insertqry === false) {
            echo mysqli_error($con);
        } else {
            $insertqry->bind_param('iii', $rowPosition, $columnType, $pageValue);
            if ($insertqry->execute()) {
                //if it succesfully adds the thing
                header("Location: editProcess?id=" . urlencode($pageValue));
            } else {
                //if it fails
                echo "Error adding row: " . $insertqry->error;
            }
        }
        $insertqry->close();
    } else {
        echo "Fill in id.";
    }
} else {
    echo "Fill in all required spaces.";
}

$con->close();
