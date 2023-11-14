<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "admin_links.php";
    ?>
    <title>Admin Login</title>
    <style>
      .logo {
      width: 4vw;
    }

    .nav-drop {
      background-color: transparent;
      border: none;
      width: fit-content;
    }

    .nav-header{  
      background: linear-gradient(269deg, #FFFC00 -3.68%, rgba(255, 255, 255, 0.00) 118.38%);
    }

    .next-nav{
      background: linear-gradient(180deg, #00AD03 0%, rgba(0, 173, 3, 0.23) 171.71%, rgba(0, 173, 3, 0.00) 717.49%);
    }

    .next-nav-contain {
      width: 100%;
    }
    </style>
</head>
<body class="bruh" style="background-image: url('../munisipyobckgrnd.jpg'); background-size: cover;">
  <!-- navbar starts here -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light nav-header">
      <div class="container-fluid">
          <a class="navbar-brand d-flex align-items-center gap-3" href="#">
            <img src="../munisipyo.png" alt="" class="d-inline-block align-text-top logo">
            <b class="fs-2">Senior Citizen System</b>
          </a>      
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-buttons" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>


      </div>
    </nav>
    <nav class="nav collapse navbar-collapse fs-4 d-flex gap-5 next-nav d-flex justify-content-center" id="nav-buttons">
      <a class="nav-link text-white active" aria-current="page" href="../index.php">Home</a>
      <a class="nav-link text-white" href="../about.php">About Us</a>
      <a class="nav-link text-white" href="../faq.php">FAQ</a>
      <a class="nav-link text-white" href="../contact.php" tabindex="-1">Contact Us</a>
      <button class="btn btn-secondary dropdown-toggle nav-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      Dropdown button
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><a class="dropdown-item" href="admin/admin_login.php">Admin Login</a></li>
      <li><a class="dropdown-item" href="../senior/senior_login.php">Senior Login</a></li>
    </ul>
    </nav>
    <!-- navbar ends here -->
    <div class="container bg-white mt-3 p-5 rounded" style="width: 50vw;">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img src="../munisipyo.png" alt="" class="image-responsive" style="width: 10vw;">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h1>Admin Login</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="admin_check.php" method="post" class="d-flex flex-column gap-2">
                  <div class="form-group">
                    <label for="formGroupExampleInput" class="fs-4">Email Address</label>
                    <input type="text" name="email" class="form-control form-control-lg" id="formGroupExampleInput" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2" class="fs-4">Password</label>
                    <input type="password" name="password" id="pass_word" class="form-control form-control-lg" id="formGroupExampleInput2" placeholder="">
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" onclick="show_pass()" style="width: 2vw; height: 2vw">
                    <label for="" class="fs-4">Show Password</label>
                  </div>
                  <button type="submit" name="submit" class="btn btn-block btn-primary text-white fs-4">Login</button>
                </form>
                

            </div>
        </div>
    </div>
</body>
<script>
    function show_pass() {
      var x = document.getElementById("pass_word");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
</html>