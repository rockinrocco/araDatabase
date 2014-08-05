<?php
include('db.php');
if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysqli_query($conn, "select f.location FROM food f where f.name ='$id'");
echo '<option value ="select">--Select a location--</option>';
while($row=mysqli_fetch_array($sql))
{
$id=$row[0];
$data=$row[0];
echo '<option value="'.$id.'">'.$data.'</option>';


}
}

?>