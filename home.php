<?php
include("init.php");
session_start();
$use_topic = $use_body = $use_date = $use_topic1 = $use_body1 = $use_date1 = $use_topic2 = $use_body2 = $use_date2 = $use_topic3 = $use_body3 = $use_date3 = "";
$sql = "SELECT * FROM user_Post WHERE created_by = '".$_SESSION['username']."' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) < 0) {
	echo "No results were found.";
}else{?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style/homeCSS.css">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="header">
  <h1>H 2 M U</h1>
</div>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="createPost.php">Create Post</a>
  <a href="logout.php" style="float:right">Logout</a>
  <a href="userProfile.php" style="float:right">Profile</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <?php 
        while ($user = mysqli_fetch_assoc($result)) {
        	$current_row_id = $user['id'];?>
        
      <h2><?php echo $user['topic']?></h2>
      <h5><?php echo $user['datetime']?></h5>
      
      
      <p><?php echo $user['details']?></p>
      <p class="upvoteCounter" style="color: green; float: left;">Upvotes(0)</p>
      <p class="downvoteCounter" style="color: red; float: left;">    Downvotes(0)</p>
      <p class="commentCounter" style="color: gray; float: right;"> Comments (This should be programmed)</p>
    </div>

    <div class="card">
      <h2><?php echo $user['topic']?></h2>
      <h5><?php echo $user['datetime']?></h5>
      
      <p><?php echo $user['details']?></p>
      <p class="upvoteCounter" style="color: green; float: left;">Upvotes(0)</p>
      <p class="downvoteCounter" style="color: red; float: left;">    Downvotes(0)</p>
      <p class="commentCounter" style="color: gray; float: right;"> Comments (This should be programmed)</p>
    </div>
    
    <div class="card">
      <h2><?php echo $user['topic']?></h2>
      <h5><?php echo $user['datetime']?></h5>
      
      <p><?php echo $user['details']?></p>
      <p class="upvoteCounter" style="color: green; float: left;">Upvotes(0)</p>
      <p class="downvoteCounter" style="color: red; float: left;">    Downvotes(0)</p>
      <p class="commentCounter" style="color: gray; float: right;"> Comments (This should be programmed)</p>
    </div>
    
      
    <div class="card">
      <h2><?php echo $user['topic']?></h2>
      <h5><?php echo $user['datetime']?></h5>
      
      <p><?php echo $user['details']?></p>
      <p class="upvoteCounter" style="color: green; float: left;">Upvotes(0)</p>
      <p class="downvoteCounter" style="color: red; float: left;">    Downvotes(0)</p>
      <p class="commentCounter" style="color: gray; float: right;"> Comments (This should be programmed)</p>
    </div>
    <?php
     }
      }?>

  </div>
  <div class="rightcolumn">
    <div class="card">
      <h3>Hot Posts</h3>
      <div class="placeimg"><img src="Images/advertisement1.png" height="150px" width="250px"></div>
      <p>Mobile Match, find your love</p>
      <div class="placeimg"><img src="Images/advertisement2.png"></div>
      <p>Dell Inspiron 15</p>
      <div class="placeimg"><img src="Images/advertisement3.jpg" height="170px" width="250px"></div>
      <p>7 Eleven</p>
    </div>
    <div class="card">
      <h3>About Us</h3>
      <p>The forum where you can ask random questions about mobile hardware and technology.</p>
    </div>
  </div>
</div>
<div class="footer">
  <h2>&copy; The Tech Inc. 2018</h2>
</div>
</body>
</html>