<?php
$conn = new mysqli("localhost", "root", "", "vms");
if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

?>