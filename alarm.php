<!DOCTYPE html>
<?php 
session_start();
 if ($_SESSION["loggedin"]==FALSE) {
 header("Location: index.php");
}
 ?>

<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SET ALARM</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
      <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
  .table, th, td {
    border: 4px solid black;

    margin 3%;
    text-align: center;
    padding-left: 30px;

}
.content{
    min-height: 78vh;
}
.loginform{
  padding:10%;
}

#username{
  padding-left: 80%;
  color: blue;
}
footer{
  color: white;
  text-align: center;
}
input{
  width: 70%;

}
#submit{
  text-align: center;
}
.cont{
  text-align: center;

}
 </style>

  </head>

  <body>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php" >SCHOOL BELL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            
            
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <section class="py-5">
     
      <div class="container">
        <div class="content">
            <?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["hour1"])) {
    $timeErr="This field is required";
    
  } else {
    $hour1 = test_input($_POST["hour1"]);
  }

   if (empty($_POST["minute1"])) {
   $timeErr="This field is required";
  
  } else {
    $minute1 = test_input($_POST["minute1"]);
  }
   if (empty($_POST["hour2"])) {
   $timeErr="This field is required";
    
  } else {
    $hour2 = test_input($_POST["hour2"]);
  }
   if (empty($_POST["minute2"])) {
   $timeErr="This field is required";
    } 
    else {
    $minute2 = test_input($_POST["minute2"]);
  }
 
  if (empty($_POST["impormptu2"])) {
  $Err="This field is required";
    
    
  } else {
    $impormptu2 = test_input($_POST["impormptu2"]);
    
  }
 
   if (empty($_POST["impormptu1"])) {
   $Err="This field is required";
   
    
  } else {
    $impormptu1 = test_input($_POST["impormptu1"]);
    
  }
    if (empty($_POST["programmed2"])) {
    $Err="This field is required";
     
    
  } else {
    $programmed2 = test_input($_POST["programmed2"]);
   
  }
 
   if (empty($_POST["programmed1"])) {
   $Err="This field is required";
   
    
  } else {
    $programmed1 = test_input($_POST["programmed1"]);

  }

  if(isset($_POST["impromptu1"])){
  $alarm_type1=$_POST["impromptu1"];
}
else{
$alarm_type1=$_POST["programmed1"];
  
}
  if(isset($_POST["impromptu2"])){
  $alarm_type2=$_POST["impromptu2"];
}
else{
$alarm_type2=$_POST["programmed2"];
  
}

if (empty($_POST["hour1"]) || empty($_POST["minute1"]) || empty($_POST["hour2"]) || empty($_POST["minute2"])){
  echo "<br><br>Empty fields, cannot set alarms";

}
else{

// Be sure to include the file you've just downloaded
    require_once('AfricasTalkingGateway.php');
    // Specify your authentication credentials
    $username   = "test-app";
    $apikey     = "59a7a8d33e5cdc14e71fb4b14db35695706c6eda7f60f688d2d674e49271aa2e";
    // Specify the numbers that you want to send to in a comma-separated list
    // Please ensure you include the country code (+254 for Kenya in this case)
    //0714106652
    $recipients = "0728922269";
    // And of course we want our recipients to know what we really do
    $message    = "".$hour1.$minute1."(".$alarm_type1."),".$hour2.$minute2."(".$alarm_type2.")";
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    /*************************************************************************************
      NOTE: If connecting to the sandbox:
      1. Use "sandbox" as the username
      2. Use the apiKey generated from your sandbox application
         https://account.africastalking.com/apps/sandbox/settings/key
      3. Add the "sandbox" flag to the constructor
      $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
    **************************************************************************************/
    // Any gateway error will be captured by our custom Exception class below, 
    // so wrap the call in a try-catch block*/
   try
    { 
      // Thats it, hit send and we'll take care of the rest. 
      $results = $gateway->sendMessage($recipients, $message);
      echo "<br><br>Alarms set sucessfully";
                
      //foreach($results as $result) {
        // status is either "Success" or "error message"
       // echo " Number: " .$result->number;
        //echo " Status: " .$result->status;
        //echo " StatusCode: " .$result->statusCode;
        //echo " MessageId: " .$result->messageId;
        //echo " Cost: "   .$result->cost."\n";
      //}
    }

    catch ( AfricasTalkingGatewayException $e )
    {
      echo "Encountered an error while sending: ".$e->getMessage();
    }
  } 

$servername = "localhost";
$username = "root";
$password = "mqmlove02";
$dbname = "schoolbell";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
  
  
}



//prepare and bind
$stmt = $conn->prepare("INSERT INTO logs(set_by,alarm_type,hour,minute) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss",$_SESSION["user_name"], $alarm_type1, $hour1,$minute1);

$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("INSERT INTO logs(set_by,alarm_type,hour,minute) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss",$_SESSION["user_name"], $alarm_type2, $hour2,$minute2);

$stmt->execute();
$stmt->close();

$conn->close();

 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  
  return $data;
}

?>

<h6 id="username"> Username: <?php echo $_SESSION["user_name"];?></h6> 
<div class="cont">
  <h4></h4>

</div>

  <div class="loginform">
   
    <form id="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  


<div class="form-row"> 
    <div class="col-sm-1">
  Hour:</div><div class="col-sm-2"> <input type="text" name="hour1" class="form-control">
  <span class="error"> <?php echo $timeErr;?></span>
  <br><br>
</div>
 <div class="col-sm-1">
  Minute:</div><div class="col-sm-2"> <input type="text" name="minute1" class="form-control">
  <span class="error"> <?php echo $timeErr;?></span>
  <br><br>
</div>
 <div class="col-sm-1">
  Programmed</div>
<div class="col-sm-2"> <input type="checkbox" name="programmed1" class="form-control" value="1">
  <span class="error"> <?php echo $programmed1Err;?></span>
  <br><br>
</div>
 <div class="col-sm-1">
  Impromptu</div>
<div class="col-sm-2"> <input type="checkbox" name="impromptu1" class="form-control" value="0">
  <span class="error"> <?php echo $imporomptu1Err;?></span>
  <br><br>
</div>
</div>
<div class="form-row"> 
    <div class="col-sm-1">
  Hour:</div><div class="col-sm-2"> <input type="text" name="hour2" class="form-control">
  <span class="error"> <?php echo $timeErr;?></span>
  <br><br>
</div>
 <div class="col-sm-1">
  Minute:</div><div class="col-sm-2"> <input type="text" name="minute2" class="form-control">
  <span class="error"> <?php echo $timeErr;?></span>
  <br><br>
</div>
 <div class="col-sm-1">
  Programmed</div>
<div class="col-sm-2"> <input type="checkbox" name="programmed2" class="form-control" value="1">
  <span class="error"> <?php echo $programmed2Err;?></span>
  <br><br>
</div>
 <div class="col-sm-1">
  Impromptu</div>
<div class="col-sm-2"> <input type="checkbox" name="impromptu2" class="form-control" value="0">
  <span class="error"> <?php echo $$imporomptu2Err;?></span>
  <br><br>
</div>
</div>
 

 
<div class="form-row">
  <div id="submit" class="col-6">

  <input  type="submit" name="submit" value="Submit" class="btn btn-primary ">  
  </div>
</div>

</form>

  <?php

?> 
  </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <h4><i>&copy;schoolbell 2018</i></h4>
      </div>
      <!-- /.container -->
      
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    

  </body>

</html>