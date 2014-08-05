<html<>
<!-----------------------------head---------------------------------->
<head>
    <link rel="stylesheet" type="text/css" href="../CSS/araindex.css"/>

		<link rel="stylesheet" type="text/css" href="../CSS/stylesheetWR.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	        <?php
session_start();
   if(isset($_SESSION['user'])){
   require("header.html"); }
   
   else{
   require("unlogheader.html");}?>
</head>
	<?php
$conn = mysqli_connect('localhost','root','') or die(mysqli_error($conn));
mysqli_select_db($conn,'ara') or die(mysqli_error($conn));
?>

 	<?php 
	$allFood =  mysqli_query($conn,	"SELECT	f.name".	
								" FROM food f " .
								"GROUP BY f.name ORDER BY f.name ASC" ) or die (mysqli_error($conn));
	$column = array();

	while($row = mysqli_fetch_array($allFood)){
    $column[] = $row[0];
//Edited - added semicolon at the End of line.1st and 4th(prev) line

}
	?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">  

$(document).ready(function(){
  var foodName = "";
 $(function() {
var availableFood = <?php echo json_encode($column);?>;

    $( "#foodName").autocomplete({
    	source: availableFood

    });

  $("#displayChoices").hover(function() {

        var id = $("#foodName").val(); //get option value from parent 
        if (id == foodName){
          //dont do anything, user hasnt changed input.
        } else {
          foodName = id;
        var dataString = 'id=' + id;
       $.ajax
       ({
        type: "POST",
        url: "ajax_display_location.php",
        data: dataString,
        cache: false,
        success: function(html){
          $("#displayChoices").html(html);
        }
       });}
   });
});
});
</script>


<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


  $foodName = htmlentities($_POST['foodName']);
  $foodLocal = htmlentities($_POST['displayChoices']);
  $review = htmlentities($_POST['postbody']);
  $rating = htmlentities($_POST['rating']);
  $user = $_SESSION['user'];
  
  if(empty($rating) || empty($foodName)){
    echo '<ul><li>Your food name or review is blank! Please try again.</li></ul>';
  }else {
    $testNamelocal = mysqli_query($conn, "select COUNT(*) FROM food f where f.name ='$foodName' and f.location = '$foodLocal'");
    $row = mysqli_fetch_array($testNamelocal);
    if($row[0]==0){
      echo "Please select a location";
  } else {
    $result = mysqli_query($conn,"CALL createReview('".$user."','".$foodName."','".$foodLocal."','".$review."','" . $rating . "')");
    if($result == true){
      echo "Your result has been uploaded!";
    }
    else{
    echo "You have already submitted a review for this item.";
    }
  }
}
}
?>





<div id = "newreview">
<center>
	<h1>TELL US WHAT YOU THINK!</h1>
	<p>Let the world know what you ARA meals consider divine and which ones you think are barely edible!</p>


<form action="" method="post" onSubmit="window.location.reload()">

 <div class="ui-widget">
  <label for="foodName">Food Name: </label>
  <input name = "foodName" id="foodName">
</div>

  <label for="location">Location: </label>
<select name="displayChoices" id="displayChoices">
<option value ="select">--Locations will be displayed after food name entry--</option>
</select>
<br>
<br>
  <label for="ratings">Rating: </lable>
    <select name="rating" id = "rating">
      <option selected="selected">1</option>
      <option selected="selected">2</option>
      <option selected="selected">3</option>
      <option selected="selected">4</option>
      <option selected="selected">5</option>
      </select>
  <br>
<br>
 <label  for="postbody">Review</label> 
 <br>
  <textarea name="postbody"></textarea><br/>  

  <input name="submit" type="submit" value="Submit"/><br/> 
  </form> 


</div>
</body>
</html>