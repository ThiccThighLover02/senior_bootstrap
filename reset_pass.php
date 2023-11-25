<?php
    date_default_timezone_set("Asia/Manila");
    include "db_connect.php";
    $sql = $conn->prepare("SELECT * FROM reset_tbl WHERE senior_email=? AND token=?");
    $sql->bind_param("ss", $_GET['email'], $_GET['token']);
    $sql->execute();
    $result = $sql->get_result();
    $row = mysqli_fetch_assoc($result);

    if(isset($_GET['email']) && $_GET['token'] == $row['token']){
        if($row['token_expire'] > date('Y-m-d H:i:s')){
?>


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
                <h1>Forgot Password? HAHA</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="send_email.php?reset=true&email=<?= $_GET['email'] ?>" method="post" class="d-flex flex-column gap-2" id="reset-form">
                <div class="form-group">
                    <label for="formGroupExampleInput" class="fs-4">Enter New Password:</label>
                    <input type="password" name="new_pass" class="form-control form-control-lg" id="pass1" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput" class="fs-4">Confirm Password:</label>
                    <input type="password" name="new_pass" class="form-control form-control-lg" id="pass2" placeholder="" required>
                  </div>
                  
                  <button type="submit" class="btn btn-block btn-primary text-white">Reset Password</button>
                  
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
    $(document).ready(function(){
      $("#reset-form").on("submit", function(e){
        var pass1 = $("#pass1").val();
        var pass2 = $("#pass2").val();
        if(pass1 != pass2){
          e.preventDefault();
          alert("The password does not match");
        }
      })
    })

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


<?php
        }
        else{
            header("Location: index.php");
        }
    }
    else{
        header("Location: index.php");
    }
?>