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
if (isset($_POST['uploadBlog'])) {
  $blgTitle = $_POST['blgTitle'];
  $blgText = $_POST['blgText'];

  $blgImg = uniqid().$_FILES['blgImg']['name'];
  $fileTempLocation = $_FILES['blgImg']['tmp_name'];
  $imgStore = "images/".$blgImg;

  move_uploaded_file($fileTempLocation, $imgStore);

  $insertSql = "INSERT INTO blogs (username, curDate, blgTitle, blgText, blgImg) VALUES ('$username', CURDATE(), '$blgTitle', '$blgText', '$blgImg')";
  if ($connection -> query($insertSql)) {
    $s_msg = "Submit Successed";
    header("location:user.php");   
  }
  else {
    echo "Error: " . $connection->error;
  }
}
// upload blog end
// view blog
$selectBlogs = "SELECT * FROM blogs";
$connection -> query($selectBlogs);
$resultBlogs = $connection -> query($selectBlogs);
// view blog end
// delete blog
if (isset($_GET['del_id'])) {
  $del_id = $_GET['del_id'];
  $delete_from_floder = $_GET['blgImg'];

  $deletesql="DELETE FROM blogs WHERE id=$del_id";
  if ($connection-> query($deletesql)) {
    unlink("images/$delete_from_floder");
    header("location:user.php?deleted"); 
  }
  else {
    die($connection-> error);
  }
 }
// delete blog end

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outing | <?php echo $username; ?></title>

  <link rel="stylesheet" href="css/user.css">
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
        <h2 class="cardH2">Create new blog</h2>
      </div>
      <div class="col-md-12 newBlog">
       <form action="user.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="blgTitle" class="form-label">Blog Title</label>
          <input class="form-control" name="blgTitle" id="blgTitle" placeholder="Enter Blog Title" required></input>
        </div>
        <div class="mb-3">
          <label for="blgText" class="form-label">Enter your text here</label>
          <textarea class="form-control" name="blgText" id="blgText" placeholder="Enter Blog Text" maxlength="150" required></textarea>
        </div>
        <div class="mb-3">
          <label for="img" class="form-label">Add Image</label>
          <input type="file" class="form-control" id="img" name="blgImg" aria-label="file example" accept="image/*" required>
          <label for="img" class="form-label text-danger">Image size must be 380x250 px.</label>
        </div>

        <div class="mb-3 text-center">
          <button name="uploadBlog" class="btn" type="submit">Submit</button>
        </div>
      </form>
      <div class="text-danger text-center">
        <?php echo $s_msg; ?>
      </div>

    </div>
  </div>
</section>
<!-- create blog end-->
<!-- my blogs start -->
<section class="container">
  <div class="row mt-5 mb-5">
    <div class="col-md-12 text-center">
      <h2 class="cardH2">My Blogs</h2>
    </div>
    <?php while ($blog = $resultBlogs -> fetch_assoc()) {?>
      <?php if ($username == $blog['username']) {?>
     <div class="col-md-4 col-12 mb-2">
      <div class="card">
        <img src="images/<?php echo $blog['blgImg'] ?>" class="img-fluid" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $blog['blgTitle'] ?></h5>
          <p class="card-text"><?php echo $blog['blgText'] ?></p>
          <p class="card-text">
            <small class="text-muted">Last updated <?php echo $blog['curDate'] ?></small>
            <span class="text-primary"><?php echo $blog['username']?></span>
          </p>
          <div class="text-center">
            <a onclick="return comfirm('Are you sure?')" class="delButton" title="Delete" href="user.php?del_id=<?php echo $blog['id'];?>& blgImg=<?php echo $blog['blgImg'] ?>"><i class="fa-solid fa-trash"></i></a>
            <a class="EditButton" href="editblog.php?id=<?php echo $blog['id']; ?>" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
          </div> 
        </div>
      </div>
    </div>
  <?php } ?>
  <?php } ?>
</div>
</section>
<!-- my blogs end -->
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