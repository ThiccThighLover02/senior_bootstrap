<?php
    session_start();
    include '../db_connect.php';
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
        if(isset($_GET['post']) && $_GET['post'] == "edit"){
            $title = $_POST['post_title'];
            $type = $_POST['post_type'];
            $desc = $_POST['description'];
            $post_date = $_POST['act_date'];
            $post_loc = $_POST['event_location'];
            $time_start = $_POST['time_start'];
            $time_end = $_POST['time_end'];
            $post_id = $_GET['id'];
            $update_id = $conn->prepare("UPDATE `activity_tbl` SET `post_title`=?,`post_type`=?,`post_description`=?,`post_date`=?,`post_loc`=?,`time_start`=?,`time_end`=? WHERE post_id=?");
            $update_id->bind_param("sssssssi", $title, $type, $desc, $post_date, $post_loc, $time_start, $time_end, $post_id);
            $update_id->execute();

            header("Location: admin_home.php?updated=true");
        }

        elseif(isset($_GET['post']) && $_GET['post'] == "delete"){
            $post_id = $_GET['id'];
            $update_id = $conn->prepare("DELETE FROM `activity_tbl` WHERE post_id=?");
            $update_id->bind_param("i", $post_id);
            $update_id->execute();

            header("Location: admin_home.php?delete=true");
        }
    }

    else{
        header("Location: ../index.php");
    }
?>