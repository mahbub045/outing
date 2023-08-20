<?php
session_start();
if (isset($_SESSION['auth_users_session'])) {
  if ($_SESSION['auth_users_session']!=1) {
    header("location:signin.php");
  }
}
//data Config
include("dataconfig.php"); //Required 
// For username
$username=isset($_SESSION['username'])?$_SESSION['username']:"";
// view blog
$selectBlogs = "SELECT * FROM blogs";
$connection -> query($selectBlogs);
$resultBlogs = $connection -> query($selectBlogs);
// view blog end
 ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outing</title>

  <link rel="stylesheet" href="css/style.css">
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
              <?php if(isset($_SESSION['auth_users_session']) && $_SESSION['auth_users_session']): ?>
              <li class="nav-item r_g_btn">
                <a class="nav-link " href="signin.php"><?php echo $username ?></a>
              </li>
              <?php else: ?>
              <li class="nav-item r_g_btn">
                <a class="nav-link" href="signin.php">Sign in</a>
              </li>
              <li class="nav-item r_g_btn">
                <a class="nav-link" href="signup.php">Sign up</a>
              </li>
            <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!-- header end -->
  <!-- slider start -->
  <section>
    <div class="row mb-5">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="images/banner1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block slider_text">
              <h5>Lorem, ipsum, dolor.</h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, distinctio?</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="images/banner2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block slider_text">
              <h5>Lorem, ipsum, dolor.</h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, distinctio?</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/banner3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block slider_text">
              <h5>Lorem, ipsum, dolor.</h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, distinctio?</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/banner4.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block slider_text">
              <h5>Lorem, ipsum, dolor.</h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, distinctio?</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div> 
  </section>
  <!-- slider end -->
  <!-- single card start-->
  <section class="container">
    <div class="row mt-5 mb-5">
      <div class="card border-0">
        <img src="images/singleCard.jpg" class="img-fluid w-auto card-img SCimg" alt="...">
        <div class="card-img-overlay singleCardText">
          <h5 class="card-title">Ocean</h5>
          <p class="card-text">The ocean (also known as the sea or the world ocean) is a body of salt water that covers approximately 70.8% of the Earth and contains 97% of Earth's water.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- single card end-->
  <!-- my blogs start -->
<section class="container">
  <div class="row mt-5 mb-5">
    <div class="col-md-12 text-center">
      <h2 class="cardH2">My Blogs</h2>
    </div>
    <?php while ($blog = $resultBlogs -> fetch_assoc()) {?>
     <div class="col-md-4 col-12 mb-2">
      <div class="card">
        <img src="images/<?php echo $blog['blgImg'] ?>" class="img-fluid" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $blog['blgTitle'] ?></h5>
          <p class="card-text"><?php echo $blog['blgText'] ?></p>
          <p class="card-text">
            <small class="text-muted">Last updated <?php echo $blog['curDate'] ?></small>
            <span class="text-primary"><?php echo $blog['username'] ?></span>
          </p>
        </div>
      </div>
    </div>
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
        <a href="register.php">Sign up</a>
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