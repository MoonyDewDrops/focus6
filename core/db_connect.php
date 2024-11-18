<?php
include_once "core/db_credentials.php";
?>

<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


$dbhost = "localhost";
$dbname = "focus6";

$con = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}
