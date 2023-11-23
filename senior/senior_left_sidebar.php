<!-- This is the offcanvas container -->
<?php
  $emp_id = $_SESSION['senior_id'];
  $id_pic = $conn->prepare("SELECT id_pic FROM senior_tbl WHERE senior_id=?");
  $id_pic->bind_param("i", $emp_id);
  $id_pic->execute();
  $id_result = $id_pic->get_result();
  $row = mysqli_fetch_assoc($id_result);
?>
<div class="col-lg-3 sticky-top">
    <div class="offcanvas-lg offcanvas-start"  id="sideDiv">
        <ul class="nav nav-pills flex-column gap-3 side_menu_left">
          <li class="nav-item">
            <a class="nav-link fs-5" aria-current="page" href="../index.php"><i class="fa-solid fa-arrow-left fa-xl"></i> Return</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actProfile" ? "active":""; ?> fs-5" aria-current="page" href="senior_view_profile.php?id=<?= $_SESSION['senior_id'] ?>"><img src="senior_pics/id_pics/<?= $row['id_pic'] ?>" alt="" class="img-fluid ratio ratio-1x1 rounded-circle" style="width: 3vw"> Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actHome" ? "active":""; ?> fs-5" aria-current="page" href="senior_home.php"><i class="fa-solid fa-home fa-xl"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actActivities" ? "active":""; ?> fs-5" href="senior_activities.php"><i class="fa-solid fa-calendar fa-xl"></i>   Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $active === "actMessage" ? "active":""; ?> fs-5" href="senior_message.php"><i class="fa-solid fa-message fa-xl"></i>   Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="../senior_logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-xl"></i> Logout</a>
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