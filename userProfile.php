<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style/profileCSS.css">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
  <?php
  include("init.php");
  session_start();
  
  function mask($str, $start = 0, $length = null){
    $mask = preg_replace("/\S/", "*", $str);
    if(is_null($length)){
       $mask = substr($mask, $start);
       $str = substr_replace($str, $mask, $start);
    }else{
       $mask = substr($mask, $start, $length);
       $str = substr_replace($str, $mask, $start, $length);
    }
    return $str;
  }
  $sql = "SELECT id, userName, email, password FROM registered_Users WHERE userName = '".$_SESSION['username']."' ";
  $result = mysqli_query($conn, $sql);
  
  if(mysqli_num_rows($result) < 0){
    echo "No results were found.";
  }else{?>

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
  <div style="height:200px;"><img src="images/default.png" width="330px" height="240px"></div>
    </div>
  </div>
   <div class="rightcolumn">
    <div class="card">
      <h1>About Me</h1>
      <?php
        $query = "INSERT IGNORE INTO user_Profile (username, email, password) SELECT userName, email, password FROM registered_Users";
        
        if(!(mysqli_query($conn, $query))){
           echo "records do not match";
        }else{
            while($user = mysqli_fetch_assoc($result)){
                  $current_row_id = $user['id'];
      ?>
      
     
      <p><b>Username: </b><?php echo $user['userName']?></p>
      <p><b>Password: </b><?php echo mask($user['password'], null, strlen($user['password']))?></p>
      <p><b>Email: </b><?php echo $user['email']?></p>
      <p><b>Birthday: </b></p>
      <p><b>Title: </b></p>
      <p><b>Posts made: </b><a href="PostViewUser.html">0</a></p>
      <p><b>Total Upvotes received: </b>0</p>
      <p><b>Total Upvotes given: </b>0</p>
      <p><b>Total Downvotes received: </b>0</p>
      <p><b>Total Downvotes given: </b>0</p>
      <p><b>Comments: </b><a href="CommentsViewUser.html">0</a></p> 
      
       <?php 
           }
             }
               }
             ?>
      <button type="button" onClick="window.location='updateUserProfile.php' " style="float:right; margin-top:15px; padding: 5px;">Edit My Profile</button>    
</div>
</div>
</body>
</html>