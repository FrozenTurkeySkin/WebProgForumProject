<?php
include("init.php");
session_start();
$msg = "";




$sql = "SELECT username FROM user_Profile WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) < 0) {
	echo "No results were found.";
}else{
	if (isset($_POST['postTitle'])) {
	$title = $_POST['postTitle'];
    $body = $_POST['msg'];

	$query = "INSERT INTO user_Post (topic, details, created_by) VALUES ('".$title."', '".$body."', '".$_SESSION['username']."') ";
	if (mysqli_query($conn, $query)) {
		$msg = "Record inserted successfully.";
		
		header("Location: home.php");
	}else{
		$msg = "Somathing went wrong.";
	}
  }	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style/createPostCSS.css">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="header">
  <h1>H 2 M U</h1>
</div>

<div class="topnav">
  <a href="homePage.html">Home</a>
  <a href="createPost.php">Create Post</a>
  <a href="logout.php" style="float:right">Logout</a>
  <a href="userProfile.php" style="float:right">Profile</a>
</div>

<form action="createPost.php" method="post">
<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Create Post</h2>
      <h5>Title: <input type="text" name="postTitle" size="80" required></h5>
      <textarea name="msg" rows="10" cols="75" placeholder="Enter Content Here" required></textarea>
<p><input type="submit" value="Submit Post" style="margin-top: 8px; margin-right:5px; padding: 5px;"></p>
    </div>
  </div>



</body>
</html>