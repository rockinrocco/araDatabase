<html>
<!------------------------------head--------------------------------------------------------->
<head>
	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css"/>
	<link rel = "icon" type = "image/jpg" href = "../Images/turtletemp.png"/>
</head>
<!----------------------------Body---------------------------------------------------------->
<body>
<!---------------------------wrapper----------------------------------->
<div id = "wrapper">
<!---------------------------Top Bar Stuff (Should be on every Page)-------------------------------->
   <?php
session_start();
   if(isset($_SESSION['user'])){
   require("header.html"); }
   
   else{
   require("unlogheader.html");}?>

   	<?php
$conn = mysqli_connect('localhost','root','') or die(mysqli_error($conn));
mysqli_select_db($conn,'ara') or die(mysqli_error($conn));

date_default_timezone_set("America/Indiana/Indianapolis");
$monday = date('Y-m-d', strtotime('monday this week'));
$tuesday = date('Y-m-d', strtotime('tuesday this week'));
$wednesday = date('Y-m-d', strtotime('wednesday this week'));
$thursday = date('Y-m-d', strtotime('thursday this week'));
$friday = date('Y-m-d', strtotime('friday this week'));
$saturday = date('Y-m-d', strtotime('saturday this week'));

$dates = array(0 => $monday, 1 => $tuesday, 2=>$wednesday,3=>$thursday,4=>$friday, 5=>$saturday);

?>



	<link rel="stylesheet" type="text/css" href="../CSS/weeklytable.css"/>

	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>


<!--------------------------------Unique Content---------------------------------->
	<center>
<table align = "left" name= "weeklytable">
<tr>
	<td id ="hideMe"></td>
	<th id = 'theader'>Monday <?php echo $dates[0];?> </th>
	<th id = 'theader'>Tuesday <?php echo $dates[1];?> </th>
	<th id = 'theader'>Wednesday <?php echo $dates[2];?> </th>
	<th id = 'theader'>Thursday <?php echo $dates[3];?> </th>
	<th id = 'theader'>Friday <?php echo $dates[4];?> </th>
	<th id = 'theader'>Saturday <?php echo $dates[5];?> </th>
</tr>

<tr>
<th id = 'theader'> Breakfast</th>

	<?php
	foreach($dates as $date){
$currentFood	=	mysqli_query($conn,	"SELECT	h.Fname, h.Flocation, f.avg_rating".	
								" FROM has h, food f WHERE h.MDate = '" . $date . "'" . " AND h.MName = 'Breakfast'"
						. " AND f.name = h.Fname") or die (mysqli_error($conn));
	echo "<td id='data'>";
	while	($row	=	mysqli_fetch_array($currentFood))	{	
				echo	'<strong>'.	$row[0]	. " Rating:" . $row[2] . "<br>" ;	}	
	echo "</td>";

	}

	?>
</tr>

<tr>
	<th id = 'theader'>Lunch</th>
		<?php
	foreach($dates as $date){
$currentFood	=	mysqli_query($conn,	"SELECT	h.Fname, h.Flocation, f.avg_rating".	
								" FROM has h, food f WHERE h.MDate = '" . $date . "'" . " AND h.MName = 'Lunch' 
								AND f.name = h.Fname") or die (mysqli_error($conn));
	echo "<td id='data'>";
	while	($row	=	mysqli_fetch_array($currentFood))	{	
				echo	'<strong>'.	$row[0]	." Rating:" . $row[2] . "<br>";	}	
	echo "</td>";

	}

	?>
</tr>

<tr>
	<th id = 'theader'>Dinner</th>
			<?php
	foreach($dates as $date){
$currentFood	=	mysqli_query($conn,	"SELECT	h.Fname, h.Flocation, f.avg_rating".	
								" FROM has h, food f WHERE h.MDate = '" . $date . "'" . " AND h.MName = 'Dinner' 
								AND f.name = h.Fname") or die (mysqli_error($conn));
	echo "<td id='data'>";
	while	($row	=	mysqli_fetch_array($currentFood))	{	
				echo	'<strong>'.	$row[0]	." Rating:" . $row[2] . "<br>";	}	
	echo "</td>";

	}

	?>
</tr>

</table>



</body>
</html>