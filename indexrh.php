<!DOCTYPE html>

<?php
// Open a connection to the database
// (display an error if the connection fails)
$conn = mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('rhitter', $conn) or die(mysql_error());
?>

<html>
<head>
<title>Welcome!</title>
</head>
<body>

<h1>Welcome to RHITter!</h1>

<ul>
    <li><a href="/registerrh.php">Register</a></li>
    <li><a href="/postrh.php">Make a Post</a></li>
</ul>

<h2>Live Feed</h2>

<?php
// Select the 30 most recent posts from our friendly posts view
$posts = mysql_query("SELECT user_name, post_body ".
                     "FROM friendly_posts " .
                     "ORDER BY created_at DESC " .
                     "LIMIT 30");

// Display each post
while ($row = mysql_fetch_array($posts)) {
    echo '<p><strong>' . $row[0] . '</strong>: ' . $row[1] . '</p>';
}
?>

</body>
</html>
