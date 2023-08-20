<?php
session_start();
if (isset($_SESSION['auth_users_session'])) {
  if ($_SESSION['auth_users_session']!=1) {
    header("location:signin.php");
  }
}else{
  if (isset($_COOKIE['auth_users_cookie'])) {
    if ($_COOKIE['auth_users_cookie']!=true) {
      header("location:signin.php"); 
    }

  }else {
    header("location:signin.php");
  }
}
//data Config
include("dataconfig.php"); //Required
// For username
$username=isset($_SESSION['username'])?$_SESSION['username']:"";

// upload blog
$s_msg = "";

if (isset($_REQUEST['id'])) {
  $rcvdId = $_REQUEST['id'];

  $fetchData = "SELECT * FROM blogs WHERE id='$rcvdId'";
  $gotInput = mysqli_query($connection, $fetchData);
  $row = mysqli_fetch_assoc($gotInput);
}

if (isset($_POST['updateBlog'])) {
  $id = $_POST['id'];
  $blgTitle = $_POST['blgTitle'];
  $blgText = $_POST['blgText'];

  $updateQuery = "UPDATE blogs SET curDate=CURDATE(), blgTitle='$blgTitle', blgText='$blgText' WHERE id='$id' ";
  if ($connection -> query($updateQuery)) {
    $s_msg = "Submit Successed";
    header("location:user.php?Updated");   
  }
  else {
    echo "Error: " . $connection->error;
  }
}
// upload blog end

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outing | <?php echo $username; ?></title>

  <link rel="stylesheet" href="css/editblog.css">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- header start -->
  <header>
    <div class="container">
      <nav class="navbar navbar-expand-lg static-top">
        <div class="container">
          <a class="navbar-brand logo" href="index.php">
            Outing
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Nature</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">People</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Trips</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
              <li class="nav-item r_g_btn">
                <a class="nav-link " href="signout.php">Sign out</a>
              </li>
              <li class="nav-item r_g_btn">
                <a class="nav-link" href="#"><?php echo $username; ?></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!-- header end -->
  <!-- create blog -->
  <section class="container">
    <div class="row mt-5 mb-5">
      <div class="col-md-12 text-center">
        <h2 class="cardH2">Update blog</h2>
      </div>
      <div class="col-md-12 newBlog">
       <form action="editblog.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
             <div class="mb-3">
              <label for="blgTitle" class="form-label">Blog Title</label>
              <input class="form-control" name="blgTitle" id="blgTitle" placeholder="Enter Blog Title" value="<?php echo $row['blgTitle']; ?>" required></input>
            </div>
            <div class="mb-3">
              <label for="blgText" class="form-label">Enter your text here</label>
              <textarea class="form-control" name="blgText" id="blgText" placeholder="Enter Blog Text" maxlength="150" required><?php echo $row['blgText']; ?></textarea>
            </div>
            <div class="mb-3 text-center">
              <button name="updateBlog" class="btn" type="submit">Update</button>
            </div>
        </form>
        <div class="text-danger text-center">
          <?php echo $s_msg; ?>
        </div>

      </div>
    </div>
  </section>
  <!-- create blog end-->
  <!-- newsletter -->
  <section>
    <div class="row newsLetter mt-5 mb-5">
      <div class="col-md-12 text-center text-white mt-5 NLheading">
        <h2>Newsletter</h2>
        <p>Lorem ipsum, dolor sit amet, consectetur adipisicing.</p>
      </div>
      <div class="col-md-12 text-center mt-3 mb-5 NLform">
        <input type="text" name="">
        <a href="signup.php">Sign up</a>
      </div>
    </div>
  </section>
  <!-- newsletter end -->
  <!-- footer start -->
  <footer>
    <div class="row text-center">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere, nisi.</p>
      <p>© 2023 Mahbub All rights reserved.</p>
    </div>
  </footer>
  <!-- footer end -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
  crossorigin="anonymous"></script>
</body>

</html>