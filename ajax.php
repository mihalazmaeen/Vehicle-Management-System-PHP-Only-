<?php
require 'connection.php';
// ajax driver name
$output = '';
$sql = "select * from driver where car_id='".$_POST['id']."' ";
$result = mysqli_query($conn, $sql);
$output .= '<option value="" disabled selected>-Select Driver-</option>';
while ($row = mysqli_fetch_array($result)) {
$output .= '<option value"'.$row['d_id'].'">'.$row['driver_name'].'</option>';
}
echo $output;



?>