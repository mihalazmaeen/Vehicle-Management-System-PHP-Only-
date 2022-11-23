<?php
include 'connection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"
      rel="stylesheet"
    />

  
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
  
  <style rel="stylesheet">
    .tg  {border-collapse:collapse;border-color:#9ABAD9;border-spacing:0;}
.tg td{background-color:#EBF5FF;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#444;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#409cff;border-color:#9ABAD9;border-style:solid;border-width:1px;color:#fff;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:5px;word-break:normal;}
.tg .tg-phtq{background-color:#D2E4FC;border-color:inherit;text-align:left;vertical-align:top;text-align: center;}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top;padding:25px;text-align: center;}
  </style>
</head>
<body>
    <!-- Nvabar Bootstrap -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-info">
          <a class="navbar-brand" href="#"
            ><img src="./logo.png" class="logo" alt=""
          /></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php"
                  >ADD Form <span class="sr-only"></span></a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="report.php">Report</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="showdetails.php">Show details</a>
              </li>
              
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
   <div class="main">
<div class="container">
    <div class="show_details text-center bg-info">
        <h1>Full Details</h1>
    </div>

    <?php
$sql = mysqli_query($conn, "SELECT trip.id as trip_table_id,trip.today_date,trip.trip_date,trip.car_number,trip.driver_name,trip_infos.id as trip_info_id,trip_infos.trip_id,trip_infos.destination_from,trip_infos.destination_to from trip,trip_infos WHERE trip.id=trip_infos.trip_id");


$trip_sql  =  mysqli_query($conn, "SELECT * from  trip");
$trip_array = array();

foreach ($trip_sql as $key => $value) {
  $trip_array[$value['id']]['id'] = $value['id'];
  $trip_array[$value['id']]['today_date'] = $value['today_date'];
  $trip_array[$value['id']]['trip_date'] = $value['trip_date'];
  $trip_array[$value['id']]['driver_name'] = $value['driver_name'];
  $trip_array[$value['id']]['car_number'] = $value['car_number'];
  $trip_array[$value['id']]['gross_income'] = $value['gross_income'];
  $trip_array[$value['id']]['net_income'] = $value['net_income'];
  $trip_array[$value['id']]['road_cost'] = $value['road_cost'];
  $trip_array[$value['id']]['maintenance_cost'] = $value['maintenance_cost'];
  $trip_array[$value['id']]['driver_commission'] = $value['driver_commission'];
}


$data_array = array();



foreach ($sql as $key => $value) {

  $data_array[$value['trip_table_id']][$key]['destination_from'] = $value['destination_from'];
  $data_array[$value['trip_table_id']][$key]['destination_to'] = $value['destination_to'];
}





 ?>  


    
  
<table class="tg">
<tbody>
  <tr>
    <td class="tg-phtq">Trip Date</td>
    <td class="tg-phtq">Car Number</td>
    <td class="tg-phtq">Driver Name</td>
    <td class="tg-phtq">Gross Income</td>
    <td class="tg-phtq">Road Cost</td>
    <td class="tg-phtq">Maintenance Cost</td>
    <td class="tg-phtq">Driver Commission</td>
    <td class="tg-phtq">Net Income</td>
    <td class="tg-phtq">Trip From</td>
    <td class="tg-phtq">Trip To</td>
  </tr>
 

  <?php

$i = 0;
  foreach ($data_array as $key => $value) {
  $i++;
  foreach ($value as $k => $row) {

?>
  <tr>
   
  <?php if($i>0){    $i=0?>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['trip_date'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['car_number'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['driver_name'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['gross_income'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['road_cost'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['maintenance_cost'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['driver_commission'] ?></td>
  <td rowspan="<?php echo count($value)   ?>"><?php echo $trip_array[$key]['net_income'] ?></td>

<?php } ?>

    <td class="tg-0pky" rowspan=""><?php echo $row['destination_from']; ?></td>
    <td class="tg-0pky" rowspan=""><?php echo $row['destination_to']; ?></td>

  </tr>

<?php
  }}?>

</tbody>
</table>
</div>
</div>
</body>
</html>