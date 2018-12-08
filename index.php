<!DOCTYPE html>
<?php 
session_start();
 ?>

<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Log In</title>

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

    <!-- Page Content -->
    <section class="py-5">
     
      <div class="container">
        <div class="content">
            <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "email is required";
  } else {
    $my_email = test_input($_POST["email"]);
  }

   if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $my_password = test_input($_POST["password"]);
  }
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  
  return $data;
}
?>

  <div class="loginform">
    <form id="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <h4>Log into your  portal</h4>
  <div class="form-row"> 
    <div class="col">
  E-mail: <input type="text" name="email" class="form-control">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
</div>
</div>
<div class="form-row"> 
<div class="col">
  Password: <input type="password" name="password" class="form-control">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
</div>
</div>

<div class="form-row">
  <div class="col">

  <input type="submit" name="submit" value="Submit" class="btn btn-primary">  
  </div>
</div>

</form>

  <?php
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

$sql = "SELECT name,email FROM login WHERE email='$my_email' AND password='$my_password'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count==1) {
        
         $_SESSION["user_name"] = $row['name'];
         $_SESSION["loggedin"] = True;
         echo $row['name'];
        header("location: alarm.php");

      }

      else {
         $error = "Your Login Name or Password is invalid";

      }

$conn->close();
?> 
  </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
      	<h4><i>&copy;Schoolbell 2018</i></h4>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>