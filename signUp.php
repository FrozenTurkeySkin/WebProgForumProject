<!DOCTYPE HTML>
<html>
<head>
<title>Sign Up Form</title>
<link rel="stylesheet" type="text/css" href="style/loginCSS.css">
</head>
<body>
<?php
   $error = "";
   $msg = "";
   $userNameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
   $userName = $email = $password = $confirmPassword = $passwordHashed = "";
   
   require_once('init.php');
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     if (empty($_POST["newuname"])) {
       $userNameErr = "Username is required!";
     }else{
       $userName = $_POST["newuname"];
     }

     if (empty($_POST["newpsw"])) {
       $passwordErr = "Password is required!";
     }elseif (strlen($_POST["newpsw"]) < 8) {
       $passwordErr = "A password must at least contain 8 characters.";
     }elseif (empty($_POST["confirmpsw"])) {
       $confirmPasswordErr = "Confirm Password is required!";
     }else{
        $password = $_POST["newpsw"];
        $confirmPassword = $_POST["confirmpsw"];
        
        if ($password == $confirmPassword) {
           $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        }else{
          $confirmPasswordErr = "You entered the wrong password. Please type your password again.";
        }
     }

     if (empty($_POST["newem"])) {
       $emailErr = "Email is required!";
     }else{
       $email = $_POST["newem"];

       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format!";
        } 
     }

     if (empty($userNameErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($emailErr)) {
         $sql = "INSERT IGNORE INTO registered_Users (userName, email, password, passwordHashed) VALUES ('".$userName."', '".$email."','".$password."' ,'".$passwordHashed."')";

        if(mysqli_query($conn, $sql)) {
           $msg = "You have been sucessfully registered!";
           header("Location:home.php");
        }else{
           $error = "The information you have entered is already existing.";
        }
                              
              
     }
   
    }
   function test_input($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
   }

?>

<form action="signUp.php" method="POST">
  <div class="imgcontainer">
    <img src="images/forumLogo.png" alt="Avatar" class="avatar"><br>
    <font size="6"><b><?php echo $msg?></b></font>
    <font size="6" color="red"><b><?php echo $error?></b></font>
  </div>

  <div class="container">
<h2>Please enter the necessary information to create your account</h2>
    <label for="newuname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="newuname"  />
    <font color="red"><?php echo $userNameErr?></font><br>

    <label for="newpsw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="newpsw"  />
    <font color="red"><?php echo $passwordErr?></font><br>

    <label for="confirmpsw"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="confirmpsw"  />
    <font color ="red"><?php echo $confirmPasswordErr?></font><br>

    <label for="newem"><b>Email Address </b></label>
    <input type="email" placeholder="Enter Email Address" name="newem"  />
    <font color="red"><?php echo $emailErr?></font><br>

    <button name= "create" type="submit">Create Account</button>
    <a href="login.php"><input type="button" name="login" value="Go To Login"></a>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    </div>
</form>
</body>
</html>
