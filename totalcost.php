<?php
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
require 'connection.php';

$amount = $_POST['amount'];
$quantity = $_POST['quantity'];
$total_cost = $amount * $quantity;
echo $total_cost;






?>