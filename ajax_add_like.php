
<?php
session_start();

include('db.php');
if($_POST['id'])
{
$id=$_POST['id'];
$user = $_SESSION['user'];

$res = mysqli_query($conn, "INSERT INTO `likes`(`username`, `RID`) VALUES ('" . $user ."', '" . $id . "')");
if($res){
	echo "You've like it.  Total likes: ";
	$total = mysqli_query($conn, "SELECT COUNT(*) FROM likes l WHERE l.rid = '" . $id . "'") or die (mysqli_error($conn));
	$totalsrow = mysqli_fetch_array($total);
	echo $totalsrow[0];
} else{
	echo "Error: You've already liked this item";
}

}
?>