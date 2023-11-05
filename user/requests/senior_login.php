<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "senior_links.php";
    ?>
    <title>Document</title>
</head>
<body class="bruh" style="background-image: url('../munisipyobckgrnd.jpg'); background-size: cover;">
    <div class="container bg-white mt-3 p-5 rounded" style="width: 50vw;">
        <div class="row">
            <div class="col">
                <a href="../index.php"><i class="fa-solid fa-arrow-left fa-2xl"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img src="../munisipyo.png" alt="" class="image-responsive" style="width: 10vw;">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h1>Senior Citizen Login</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="senior_check.php" method="post" class="d-flex flex-column gap-2">
                  <div class="form-group">
                    <label for="formGroupExampleInput">Email Address</label>
                    <input type="text" class="form-control form-control-lg" id="formGroupExampleInput" placeholder="Email Address">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Password</label>
                    <input type="password" id="pass_word" class="form-control form-control-lg" id="formGroupExampleInput2" placeholder="Password">
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" onclick="show_pass()">
                    <label for="" class="text-lg">Show Password</label>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary">Login</button>
                  <a href="senior_create_acc.php" class="btn btn-block btn-info text-white">
                    Sign Up
                  </a>
                  <a href="senior_forgot.php" class="text-center" style="text-decoration: none;">Forgot Password</a>
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