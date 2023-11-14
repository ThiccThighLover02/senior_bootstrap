<?php
  session_start();
  if(isset($_SESSION['senior_status']) && $_SESSION['senior_status'] == "Active"){
    $home = "senior/senior_home.php";
  }
  elseif (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
    $home = "admin/admin_home.php";
  }

  else{
    $home = "index.php";
  }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light nav-header">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-3" href="index.php">
          <img src="munisipyo.png" alt="" class="d-inline-block align-text-top logo">
          <b class="fs-2">Senior Citizen System</b>
        </a>      
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav-buttons" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


    </div>
  </nav>
    <nav class="nav offcanvas-lg offcanvas-end fs-4 d-flex gap-5 next-nav d-flex justify-content-end" id="nav-buttons">
      <a class="nav-link text-white active" aria-current="page" href="<?= $home ?>">Home</a>
      <a class="nav-link text-white" href="about.php">About Us</a>
      <a class="nav-link text-white" href="faq.php">FAQ</a>
      <a class="nav-link text-white" href="contact.php" tabindex="-1">Contact Us</a>
      <a class="nav-link text-white" href="login.php" tabindex="-1">Login</a>
      <a class="nav-link text-white" href="senior/senior_create_acc.php" tabindex="-1">Sign up</a> 
    </nav>