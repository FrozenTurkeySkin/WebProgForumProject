<?php
$usename = $pass = "";
$usenameErr = $passErr = "";
$msg = "";

include("init.php");


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (empty($_POST['uname'])) {
    	$usenameErr = "Username is a required field.";
    }else{
        $usename = $_POST['uname'];
    }

    if (empty($_POST['psw'])) {
    	$passErr = "Password is a required field.";
    }else{
        $pass = $_POST['psw'];
    }
    
    if (empty($usenameErr) && empty($passErr)) {
    	$sql = "SELECT id FROM registered_Users WHERE userName = '".$usename."' AND password = '".$pass."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $usename;
            
            header("Location:userProfile.php");
        }else{
    	   $msg = "You entered a wrong username or password.";
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Log In Form</title>
<link rel="stylesheet" type="text/css" href="style/loginCSS.css">
</head>
<body>
<form action="login.php" method="POST">
  <div class="imgcontainer">
    <img src="images/forumLogo.png" alt="Avatar" class="avatar">
  </div>
  <font size="6"><?php echo $msg?></font>
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname"/>
    <font color="red"><?php echo $usenameErr?></font><br>
    
    
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw"/>
    <font color="red"><?php echo $passErr?></font>

    <button name="login" type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn" onClick="window.location='signUp.php' " >Go Back</button>
    <span class="psw"><a href="forgotPasswordPage.html">Forgot password?</a></span>
  </div>
</form>
</body>
</html>