<?php
    include '../db_connect.php';
    date_default_timezone_set("Asia/Manila");
    if(isset($_POST['product_id'])){
    $post_id = $_POST['product_id'];
    $sql = $conn->prepare("SELECT * FROM activity_tbl WHERE post_id=?");
    $sql->bind_param("i", $post_id);
    $sql->execute();
    $result = $sql->get_result();
    $row = mysqli_fetch_assoc($result);
?>
    <h2>Title: <?= $row['post_title'] ?></h2>
    <h3>Post Description:</h3>
    <p class="fs-4"><?= $row['post_description'] ?></p>
    <div class="row">
        <div class="col-6 d-grid">
        <?php
            if($row['post_date'] < date("Y-m-d") || $row['post_date'] > date("Y-m-d")){
        ?>
            <button class="btn btn-primary text-white" disabled>Scan</button>
        <?php
            }
            elseif($row['post_date'] == date("Y-m-d")){
        ?>
            <a href="admin_event_scan.php?event_id=<?= $row['post_id'] ?>&scan=true" class="btn btn-primary text-white" id="scanBtn">Scan</a>
        <?php
            }
        ?>
        </div>
        <div class="col-6 d-grid">
            <a href="admin_event_details.php?id=<?= $post_id ?>" class="btn btn-info">Event Details</a>
        </div>
    </div>

<?php
    }
?>