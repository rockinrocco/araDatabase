<!DOCTYPE html>
<?php
session_start();
   if(isset($_SESSION['user'])){
   require("header.html");
   }
   else{
   require("unlogheader.html");}?>
 
<?php
$conn = mysqli_connect('localhost','root','') or die(mysqli_error($conn));
mysqli_select_db($conn,'ara') or die(mysqli_error($conn));

date_default_timezone_set("America/Indiana/Indianapolis");
$time = date("H.i");
$curDate = date("Y-m-d");
$endTime = "";
$nextMealDate = date("Y-m-d");
$startTime = "";
$currentMeal = "";
if ($time < 7.00) {
	$nextMeal = "Breakfast";
	$currentMeal = "";
	$startTime = "7:00am";
} elseif ($time>7.00 && $time < 9.30) {
	$nextMeal = "Lunch";
	$currentMeal = "Breakfast";
	$endTime = "9:30am";
	$startTime = "10:50";
} elseif ($time<=10.50 && $time >=9.30) {
	$nextMeal = "Lunch";
	$currentMeal = "";
	$startTime = "10:50am";

} elseif ($time>=10.50 && $time<=13.30){
	$nextMeal = "Dinner";
	$currentMeal = "Lunch";
	$endTime = "1:30pm";
	$startTime = "5:00pm";
} elseif ($time>=13.00 && $time<= 17.00) {
	$nextMeal = "Dinner";
	$currentMeal = "";
	$startTime = "5:00pm";
}elseif ($time >= 17.00 && $time <= 19.15)
{
	$nextMeal = "Breakfast";
	$currentMeal = "Dinner";
	$endTime = "7:15pm";
	$startTime = "7:00am";
}else
{
	$nextMeal = "Breakfast";
	$currentMeal = "";
	$startTime = "7:00am";
	$nextMealDate =date("Y-m-d",strtotime('+1 days'));
}

?>


<html>
<!------------------------------head--------------------------------------------------------->
<head>
<!-----------------------------Connecting to database---------------------------------------->

	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>
	<link rel = "icon" type = "image/jpg" href = "../Images/turtletemp.png"/>
</head>
<!----------------------------Body---------------------------------------------------------->
<body>
<!---------------------------wrapper----------------------------------->
<div id = "wrapper">
<!---------------------------Top Bar Stuff (Should be on every Page)-------------------------------->




<div id = 'currentMeal'>
<?php 
	if(!empty($currentMeal)){ 
	echo "<h2> " . $currentMeal . " at the ARA </h2>";
	echo "Served until " . $endTime;
	$currentFood	=	mysqli_query($conn,	"SELECT	h.Fname, h.Flocation, f.avg_rating".	
								" FROM has h, food f WHERE h.MDate = '" . $curDate . "'" . " AND h.MName = '" . $currentMeal
						. "'" . " AND f.name = h.Fname") or die (mysqli_error($conn));
	while	($row	=	mysqli_fetch_array($currentFood))	{	
				echo	'<p> <strong>'.	$row[0]	."</strong> at the " .	$row[1]	." Rating:" . $row[2] . '</p>'	;	}	
} else {
	echo "<h2> No meal is currently being served </h2>";
			}	
?>	
</div>
<div id = 'nextMeal'>
<?php 
	echo "<h2> The next meal is " . $nextMeal . " at " . $startTime . " on " . $nextMealDate . " </h2>";
	$nextFood	=	mysqli_query($conn,	"SELECT	h.Fname, h.Flocation, f.avg_rating".	
								" FROM has h, food f WHERE h.MDate = '" . $nextMealDate . "'" . " AND h.MName = '" . $nextMeal
						. "'" . " AND f.name = h.Fname") or die (mysqli_error($conn));
	while	($row	=	mysqli_fetch_array($nextFood))	{	
				echo	'<p> <strong>'.	$row[0]	."</strong> at the " .	$row[1]	." Rating: " . $row[2] . '</p>'	;	}	
 
?>	

</div>

	<div id = "loginstatus">
		<?php
			if(isset($_SESSION['user'])){
			echo 'Hello: '.$_SESSION['user'];
			}
			else{
			echo 'You currently are not logged in';
			}
		?>
	</div>
	<div id = "join">
		<h3><center>Create an Account</center></h3>
		<p><center>Got an RH email? Sign up!</center></p>
		<p><center><a href = "signup.php">SIGN UP</a> now and write recipes and rate all foods.</center></p>
	</div>
	
	<div id = "media">
		<h3><center>Other Sites</center></h3>
		
		<ul>
			<li><a href ="http://www.rose-hulman.edu"><img src = "../Images/roselogo.jpg" height = "50px"/></a></li>
			<li><a href = "http://www.aramark.com"><img src = "../Images/aralogo.jpg" height = "50px"/></a></li>
			<li><a href = "http://www.campusidsh.com/en_US/CSMW/RoseHulman"><img src = "../Images/campusdishlogo.png" height = "50px"/></a></li>
		</ul>
	</div>
	<a href = "readrecipe.php">
	<div id = "caseAd">
		<h3><center>Read all of the User-Submitted recipes HERE</center></h3>
	</div>
	</a>
	
	
</div>
</body>
</html>