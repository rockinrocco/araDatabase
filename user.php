

 <html>

 <head>
 		<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>

 	   <?php
session_start();
   if(isset($_SESSION['user'])){
   require("header.html"); }
   
   else{
   require("unlogheader.html");}

$username = $_SESSION['user'];

   ?>

		<link rel="stylesheet" type="text/css" href="../CSS/stylesheetWR.css"/>

 </head>

<h3> <center><?php echo $username;?>'s Users Page </h3>

<h2> REVIEWS </h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<?php 
	include('db.php');
	$myRevs= mysqli_query($conn,	"SELECT	r.fname, r.flocation, r.number, r.description ".	
								" FROM rate r " .
								" WHERE r.username = '$username'  ORDER BY r.fname ASC") or die (mysqli_error($conn));
	echo '<select name="selecteditem">';
		while	($myreviews	=	mysqli_fetch_array($myRevs)){	
			echo '<option value="'. $myreviews[0] . "/". $myreviews[1] .'">' 
			. $myreviews[0] . " at the ". $myreviews[1] . "  Rating: " . $myreviews[2] . "</option>";
		

			}
	?>

	<input type ="submit" name = "submit" value = "View Reviews">
	<input type="hidden" name="act" id="act" value="review">
	</form>

	<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' AND ($_POST['act'] == 'review')){
	$selection= htmlentities($_POST['selecteditem']);
	list($food,$loc) = explode("/", $selection);	
	$reviews = mysqli_query($conn,  "SELECT r.description FROM rate r WHERE r.Fname = '". $food 
		. "'" . " AND r.Flocation = '" . $loc . "' AND r.username = '$username'") or die (mysqli_error($conn));
		while	($review	=	mysqli_fetch_array($reviews))	{

			echo '<p> Decription: ' . $review[0] . " </p> ";
		}
}

?>

<h2> LIKED RECIPES </h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<?php 
	include('db.php');
	$myLikes= mysqli_query($conn,	"SELECT	r.name, l.rid ".	
								" FROM likes l, recipe r " .
								" WHERE l.username = '$username' AND l.RID = r.ID ORDER BY r.name ASC") or die (mysqli_error($conn));
	echo '<select name="selecteditemLikes">';
		while	($likes	=	mysqli_fetch_array($myLikes)){	
			echo '<option value="'. $likes[1] . '">' 
			. $likes[0] . "</option>";
			}
	?>

	<input type ="submit" name = "submit" value = "View Like Recipes">
		<input type="hidden" name="act" id="act" value="recipes">

	</form>

	<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' AND ($_POST['act'] == 'recipes')){
	$selection= htmlentities($_POST['selecteditemLikes']);
	$reviews = mysqli_query($conn,  "SELECT r.description FROM recipe r, likes l WHERE r.id = '". $selection .
		"' AND l.username = '$username' AND r.id = l.rid") or die (mysqli_error($conn));
		while	($review	=	mysqli_fetch_array($reviews))	{

			echo '<p> Decription: ' . $review[0] . " </p> ";
		}
}

?>

<h2> CREATED RECIPES </h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<?php 
	include('db.php');
	$madeRecipes= mysqli_query($conn,	"SELECT	r.name, r.id ".	
								" FROM recipe r " .
								" WHERE r.username = '$username'") or die (mysqli_error($conn));
	echo '<select name="selecteditemCreate">';
		while	($made	=	mysqli_fetch_array($madeRecipes)){	
			echo '<option value="'. $made[1] . '">' 
			. $made[0] . "</option>";
			}
	?>

	<input type ="submit" name = "submit" value = "View Created Recipes">
		<input type="hidden" name="act" id="act" value="createdrecipes">

	</form>

	<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' AND ($_POST['act'] == 'createdrecipes')){
	$selection= htmlentities($_POST['selecteditemCreate']);
	$reviews = mysqli_query($conn,  "SELECT r.description FROM recipe r WHERE r.id = '". $selection .
		"' AND r.username = '$username'") or die (mysqli_error($conn));
		while	($review	=	mysqli_fetch_array($reviews))	{

			echo '<p> Decription: ' . $review[0] . " </p> ";
		}
}

?>
 </html>