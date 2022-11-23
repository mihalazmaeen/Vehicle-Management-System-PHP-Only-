<?php
include 'connection.php';


?>

<!DOCTYPE html>
<html>
  <head>
    <title>VMS form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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

    <script type="text/javascript">

$(document).ready(function(){
  // choose Driver Name
  $("#car_number").change(function(){
    let driver=$(this).val();
    $.ajax({
      url:'ajax.php',
      method:'POST',
      data:{id:driver},
      success:function(data){
        $('#driver_name').html(data);
      }
    });


  });
  //Driver Name Ends

  //Choose fair
  $("#button").click(function(){
    let d_from=$('#destination_from').val();
    let d_to=$('#destination_to').val();
    $.ajax({
      url:'fair.php',
      method:'POST',
      data:{d_from:d_from,d_to:d_to},
      success:function(data){
        // $('#fair').html(data);
        $('#fair').val(data);
      }
    });
    

  });

 



}); 


</script>

 
 
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
        <div class="title text-center bg-info">
            <h1>Trip Details</h1>
        </div>
      <div class="first">
      <table class="table table-striped">
  <thead>
    <tr>
                  <th>Trip Date</th>
                  <th>Car_number</th>
                  <th>Driver_name</th>
                  <th>Gross Income</th>
                  <th>Net Income</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Costing</th>
    </tr>           
  </thead>
  <tbody>
    <?php
         $sql=mysqli_query($conn, "select * from trip");
         while($row=mysqli_fetch_array($sql)){
            ?>
            <tr>
            <td> <?php echo $row["trip_date"];?></td>
            <td> <?php echo $row["car_number"];?></td>
            <td> <?php echo $row["driver_name"];?></td>
            <td> <?php echo $row["gross_income"];?></td>
            <td> <?php echo $row["net_income"];?></td>
            <td class="center"> <a href="edit_trip.php?id=<?php echo $row["id"];?>">Edit</td>
            <td class="center"> <a href="delete_trip.php?id=<?php echo $row["id"];?>">Delete</td>
            <td class="center costing"> <a href="modal.php?id=<?php echo $row["id"];?>">Costing</td>
        </tr>
            <?php
         }
?>
   
  </tbody>
</table>
    </div>
   </div>
   </div>
  
  </body>
</html>
