<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
   session_start();
   
   if(session_destroy()) {
   	$_SESSION["loggedin"]=False;
      header("Location: index.php");
   }
?>
</body>
</html>