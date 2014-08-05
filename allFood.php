<!DOCTYPE html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


<html>	
<head>
	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>
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

	<h2> View Reviews  </h2>


	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<?php 
	include('db.php');
	$allFoods = mysqli_query($conn,	"SELECT	f.name, f.location, f.avg_rating ".	
								" FROM food f " .
								" ORDER BY f.name ASC" ) or die (mysqli_error($conn));
	echo '<select name="selecteditem">';
		while	($allFood	=	mysqli_fetch_array($allFoods))	{	

			$ratings = mysqli_query($conn, "SELECT COUNT(*) FROM rate r WHERE r.Fname = '" . $allFood[0] .  "'" . " AND r.Flocation = '" . $allFood[1] . "'") or die (mysqli_error($conn));

				$ratingsrow = mysqli_fetch_array($ratings);
				echo	'<option value="' . $allFood[0] .'/'. $allFood[1] . '">'. $allFood[0] . ' '.	$allFood[1]	.' Avg Rating: ' . $allFood[2]  .' with ' . $ratingsrow[0] . ' Reviews </option>'; 
			

				/*echo '<script type = "text/javascript"> $(document).ready(function(){
 				$("'. '[id=' . "'" . $allFood[0] . $allFood[1] ."'" . ']").click(function(){
  				$("'.'[id='."'". $allFood[0] . $allFood[1]. 'd' . "'" . ']").toggle();
 				 });
				});
				</script>';*/
				 


	
			}
	?>

	<input type ="submit" name = "submit" value = "View Reviews">
	</form>
	<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


	$selection= htmlentities($_POST['selecteditem']);
	list($food,$loc) = explode("/", $selection);	
	echo $food . " at the ".  $loc ." <br> <h4>Reviews </h4>";
	$reviews = mysqli_query($conn,  "SELECT r.description,r.number, r.username FROM rate r WHERE r.Fname = '". $food . "'" . " AND r.Flocation = '" . $loc . "'") or die (mysqli_error($conn));
		while	($review	=	mysqli_fetch_array($reviews))	{

			echo '<p> User: ' . $review[2] . " Rating: " . $review[1] . "<br> Description : " . $review[0] . " </p> ";
		}
}

?>
</html>