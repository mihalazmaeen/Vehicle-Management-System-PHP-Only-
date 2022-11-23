<?php
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
require 'connection.php';
// ajax fair
$fair = '';
$query = "select fair from rent_chart where d_from= '" . $_POST['d_from'] . "' AND d_to= '" . $_POST['d_to'] . "' ";
$resultfair = mysqli_query($conn, $query);
// $fair .= '<option value="" disabled selected>-Select fair-</option>';
while ($row = mysqli_fetch_array($resultfair)) {
    // $fair .= '<option value"'.$row['fair'].'">'.$row['fair'].'</option>';
    $fair = $row['fair'];
    }
echo $fair;

?>