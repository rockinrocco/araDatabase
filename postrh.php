<!DOCTYPE html>

<?php
$conn = mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('rhitter', $conn) or die(mysql_error());
?>

<html>
<head>
<title>New Post</title>
</head>
<body>

<h1>New Post</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
	//Altered to have htmlentities so that we can prevent XSS attacks.
    $post_body = htmlentities($_POST['postbody']);

    if (empty($post_body)) {
        echo '<ul><li>You must post something!</li></ul>';
    } else {
        $result = mysql_query("CALL createPost('" . $username . "', '" .
                                                    $password . "', '" .
                                                    $post_body . "')");
        $row = mysql_fetch_array($result);
        $status = $row[0];

        echo '<ul><li>' . $status . '</li></ul>';
    }
}
?>

<form action="" method="post">
    <label for="username">Username</label><br/>
    <input type="text" name="username"/><br/>
    <label for="username">Password</label><br/>
    <input type="password" name="password"/><br/>
    <label for="postbody">Post</label><br/>
    <textarea name="postbody"></textarea><br/>
    <input type="submit" value="Post"/><br/>
</form>

</body>
</html>
