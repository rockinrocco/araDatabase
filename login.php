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
<!------------------------------head--------------------------------------------------------->
<head>
	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/loginstylesheet.css"/>
	<link rel = "icon" type = "image/jpg" href = "../Images/turtletemp.png"/>
		<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>

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
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['logsub'])){
	$username = htmlentities($_POST['User']);
	$password = htmlentities($_POST['password']);
	
	if(empty($username) || empty($password)){
		echo '<ul><li>You must input a valid username/password';
	}else{
	     $result = mysqli_query($conn,"CALL login('".$username."','".$password."')");
		 //$row = mysqli_fetch_array($result);
		 //$status = $row[0];
		 if($result == true){
		 $_SESSION['user'] = $username;
		 echo"<script language=\"JavaScript\">\n";
		 echo"parent.window.location.reload();";
		 echo"</script>";
		 echo "You have logged in!";
		 }else{
		 echo "Incorrect username/password";
		 }
		 }
		 }
	else{
	$Username = htmlentities($_POST['Username']);
	$signpass = htmlentities($_POST['signpass']);
	$user_results = mysqli_query($conn, "SELECT username FROM users WHERE username = ".$Username);
	if($user_results){
		if(mysqli_fetch_array($user_results)){
			echo '<ul><li>Username already taken</li></ul>';
		}
	}else{
	mysqli_query($conn,"INSERT INTO users(realName, username, hashed_password, priviledge)". "VALUES('".$Username."'
	,'".$Username."',HEX('".$signpass."'),1)") or die('error');
	echo '<ul><li> Registration successful!</li></ul>';
	$Username = '';
	$signpass = '';
	 echo"<script language=\"JavaScript\">\n";
	echo"parent.window.location.reload();";
	echo"</script>";
	echo '<ul><li> Registration successful!</li></ul>';
	}
	}
	}
		 
?>
<div id = loginform>
<h2>Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Username: <input type="text" name="User">
   <br><br>
   Password: <input type="password" name="password">
   <br><br>
   <input type="submit" name="logsub" value="Submit"> 
</form>
</div>
<div id = logout>
<center>Click <a href = "logout.php">HERE</a> to log out.</center>
</div>
<div id = signup>
<h2> Sign up using your RHIT username </h2>
<form method = "post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Username: <input type = "text" name = "Username">
	<br><br>
	Password: <input type = "password" name = "signpass">
	<br><br>
	<input type = "submit" name = "signsubmit" value = "Submit">
</form>
</div>
</div>
	
	

</body>
</html>