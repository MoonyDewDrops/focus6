<?php
//checking if its a post 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pageValue']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $columnType = (int)$_POST['columnType'];
        $rowPosition = $_POST['rowPosition'];
        $pageValue = $_POST['pageValue'];

        $sql = "INSERT INTO paginagrid (rowPosition, columnType, pageValue) VALUES (?, ?, ?)";
        $insertqry = $con->prepare($sql);

        if ($insertqry === false) {
            echo mysqli_error($con);
        } else {
            $insertqry->bind_param('iii', $rowPosition, $columnType, $pageValue);
            if ($insertqry->execute()) {
                header("Location: baseData?id=" . urlencode($id) . "&rowPosition=" . urlencode($rowPosition) . "&columnType=" . urlencode($columnType));
                exit;
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
