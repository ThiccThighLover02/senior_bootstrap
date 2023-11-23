<?php
    session_start();
    include '../db_connect.php';
    #if there is a session this code will run
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
        $senior_id = $_GET['id'];
        #Before we delete the account, we have to get all the information
        $sel_sql = $conn->prepare("SELECT * FROM senior_tbl WHERE senior_id=?");
        $sel_sql->bind_param("i", $senior_id);
        $sel_sql->execute();
        $sel_result = $sel_sql->get_result();
        $row = mysqli_fetch_assoc($sel_result);

        #once we get the information we'll put it in the delete_tbl just in case
        $ins_del = $conn->prepare("INSERT INTO `del_tbl`(`senior_id`,`full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `date_birth`, `birth_place`, `sex`, `citizenship`, `age`, `blood_type`, `physical_disability`, `health`, `other_health`, `education`, `cell_no`, `emergency_no`, `religion`, `civil_status`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `qr_contents`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ins_del->bind_param("isssssiiiissssisssssiisssssssss", $row['senior_id'], $row['full_name'], $row['first_name'], $row['mid_name'], $row['last_name'], $row['extension'], $row['senior_purok_id'], $row['senior_barangay_id'], $row['senior_municipality_id'], $row['senior_province_id'], $row['date_birth'], $row['birth_place'], $row['sex'], $row['citizenship'], $row['age'], $row['blood_type'], $row['physical_disability'], $row['health'], $row['other_health'], $row['education'], $row['cell_no'], $row['emergency_no'], $row['religion_id'], $row['civil_id'], $row['senior_email'], $row['senior_password'], $row['qr_image'], $row['id_pic'], $row['birth_certificate'], $row['bar_certificate'], $row['qr_contents']);
        $ins_del->execute();
        header("Location: admin_view_seniors.php");

        #this is to delete the information in the senior_tbl
        $del_sql = $conn->prepare("DELETE FROM `senior_tbl` WHERE senior_id=?");
        $del_sql->bind_param("i", $senior_id);
        $del_sql->execute();

        #this will insert a event log in the event_tbl
        include 'delete_log_function';

    }
    else {
        header("Location: index.php");
    }
?>