<?php
include('db.php');
session_start();
if($_POST['id'])
{
$id=$_POST['id'];

$sql=mysqli_query($conn, "select r.name,r.description, r.username, r.id FROM recipe r where r.name='$id'");
while($row=mysqli_fetch_array($sql))
{
$id=$row[0];
$data=$row[1];
$user = $row[2];
$rid = $row[3];
 if(isset($_SESSION['user'])){
$userL = $_SESSION['user'];
} else {
  $userL = 'guest';
}

$likes = mysqli_query($conn,"select COUNT(*) from likes l WHERE l.RID = '$rid'");
$likesRow = mysqli_fetch_array($likes);
echo '<p> <b> Name: </b> ' . $id . " by ". $user . " <h5> How to make:</h5>" . $data . '</p>';
echo '<p> <b> Likes    </b> '. $likesRow[0] . "  ";
  if(!isset($_SESSION['user']))
  {
        echo "<b>    Login to like a recipe!</b></p>";
  } else {
  $likedCheck = mysqli_query($conn,"select COUNT(*) from likes l WHERE l.RID = '$rid' AND l.username = '$userL' ");
  $liked = mysqli_fetch_array($likedCheck);
   if($liked[0] == 0) {
   echo 
  '<input type ="button" class = "submit" name = "submit" id ="'.$rid.'" value = "Like"> </p>';
  }  else {
    echo " <b>     You've already liked this item. </b>";
}
}
}
}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script language="javascript" type="text/javascript">  

$(document).ready(function(){
	$('.submit').click(function (){
		var id = $(this).attr('id');
		var dataString = 'id=' + id;
		 $.ajax
       ({
       	type: "POST",
       	url: "ajax_add_like.php",
       	data: dataString,
       	cache: false,
       	        success: function(html){
          $("#liked").html(html);
        }
       });
   });
});

</script>
<div id="liked" >  </div>
	

