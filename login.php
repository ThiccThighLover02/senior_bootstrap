<?php
  session_start();
  // if(isset($_SESSION['admin_status'])){
  //   header("Location: admin/admin_home.php");
  // }
  // elseif(isset($_SESSION['senior_status'])){
  //   header("Location: senior/senior_home.php");
  // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "links.php";
        include "nav_style.php";
    ?>
    <title>Document</title>
</head>
<body class="bruh" style="background-image: url('munisipyobckgrnd.jpg'); background-size: cover;">
<?php
  include 'landing-navbar.php';
?>
    <div class="container bg-white mt-3 p-5 rounded" style="">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img src="munisipyo.png" alt="" class="image-responsive" style="width: 10vw;">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h1>Senior Citizen Login</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="login_check.php" method="post" class="d-flex flex-column gap-2">
                  <div class="form-group">
                    <label for="formGroupExampleInput" class="fs-4">Email Address</label>
                    <input type="text" name="email" class="form-control form-control-lg" id="formGroupExampleInput" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2" class="fs-4">Password</label>
                    <input type="password" name="password" id="pass_word" class="form-control form-control-lg" id="formGroupExampleInput2" placeholder="">
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" style="height: 3vh; width: 3vh" onclick="show_pass()">
                    <label for="" class="text-lg fs-5">Show Password</label>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary text-white">Login</button>
                  <a href="senior/senior_create_acc.php" class="btn btn-block btn-dark text-white">
                    Sign Up
                  </a>
                  <a href="senior/senior_forgot.php" class="text-center" style="text-decoration: none;">Forgot Password</a>
                </form>
                

            </div>
        </div>
    </div>
</body>
<script>
    <?php
      if(isset($_GET['request']) == 'sent'){
    ?>
      alert("Your request has been sent, you will be notified via email if your request has been approved or not");
    <?php
      }

      elseif(isset($_GET['error']) && $_GET['error'] == 'true'){
    ?>
        alert("Incorrect username or password, please try again");
    <?php
      }
    ?>
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