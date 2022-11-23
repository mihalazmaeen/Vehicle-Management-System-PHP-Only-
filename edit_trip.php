<?php
include 'connection.php';

 $id=$_GET["id"];
echo $id;
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="script.js"></script>

    <script type="text/javascript">

$(document).ready(function(){


  $("#formTwoContainer").on('input', '.fair', function () { 
  let total_sum = 0;
  $("#formTwoContainer .fair").each(function () { 
    let alldata = $(this).val();
    if ($.isNumeric(alldata)) {
      total_sum += parseFloat(alldata);

    }
  });
  $("#final_fair").val(total_sum);
  });


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
      <div class="first">
        <div class="row">
            <form action="" method="POST">
              <div class="heading bg-info text-center">
                <h1>Enter Trip Details</h1>
              </div>
                <div class="form-group">
                    <label>Trip date</label>
                    <input type="date" name="trip_date" id="trip_date" placeholder="Enter Date">
                </div> 
                <!-- <div class="form-group">
                    <label>Trip ID</label>
                    <input type="text" name="trip_id" id="trip_id" placeholder="Enter ID">
                </div>  -->
                <div class="form-group">
                    <label>Select Vehicle</label>
                    <select name="car_number" id="car_number"class="car_number">
                      <option>Select Car </option>
                    <?php
$sql = mysqli_query($conn, "select * from car");
while($row=mysqli_fetch_array($sql)){
?> <option value="<?=$row['id'];?>"> <?=$row['car_name'];?> </option>
<?php
}
?>
                    </select>

                    
                </div> 

              <div class="form-group">
                <label for="driver_name"> Driver Name</label>
                <select class="driver_name" id="driver_name" name="driver_name">
                  <option value="" disabled selected>-Select Driver-</option>
                </select>
              </div>
              <!-- <div class="formTwoContainer" class="span6" id="formTwoContainer">
            <div class="rowsToAdd" id="rowsToAdd">
            <div class="form-group">
              <label class="control-label">Destination From :</label>
              <div class="controls">
                <input
                  type="text"
                  class="span11"
                  id="destination_from"
                  name="destination_from[]"
                  placeholder="starting point"
                  value=""
                />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Destination To :</label>
              <div class="controls">
                <input
                  type="text"
                  class="span11"
                  id="destination_to"
                  name="destination_to[]"
                  placeholder="Endpoint"
                  value=""
                
                />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label">Enter Fair :</label>
              <div class="controls" >
                <input
                  type="number"
                  class="fair"
                  name="fair"
                  id="fair"
                  placeholder="fair"
                  value=""
                  
                 

                
                />
        
              </div>
            </div>
            <input type="button"  class="addButtonTwo" value="+" onclick="addRow()" />
            
          </div>
          <div id="rowsToAdd">
            

          </div>
              </div>
              <div class="form-group">
            <label class="control-label">Total Fair :</label>
            <div class="controls">
              <input
                type="text"
                class="span11"
                name="final_fair"
                id="final_fair"
                placeholder=""
                readonly
                value=""
              />
            </div>
          </div> -->
          </div>
         
              <input
            type="submit"
            class="submit-btn"
            value="submit"
            name="submit"
            id="submit"
          />
            </form>
      </div>
    </div>
   </div>
   </div>
  </body>
  
</html>
  
<?php
if(isset($_POST["submit"])){
$id=$_GET["id"];

$trip_date = mysqli_real_escape_string($conn,$_POST['trip_date']);
$get_car_number_id = mysqli_real_escape_string($conn,$_POST['car_number']);
$sql = mysqli_query($conn, "select car_number from car where id=$get_car_number_id");
$test_array = array();

foreach($sql as $row)
{
    $test_array['number'] = $row['car_number'];
  
}

$car_number = implode(" ", $test_array);

// print_r($test_array);
// echo $car_number;
$driver_name = mysqli_real_escape_string($conn,$_POST['driver_name']);
// $gross_income = mysqli_real_escape_string($conn,$_POST['final_fair']);

$query = "UPDATE trip SET today_date=CURRENT_TIMESTAMP,trip_date='{$trip_date}',car_number='{$car_number}',driver_name='{$driver_name}' WHERE id=$id ";
$result= mysqli_query($conn, $query);


if($result){




    echo "Success";

}
else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// // echo $trip_id;



// $trip_from = $_POST['destination_from'];
// $trip_to = $_POST['destination_to'];
// $income = $_POST['fair'];


// print_r($trip_from);



// foreach($trip_from as $key=>$value) 
// {

//     // echo $trip_to[$key];

//     $destination_from[$key] = $value;
//     $destination_to[$key] =  $trip_to[$key];
//     echo $$destination_from[$key];
    
 

// // $query = "UPDATE trip_infos SET destination_from='{$destination_from[$key]}',destination_to='{$destination_to[$key]}' WHERE trip_id=$id";
// // $result= mysqli_query($conn, $query);

// if($result){
//     echo "Success";
// }
// else{
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// }



}

?>