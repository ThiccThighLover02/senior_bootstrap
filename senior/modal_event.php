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

<?php
    }
?>