<?php 
  include ("dataconfig.php");
  $emailError=null;
  $pass_not_matched=null;

  if (isset($_POST['signupbtn'])) {
    $name = $_POST['InputName'];
    $email = $_POST['InputEmail'];
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);

    $fetchEmail_id = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email' ");
    $chk_email = mysqli_num_rows($fetchEmail_id);

    if ($chk_email == true ) {
      $emailError="This E-mail is already used!";
      
    } 
    else if($password == $confirmPassword) {
      $insertSql="INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')";
      if($connection-> query($insertSql)){
        header("location:signin.php");
      }
      else{
        die($connection-> error);
      }
    }
    else {
      $pass_not_matched="Password don't Matched";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="css/signup.css">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
  <!-- Link Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="signup-container">
    <h2 class="signup-heading">Create an Account</h2>
    <form class="signup-form" action="<?php echo $_SERVER['PHP_SELF'];?> " method="post">
      <div class="mb-3">
        <label for="name">Name</label>
        <input type="text" id="name" name="InputName" class="form-control" placeholder="Enter Your Full Name" required>
      </div>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="InputEmail" id="email" class="form-control" placeholder="Enter Your Email" required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
      </div>
      <div class="mb-3">
        <label for="password">Confirm Password</label>
        <input type="password" name="confirmPassword" id="password" class="form-control" placeholder="Enter Confirm Password" required>
      </div>
      <button type="submit" name="signupbtn" class="col-md-12 signup-btn btn btn-block">Sign Up</button>
    </form>
    <div class="h6 mt-3  text-danger font-weight-bold col-md-10">
     <?php echo $emailError;?> 
   </div>
   <div class="h6 mt-3  text-danger font-weight-bold col-md-6">
     <?php echo $pass_not_matched;?> 
   </div>
   <p class="text-center">Already have an account? <a href="signin.php">Sign in</a></p>
 </div>

 <!-- Link Bootstrap JS and jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
