<?php
    include '../db_connect.php';
    if(isset($_POST['product_id'])){
    $post_id = $_POST['product_id'];
    $sql = $conn->prepare("SELECT * FROM activity_tbl WHERE post_id=?");
    $sql->bind_param("i", $post_id);
    $sql->execute();
    $result = $sql->get_result();
    $row = mysqli_fetch_assoc($result);
?>
    <h5><?= $row['post_id'] ?></h5>
    <h5>Title: <?= $row['post_title'] ?></h5>
    <h5>Event Id: <?= $row['event_type_id'] ?></h5>
    <h5>Post Description:</h5>
    <p><?= $row['post_description'] ?></p>
<?php
    }
?>