<!DOCTYPE html>
<?php	
//	Open	a	connection	to	the	database	
//	(display	an	error	if	the	connection	fails)	
$conn	=	mysqli_connect('localhost',	'root',	'')	or	die(mysqli_error());	
mysqli_select_db($conn,'ara')	or	die(mysqli_error());	
?>	
<?php 
session_start();
?>


<html>
	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>

<!------------------------------head--------------------------------------------------------->
<head>
	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css"/>
	<link rel = "icon" type = "image/jpg" href = "../Images/turtletemp.png"/>
</head>
<!----------------------------Body---------------------------------------------------------->
<body>
   <?php 
   if(isset($_SESSION['user'])){
   require("header.html"); }
   
   else{
   require("unlogheader.html");}?>

<!--------------------------------Unique Content--------------------------------->
<?php
	
	if(isset($_SESSION['user'])){
	session_unset();
	echo"<script language=\"JavaScript\">\n";
	echo"parent.window.location.reload();";
	echo"</script>";
	}
	?>
<div id = "logoutnotice">
	<h2>You have been logged out. Click <a href = "araindex.php">HERE</a> to go back to the main page.</h2>
	

</body>
</html>