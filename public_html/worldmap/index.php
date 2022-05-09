<!DOCTYPE HTML>

<?php

  

  session_start();

  include "./includes/db.php"; 




  // new way below


    if (isset($_POST) & !empty($_POST)) {
    $username = $_POST['username'];
    $username = mysqli_escape_string($conn, $username);
    $password = $_POST['password'];
    $password = md5($password);
    

    $sql = "SELECT * FROM users WHERE userName='$username' AND pass='$password'";
    
    $result = mysqli_query($conn, $sql);
    
    $count = mysqli_num_rows($result);
    
    if($count == 1){
      $_SESSION['username'] = $username;
    }else{
    $fmsg = "Invalid Username/Password";
    
    }
  }
  if (isset($_SESSION['username'])) {
    $smsg = "User already logged in";
    header("Location: logged_in.php");

  }

  include "includes/inHead.php";
  


?>


<html>
<body>

<?php
include "includes/header.php";
?>

<div class="container">

  <?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?></div>
  <?php } ?>
  <?php if(isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?></div>
  <?php } ?>  


<!--  <form class="form-inline"  method="post" action="index.php">
    <div class="form-group">
    UserName:<br/>
    <input type="text" class="form-control" name="username"> <br/>
    Password<br/>
    <input class="form-control" type="password" name="password"><br/>
    <input class="form-control" type="submit" name="Login">


    </div>
  </form> -->


<div class="jumbotron">
      <h1 class="display-3">Mission World Address</h1>
      <p class="lead">You are at the Mission World Address site.  You must login to proceed.</p>
      <hr class="m-y-md">
      <p>If you are having problems logging in please contact us via <a href="mailto:joe.technow@outlook.com">web site support mail.</a> </p>

   


</div>

<?php
include "includes/footer.php";
?>



</body>


</html>
