<?php
include 'connection.php';

$trip_id = $_GET["id"];
$sql =mysqli_query($conn, "SELECT gross_income from trip WHERE id=$trip_id");
$result = mysqli_fetch_assoc($sql);
$income = implode(" ", $result);
$sql2 =mysqli_query($conn, "SELECT driver_name from trip WHERE id=$trip_id");
$result1 = mysqli_fetch_assoc($sql2);
$driver_name= implode(" ", $result1);
if(isset($_POST["submit"])){
  $cost_type = mysqli_real_escape_string($conn, $_POST["cost_type"]);
  $amount = mysqli_real_escape_string($conn, $_POST['amount']);
  $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
  $total_cost = mysqli_real_escape_string($conn, $_POST['total_cost']);
  $m_type = mysqli_real_escape_string($conn, $_POST['m_type']);
  $m_amount = mysqli_real_escape_string($conn, $_POST['m_amount']);
  $m_quantity = mysqli_real_escape_string($conn, $_POST['m_quantity']);
  $m_total_cost = mysqli_real_escape_string($conn, $_POST['m_total_cost']);
  $commission = mysqli_real_escape_string($conn, $_POST['commission']);
  $net_income = $income - ($total_cost + $m_total_cost);
  $commission_amount = ($net_income * $commission) / 100;
 
  $final_amount = $net_income - $commission_amount;
 

  
  $result = mysqli_query($conn, "INSERT into road_cost VALUES ('','$trip_id','$cost_type','$amount','$quantity','$total_cost')" );
  $result1 = mysqli_query($conn,"INSERT into maintenance VALUES ('','$trip_id','$m_type','$m_amount','$m_quantity','$m_total_cost')" );
  $result2 = mysqli_query($conn,"INSERT into commission VALUES ('','$trip_id','$commission_amount','$driver_name')" );
  $result3 = mysqli_query($conn, "UPDATE trip SET net_income=$final_amount,road_cost=$total_cost,maintenance_cost=$m_total_cost,driver_commission=$commission_amount WHERE id=$trip_id");

}


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Costing Form</title>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />

    <script>
      $(document).ready(function(){
// FInd Total Income

    $("#find_total").click(function(){
    let amount=$('#amount').val();
    let quantity=$('#quantity').val();
    $.ajax({
      url:'totalcost.php',
      method:'POST',
      data:{amount:amount,quantity:quantity},
      success:function(data){
        // $('#fair').html(data);
        $('#total_cost').val(data);
      }
    });
    

  });
// Total Income Ends

// Find Total maintenance

$("#find_total_maintenance").click(function(){
    let amount=$('#m_amount').val();
    let quantity=$('#m_quantity').val();
    $.ajax({
      url:'totalmaintenancecost.php',
      method:'POST',
      data:{amount:amount,quantity:quantity},
      success:function(data){
        // $('#fair').html(data);
        $('#m_total_cost').val(data);
      }
    });
    

  });


// Maintenance Ends Here

// show find total

  $("#find_total").click(function () {
     $("#total_cost").toggle();
  });

  $("#find_total_maintenance").click(function () {
     $("#m_total_cost").toggle();
  });



// end

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
        <form method="post" action="" class="submit-form">
         <div class="cost text-center bg-info">
          <h3>Road Costing</h3>
         </div>
          <div class="col-md-12 d-flex">
          <div class="form-froup col-md-3">
              <label for="Type">Costing Type</label>
              <input type="text" id="cost_type" name="cost_type">
            </div>
            <div class="form-froup col-md-3">
              <label for="Type">Amount</label>
              <input type="number" id="amount" name="amount">
            </div>
            <div class="form-froup col-md-3" >
              <label for="Type">Quantity</label>
              <input type="number" id="quantity" name="quantity">
            </div>
            
            <div class="form-froup col-md-3 total_cost">
              <label for="Type">total cost</label>
              <input type="text" id="total_cost" name="total_cost" style="display: none;">
            </div>
            

          </div> 
          <div class="check text-center">
          <input
            type="button"
            class="submit-btn"
            value="Find Total"
            name="find_total"
            id="find_total"
          
          />
          </div>
          <div class="maintenance text-center bg-info" style="margin-top: 5px;">
          <h3>Maintenance Cost</h3>
         </div>
          <div class="col-md-12 d-flex">
          <div class="form-froup col-md-3">
              <label for="Type">Maintenance Type</label>
              <input type="text" id="type" name="m_type">
            </div>
            <div class="form-froup col-md-3">
              <label for="Type">Amount</label>
              <input type="number" id="m_amount" name="m_amount">
            </div>
            <div class="form-froup col-md-3" >
              <label for="Type">Quantity</label>
              <input type="number" id="m_quantity" name="m_quantity">
            </div>
            <div class="form-froup col-md-3 total_cost">
              <label for="Type">total cost</label>
              <input type="text" id="m_total_cost" name="m_total_cost" style="display: none;">
            </div>

          </div> 
          <div class="check text-center">
          <input
            type="button"
            class="submit-btn"
            value="Total maintenance"
            name="find_total_maintenance"
            id="find_total_maintenance"
          />
          </div>
          <div class="Commiossion text-center bg-info" style="margin-top: 5px;">
          <h3>Driver Commission</h3>
         </div>
          <div class="col-md-12 d-flex">
          <div class="form-froup col-md-6">
              <label for>Driver Name</label>
             <input type="text" value="<?php echo $driver_name; ?>" readonly>
            </div>
            <div class="form-froup col-md-6">
              <label for="Type">Commiossion Rate</label>
              <input type="number" id="commission" name="commission">
            </div>
          

          </div> 
          <!-- <div class="check text-center">
          <input
            type="button"
            class="submit-btn"
            value="Total maintenance"
            name="find_total_maintenance"
            id="find_total_maintenance"
          />
          </div> -->
           

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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    >
</script>

  </body>
</html>
