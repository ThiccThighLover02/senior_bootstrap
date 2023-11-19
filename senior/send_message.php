<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include '../db_connect.php';
    if(isset($_SESSION['senior_status']) && $_SESSION['senior_status'] == "Active"){

        
        $incoming_id = $_POST['incoming'];
        $outgoing_id = $_POST['outgoing'];
        $message = $_POST['input-field'];
        $date = date("Y-m-d");
        $time = date("H:i:s");

        if(!empty($message)){
            $insert_message = $conn->prepare("INSERT INTO `message_tbl`(`messages`, `incoming_id`, `outgoing_id`, `message_time`, `message_date`) VALUES (?, ?, ?, ?, ?)");
            $insert_message->bind_param("siiss", $message, $incoming_id, $outgoing_id, $time, $date);
            $insert_message->execute();
        }

    }

    else{
        header("Location: ../index.php");
    }


?>
