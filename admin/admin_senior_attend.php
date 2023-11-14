<?php
    include '../db_connect.php';
    session_start();
    date_default_timezone_set("Asia/Manila");
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $qr_content = $_GET['qr_content'];
        $event_id = $_GET['event_id'];
        $sql = $conn->prepare(" SELECT * FROM senior_tbl WHERE qr_contents=?");
        $sql->bind_param("s", $qr_content);
        $sql->execute();
        $result = $sql->get_result();
        $row = mysqli_fetch_assoc($result);

        $attend_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_attend=?");
        $attend_sql->bind_param("ii", $event_id, $row['senior_id']);
        $attend_sql->execute();
        $attend_result = $attend_sql->get_result();
        $attend_rows = mysqli_num_rows($attend_result);


        if($attend_rows == 0){
            $insert_sql = $conn->prepare("INSERT INTO `attend_tbl`(`activity_id`, `senior_attend`, `senior_barangay`, `attend_date`, `attend_time`) VALUES (?, ?, ?, ?, ?)");
            $insert_sql->bind_param("iiiss", $event_id, $row['senior_id'], $row['senior_barangay_id'], $date, $time);
            $insert_sql->execute();

            header("Location: admin_event_scan.php?event_id=" . $event_id . "&scan=true&attended=true");
        }

        else{
            header("Location: admin_event_scan.php?event_id=" . $event_id . "&scan=true&exist=true");
        }
    }
?>