<?php
session_start();
include "dataconfig.php";
$errormsg = "";


  //sessions
if (isset($_SESSION['auth_users_session'])) {
  if ($_SESSION['auth_users_session']==1){
    header("location:user.php");
  }

}
  // cookies
else if (isset($_COOKIE['auth_users_cookie'])){
  if ($_COOKIE['auth_users_cookie']==true){
    header("location:user.php");
  }

}

if(isset($_POST['signbtn'])){
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $rememberMe=isset($_POST['rememberMe'])?1:0;

  $fetchFrom_users="SELECT * FROM users WHERE email='$email' AND password='$password' ";

  $resultLogin_users=$connection-> query($fetchFrom_users);

  if ($resultLogin_users -> num_rows > 0) {
    while ($result = $resultLogin_users -> fetch_assoc()) {
      $username = $result['name'];
    }

    $_SESSION['username']=$username;

    $_SESSION['auth_users_session'] = 1;
    if($rememberMe == 1){
      setcookie('auth_users_cookie', true, time()+(60*60*24*15),'/');
    }
    header("location:user.php"); 
  } 
  else{
    $errormsg = "Invalid Login Credentials. IF You are new User. Please! Sign up.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outing</title>

  <link rel="stylesheet" href="css/signin.css">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="images/login.png"
          class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <a class="btn btn-primary mb-2 customHomeBtn" href="index.php">
            <i class="fa-solid fa-circle-left"></i> HOME
          </a>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email" id="email" class="form-control form-control-lg custom_ph_text customBorderRadius"  placeholder="Enter Your Email" />
              <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" id="password" class="form-control form-control-lg custom_ph_text" placeholder="Enter Your Password" />
              <label class="form-label" for="password">Password</label>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="chkbox" type="checkbox" name="rememberMe" id="rememberMe"  />
                <label class="form-check-label" for="rememberMe"> Remember me </label>
              </div>
              <a class="text-primary" style="color: #063f69 !important" href="#!">Forgot password?</a>
            </div>
            <!-- Submit button -->
            <div class="text-center">
             <button type="submit" name="signbtn" class="btn btn-primary col-md-12 signin-btn">Sign in</button> 
           </div>
         </form>
         <div class="col-12 mt-3 h6 text-danger c_font">
           <?php echo $errormsg; ?>
         </div>
         <p class="text-center">Don't have an account? <a href="signup.php">Sign up</a></p>
       </div>
     </div>
   </div>
 </section>
</body>
</html>