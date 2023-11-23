<?php
  include 'db_connect.php';
  $post_sql = mysqli_query($conn, "SELECT * FROM activity_tbl A LEFT JOIN admin_tbl Ad ON A.post_admin_id=Ad.admin_id  ORDER BY date_created DESC, time_created DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
    include 'links.php';
  ?>
  <style>
    body{
      background-image: url("munisipyobckgrnd.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }

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

    #collapse-contain {
        height: 75vh;
    }
  </style>
  <title>Document</title>
</head>
<body>
  <?php
    include 'landing-navbar.php';
  ?>

  <div class="container-fluid ps-5 pe-5 pt-3">
   <div class="row">
    <div class="col bg-white rounded rounded-4 overflow-auto" id="collapse-contain">
        <div class="row border border-bottom">
            <div class="col p-3">
                <div class="toggle d-flex align-items-center justify-content-between" role="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseExample">
                    <h1 class="">What are the requirements to register as a senior citizen?</h1>
                    <i class="fa-solid fa-plus fa-2xl"></i>
                </div>

                <div class="collapse-div collapse" id="collapse1">
                    <div class="card card-body mb-3">
                        <p class="fs-3">What you will need to register are:</p>
                        <ul class="fs-5">
                            <li>2x2 picture</li>
                            <li>Picture of birth certificate</li>
                            <li>Picture of barangay certificate</li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row border border-bottom">
            <div class="col p-3">
                <div class="toggle d-flex align-items-center justify-content-between" role="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseExample">
                    <h1 class="">How will I be able log in after registering?</h1>
                    <i class="fa-solid fa-plus fa-2xl"></i>
                </div>

                <div class="collapse-div collapse" id="collapse2">
                    <div class="card card-body mb-3">
                        <p class="fs-5">
                            After you have registered you will have to wait for your account to be approved, you will be notified if your account has been approved via email.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row border border-bottom">
            <div class="col p-3">
                <div class="toggle d-flex align-items-center justify-content-between" role="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseExample">
                    <h1 class="">How will I know when there are events or activites?</h1>
                    <i class="fa-solid fa-plus fa-2xl"></i>
                </div>

                <div class="collapse" id="collapse3">
                    <div class="card card-body mb-3">
                        <p class="fs-5">
                            You will be able to see the events activities in the news page, or you can view the activities and their details in the calendar page
                        </p>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row border border-bottom">
            <div class="col p-3">
                <div class="toggle d-flex align-items-center justify-content-between" role="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapseExample">
                    <h1 class="">What do I do if I forgot my password?</h1>
                    <i class="fa-solid fa-plus fa-2xl"></i>
                </div>

                <div class="collapse" id="collapse4">
                    <div class="card card-body mb-3">
                        <p class="fs-5">
                            If you have forgotten your password, you can go to the log in page, and there is an option "forgot password", go there and input your email, then a code will be sent to your email for you to recover your password.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
   </div>
  </div>

</body>

<script>
  document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function(){
          $("#scanBtn").on("click", function(){
            console.log("You pressed the scan btn");
          })
        });
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          contentHeight: "auto",
          fixedWeekCount: false,
          themeSystem: 'bootstrap5',
          events: 'calendar_events.php',
          eventClick: function(info){
            $.ajax({
                method: "POST",
                url: "modal_event.php",
                data: {
                    "product_id": info.event.id
                },
                success: function(response){
                    $(".edit-modal").html(response);
                    $("#view-edit-modal").modal('show');
                    console.log(response);
                }

            })
          }
        });
        calendar.render();
      });
</script>
</html>