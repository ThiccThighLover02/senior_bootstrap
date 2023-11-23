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

    #about_logo {
        width: 10vw;
    }
  </style>
  <title>Document</title>
</head>
<body>
  <?php
    include 'landing-navbar.php';
  ?>

  <div class="container-lg container-md ps-5 pe-5 pt-3">
   <div class="row">
    <div class="col bg-white rounded rounded-4 overflow-auto d-flex flex-column align-items-center pt-4 pe-5 ps-5" id="collapse-contain">
        <img src="munisipyo.png" alt="" id="about_logo" class="img-fluid mb-4">
        <h2>About Us</h2>
        <p class="fs-5 mb-4">The Municipality of San Isidro's Office of Senior Citizens Affairs (OSCA) is a committed center of advocacy and service in the center of community care and assistance for our beloved senior citizens.</p>

        <h2>Taking Care of Our Seniors</h2>
        <p class="fs-5 mb-4">Our senior residents' empowerment, well-being, and dignity are our top priorities at OSCA San Isidro. We work hard to provide an atmosphere where our elderly can flourish because we acknowledge their priceless contributions to the community.</p>

        <h2>Programs and Services</h2>
        <p class="fs-5 mb-4">With a variety of services and programs catered to the special requirements of our elderly residents, our office serves as a central point for help. With programs promoting health and wellness and social events that strengthen bonds, OSCA works to improve the lives of our senior citizens.</p>

        <h2>Promoting Human Rights</h2>
        <p class="fs-5 mb-4">Senior citizen rights and advantages are something that OSCA San Isidro is fiercely committed to defending. In order to foster inclusivity and a sense of belonging, we put forth great effort to make sure that our elderly receive the respect, consideration, and care that they so richly deserve.</p>

        <h2>Engaging the Community</h2>
        <p class="fs-5 mb-4">In addition to providing services, OSCA actively interacts with the older population, promoting involvement and participation. Our mission is to provide a caring community where elderly citizens can continue to actively contribute to San Isidro's vibrant fabric by exchanging experiences and insights.</p>

        <h2>Bringing the Golden Years to Life</h2>
        <p class="fs-5 mb-4">OSCA San Isidro is committed to enabling our senior adults to experience active and satisfying lives during their golden years as we travel the road of aging together. Our dedication to community involvement and compassion is evident in every facet of our work.</p>

        <h2>Come Along</h2>
        <p class="fs-5 mb-4">OSCA San Isidro invites your participation, whether you're a community member wishing to give back or a senior in need of assistance. Let's work together to build a community that celebrates, values, and respects all older citizens.</p>

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