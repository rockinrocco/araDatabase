<!DOCTYPE html>
<?php	
//	Open	a	connection	to	the	database	
//	(display	an	error	if	the	connection	fails)	
$conn	=	mysqli_connect('localhost',	'root',	'')	or	die(mysqli_error());	
mysqli_select_db($conn,'ara')	or	die(mysqli_error());	
?>	

<html>
	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>

<head>
	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/stylesheetWR.css"/>
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

    <div id ="header"></div>

<!--------------------------------Unique Content---------------------------------->

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


	$post_body = htmlentities($_POST['postbody']);
	$post_name = htmlentities($_POST['name']);
	$post_location = htmlentities($_POST['category']);
	$user = $_SESSION['user'];
	if(empty($post_body) || empty($post_name) || empty($post_location)){
		echo '<ul><li>Your recipe space or name is blank! Please try again.</li></ul>';
	}else{
		$result = mysqli_query($conn,"CALL createPost('".$post_name."','".$post_body."','".$post_location."','" . $user ."')");
		$row = mysqli_fetch_array($result);
		//$status = $row[0];
		if($result == true){
	    echo "Your recipe has been uploaded!";
		}
		else{
		echo "Uh oh. Something went wrong! Try again.";
		}
	}
}

?>
<div id = "newrecipe">
<center>
	<h1>SHARE YOUR CULINARY GENIUS!</h1>
	<p>Who says engineers are one trick ponies? Let the world know of the coolest things you've concocted
		here at the ARA.</p>
	<br>
	<p>Give the recipe a neat name and let everyone know how you made it!</p>

	<form action="" method="post">

	<label for = "name">Recipe Name</label><br/>
	<input type = "text" name = "name"/><br/>


	<label	for="postbody">Instructions</label><br/>	
	<textarea	name="postbody"></textarea><br/>	
    <label> Location </label><br>

	<select name="category" id="category">
    <option value="">-- Please Select a location --</option>
 	<?php 
	$allCats =  mysqli_query($conn,	"SELECT	f.location".	
								" FROM food f " .
								"GROUP BY f.location ORDER BY f.location ASC" ) or die (mysqli_error($conn));
	while	($row	=	mysqli_fetch_array($allCats))	{
	echo '<option value="'.$row[0] . '"> '. $row[0]  . '</option>';
	}
	
	?>
</select>
<br>
	<input	type="submit" value="POST"/><br/>	
	</form>	
</center>
</div>

</div>
</body>
</html>