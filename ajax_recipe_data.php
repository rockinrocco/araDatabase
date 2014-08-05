<?php
include('db.php');
if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysqli_query($conn, "select r.name FROM recipe r where r.category='$id'");

echo '<option value ="select">--Select a name--</option>';
while($row=mysqli_fetch_array($sql))
{
$id=$row[0];
$data=$row[0];
echo '<option value="'.$id.'">'.$data.'</option>';


}
}

?>