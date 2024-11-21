<?php
$naam = $_POST['naam'];
$email = $_POST['email'];
$bericht = $_POST['bericht'];


<!-- database connecten  -->
 $conn = new mysqli('localhost', 'root', 'root', 'focus6');
 if($conn->connect_error){
    die('Connection Failed : ' .$conn->connect_error);
 }
 ?>