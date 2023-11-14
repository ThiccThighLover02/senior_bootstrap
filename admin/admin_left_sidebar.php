<!-- This is the offcanvas container -->
<?php
          include "nav_style.php";

?>
<div class="col-lg-2 sticky-top">
    <div class="offcanvas-lg offcanvas-start"  id="sideDiv">
        <ul class="nav nav-pills flex-column gap-3 side_menu_left">
          <li class="nav-item">
            <a class="nav-link <?= $active === "actHome" ? "active":""; ?> fs-5" aria-current="page" href="admin_home.php"><i class="fa-solid fa-home fa-lg"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actSenior" ? "active":""; ?> fs-5" href="admin_view_seniors.php"><i class="fa-solid fa-person-cane fa-lg"></i>  Seniors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actRequest" ? "active":""; ?> fs-5" href="admin_requests.php"><i class="fa-solid fa-file fa-lg"></i> Requests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actEvent" ? "active":""; ?> fs-5" href="admin_event_logs.php"><i class="fa-solid fa-book fa-lg"></i> Event Logs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actActivities" ? "active":""; ?> fs-5" href="admin_activities.php"><i class="fa-solid fa-calendar fa-lg"></i>   Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actMessage" ? "active":""; ?> fs-5" href="admin_message.php"><i class="fa-solid fa-message fa-lg"></i>   Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="../admin_logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i> Logout</a>
          </li>
        </ul>
    </div>
</div>
<!-- 
<div class="col-lg-2 d-flex flex-column" style="height: fit-content">
    <button class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-home fa-lg"></i> Home</button>
    <button class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-user fa-lg"></i> Users</button>
    <button class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-person-cane fa-lg"></i>  Seniors</button>
    <button class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-file fa-lg"></i> Requests</button>
    <button class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-book fa-lg"></i> Event Logs</button>
    <button class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-person-walking fa-lg"></i>   Activites</button>
    <a href="senior_logout.php" class="btn btn-block btn-primary btn-lg text-white text-start left-div-buttons"><i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i> Logout</a>
</div> -->