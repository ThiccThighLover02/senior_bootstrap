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
  </style>
  <title>Document</title>
</head>
<body>
  <?php
    include 'landing-navbar.php';
  ?>

  <div class="container-fluid ps-5 pe-5 pt-3">
    <div class="row">
      <div class="col-lg-6 col-12 overflow-y-scroll rounded-top rounded-3" style="height: 75vh">
        <div class="row bg-primary">
          <h3 class="text-center text-white">Senior Activities</h3>
        </div>
      <?php
        $post_sql = mysqli_query($conn, "SELECT * FROM activity_tbl A LEFT JOIN admin_tbl Ad ON A.post_admin_id=Ad.admin_id LEFT JOIN emp_tbl E ON A.post_emp_id=E.emp_id ORDER BY date_created DESC, time_created DESC");
        
        while($row = mysqli_fetch_assoc($post_sql)){
          $date_create = new DateTime($row['date_created']);
          $time_create = new DateTime($row['time_created']);
          $post_pic = "";
      ?>
        <div class="row mb-3">
          <div class="col-lg-12 shadow bg-white rounded">
            <!-- Post header -->
            <div class="row">
              <div class="col-6 p-2">
                <div class="row d-flex">
                <?php
                  if(!is_null($row['post_admin_id'])){
                    $post_pic = "admin/admin_pic/admin_pic.jpg";
                    $post_name = "Admin";
                  }
                  elseif(!is_null($row['post_emp_id'])){
                    $post_pic = "user/user_pics/" . $row['id_pic'];
                    $post_name = $row['full_name'];
                  }
                ?>
                  <div class="col-3">
                    <img class="img-fluid rounded-circle" src="<?= $post_pic ?>" alt="" style="width: 7vw">
                  </div>
                  <div class="col-9">
                    <div class="row">
                      <div class="col-12">
                        <h4><?= $post_name ?></h4>
                      </div>
                      <div class="col-12">
                        <p class="fs-5"><?= $date_create->format("M d, Y") . " . " .$time_create->format("H:iA") ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <i class="fa-solid fa-ellipsis-h fa-2xl float-end p-4"></i>
              </div>
            </div>
            <!-- Post header ends here -->
            <!-- Post Description -->
            <div class="row">
              <div class="col-12">
                <p><?= $row['post_description'] ?></p>
              </div>
            </div>
            <!-- Post image -->
            <div class="row">
              <img class="img-fluid mb-3" src="user/post_pics/<?= $row['post_pic'] ?>" alt="">
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>

      <div class="col-lg-6 col-12">
        <div class="bg-white p-2 rounded-2" id="calendar">

        </div>
      </div>
    </div>
    <!-- <div id="carouselExampleIndicators" class="carousel slide slideshow" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner d-flex align-items-center">
        <div class="carousel-item active">
          <img src="pictures/senior_image.jpg" class="d-block h-100 w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="pictures/senior_image.png" class="d-block h-100 w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> -->
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