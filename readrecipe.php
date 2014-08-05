<html>
<!-----------------------------head---------------------------------->
<!DOCTYPE html>

<head>
	<?php
$conn = mysqli_connect('localhost','root','') or die(mysqli_error($conn));
mysqli_select_db($conn,'ara') or die(mysqli_error($conn));
?>

	<title>ARAMARK : Rose-Hulman</title>
	<link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>
	<link rel = "icon" type = "image/jpg" href = "../Images/turtletemp.png"/>
</head>
<!----------------------------Body------------------------------------------------------------>
<body>
<!---------------------------wrapper------------------------------------>
<div id = "wrapper">
<!---------------------------Top Bar Stuff (Should be on every Page)-------------------------------->
  <?php
session_start();
   if(isset($_SESSION['user'])){
   require("header.html"); }
   
   else{
   require("unlogheader.html");}?>


<!--------------------------------Unique Content ---------------------------------->
<h2>Live	Feed</h2>	
<meta charset='UTF-8' />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script language="javascript" type="text/javascript">  
$(document).ready(function(){
//If parent option is changed
$("#category").change(function() {
        var id = $(this).val(); //get option value from parent 
        var dataString = 'id=' + id;
       $.ajax
       ({
       	type: "POST",
       	url: "ajax_recipe_data.php",
       	data: dataString,
       	cache: false,
       	success: function(html){
       		$("#recipe").html(html);
       	}
       });
   });
$("#recipe").change(function() {
        var id = $(this).val(); //get option value from parent 
        var dataString = 'id=' + id;
       $.ajax
       ({
       	type: "POST",
       	url: "ajax_recipe_display.php",
       	data: dataString,
       	cache: false,
       	success: function(html){
       		$("#displayRecipe").html(html);
       	}
       });
   });
});

</script>

</head>

<body> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<div class="wrapper">
<select name="category" id="category">

    <option value="">-- Please Select a category --</option>

 <?php 
	$allCats =  mysqli_query($conn,	"SELECT	r.category".	
								" FROM recipe r " .
								"GROUP BY r.category ORDER BY r.category ASC" ) or die (mysqli_error($conn));
	while	($row	=	mysqli_fetch_array($allCats))	{
	echo '<option value="'.$row[0] . '"> '. $row[0]  . '</option>';
}
	
	?>
</select>


<select name="recipe" id="recipe">
	<option selected="selected">--Select Name--</option>
</select>

<div name="displayRecipe" id="displayRecipe">  </div>


</div>
</body>
</html>
