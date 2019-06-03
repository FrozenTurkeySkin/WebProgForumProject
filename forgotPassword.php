<?php
$email = "";
$emailErr = "";
$msg = "";
function tokenGenerator(){
	$str = "QWERTYUIOPLKJHGFDSAVBNMCXZ0123457896qwertyuioplkjhgfdsavbnmcxz";
	$str = str_shuffle($str);
	$tk = substr($str, 0, 10);
	return $tk;
}
include('init.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($_POST['forgotPass'])) {
		$emailErr = "Email is required.";
	}else{
		$email = $_POST['forgotPass'];
	}

	if (empty($emailErr)) {
		$sql = "SELECT id FROM registered_Users WHERE email = '".$email."' ";
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$token = tokenGenerator();
			$msg = "Please proceed to resetting your password.";
		}else{
			$msg = "Please check your input.";
		}
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Forget Password Form</title>
<link rel="stylesheet" type="text/css" href="style/loginCSS.css">
</head>
<body>
<form action="forgotPassword.php" method="post">
  <div class="imgcontainer">
    <img src="images/forumLogo.png" alt="Avatar" class="avatar">
  </div>
   <font size="6"><?php echo $msg?></font>
  <div class="container">
<h2><b>Forgot your password?</b></h2>
    <label for="forgotPass">Enter your email address</label>
    <input type="text" placeholder="Enter your email here" name="forgotPass" required>
<p>The site will send a key to the email address you submitted so you can reset your password.</p>
    <button type="submit">Submit</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    </div>
</form>
</body>
</html>