<?php
include ("init.php");
session_start();


$newUseName = $newPassword = $newConfirmPassword = $birthday = $occupation = $email = "";
$newPasswordErr = $newConfirmPasswordErr = $emailErr = "";
 
 $sql = "SELECT username FROM user_Profile WHERE username = '".$_SESSION['username']."' ";
 $result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) < 0) {
 	echo "No results were found.";
 }else{
 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 		
    if (isset($_POST['Save'])) {
  	  if (!empty($_POST["newUserNameProfile"])) {
  		$_SESSION['newUseName'] = $_POST["newUserNameProfile"];
  	  }

      if (!empty($_POST["newEmailProfile"])) {
    	$_SESSION['email'] = $_POST["newEmailProfile"];

    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		$emailErr = "Invalid email format!";
    	}
      }
  	  
  	  if (!empty($_POST["newPasswordProfile"])) {
  		$_SESSION['newPassword'] = $_POST["newPasswordProfile"];
  		
  		if (empty($_POST["confirmPasswordProfile"])) {
  			$newConfirmPasswordErr = "This field must not be empty.";
  		}else{
            $_SESSION['newConfirmPassword'] = $_POST["confirmPasswordProfile"];
  		}
  	  }elseif (strlen($newPassword) < 8) {
  		$newPasswordErr = "A password must have at least have 8 characters.";
  	  }else{
  		if ($newPassword == $newConfirmPassword) {
  			$_SESSION['passwordHashed'] = password_hash($password, PASSWORD_BCRYPT);
  		}else{
  			$newConfirmPasswordErr = "You entered a wrong password please try again.";
  		}
  	  }

  	  if (!empty($_POST["userBirthday"])) {
  		$_SESSION['birthday'] = $_POST["userBirthday"];
  	  }

  	  if (!empty($_POST["title"])) {
  		$_SESSION['occupation'] = $_POST["title"];
  	  }
   
      if (empty($newPasswordErr) && empty($newConfirmPasswordErr) && empty($emailErr)) {
      	echo $_SESSION['newUseName'] .$_SESSION['email'] .$_SESSION['newPassword'] .$_SESSION['passwordHashed'] . $_SESSION['birthday'] . $_SESSION['occupation'];
      	
      		$query = "UPDATE user_Profile set username = '".$_SESSION['newUseName']."', email = '".$_SESSION['email']."', password = '".$_SESSION['newPassword']."', passwordHashed = '".$_SESSION['passwordHashed']."', birthday = '".$_SESSION['birthday']."', Occupation = '".$_SESSION['occupation']."' WHERE id = 1 ";

      	if (mysqli_query($conn, $query)) {
      		echo "Record updated succesfully!";
            
      	}else{
      		echo "Error updating record: " .mysqli_error($conn);
      	}
      
      }  
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style/profileCSS.css">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="header">
  <h1>H 2 M U</h1>
</div>

<form action="updateUserProfile.php" method="post">
<div class="topnav">
  <a href="home.php">Home</a>
  <a href="createPost.php">Create Post</a>
  <a href="logout.php" style="float:right">Logout</a>
  <a href="userProfile.php" style="float:right">Profile</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
    	<div style="height:200px;"><img id="ImageViewer" src="images/default.png" width="330px" height="240px">
	    </div>
  <dialog>
  	  <img id="ImageViewer" src="images/default.png" width="330px" height="240px">
  	  <br>
      <form action="updateUserProfile.php" method="post" enctype="multipart/form-data">
          <input type="file" name="File"><br><br> 
          <input type="submit" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="close">Close</button>
      </form>
      
    </dialog>

    <script type="text/javascript">
      var dialog = document.querySelector('dialog');
      document.querySelector('#ImageViewer').onclick = function() {
      dialog.show();
      };
      document.querySelector('#close').onclick = function() {
      dialog.close();
      };
    </script>
    
    </div>
  </div>
   <div class="rightcolumn">
    <div class="card">
      <h1>About Me</h1>
      <p><b>Edit Username: </b><input type="text" name="newUserNameProfile"></p>
      <p><b>Edit Password: </b><input type="password" name="newPasswordProfile"></p>
      <p><b>Confirm Password: </b><input type="password" name="confirmPasswordProfile" required></p>
      <p><b>Edit Email: </b><input type="email" name="newEmailProfile"></p>
      <p><b>Set Birthday: </b><input type="date" name="userBirthday"></p>
      <p><b>Set Title: </b><input list="titles" name="title">
  <datalist id="titles">
    <option value="None">
    <option value="Placeholder">
    </option>
  </datalist></p>
<div class="card">
      <button name="Save" type="button" onClick="window.location='updateUserProfile.php' " style="float:right; margin-top: 8px; padding: 5px;">Save Changes</button>
<button type="button" onClick="window.location='profilePage.html' " style="float:right; margin-top: 8px; margin-right:5px; padding: 5px;">Cancel</button>   
</div>
</div>
</div>
</form>
</body>
</html>