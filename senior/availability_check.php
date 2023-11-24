<?php
    include '../db_connect.php';
    if(isset($_GET['contact1']) && $_GET['contact1'] == 'true'){
        $contact_no = $_POST['cell_no'];
        $contact = $conn->prepare("SELECT * FROM senior_tbl WHERE cell_no=? OR emergency_no=?");
        $contact->bind_param("ii", $contact_no, $contact_no);
        $contact->execute();
        $result = $contact->get_result();
        $contact_row = mysqli_num_rows($result);

        if($contact_row > 0){
            echo "exists";
        }
        else{
            echo "available";
        }
    }
    elseif(isset($_GET['contact2']) && $_GET['contact2'] == 'true'){
        $emergency_no = $_POST['emergency_no'];
        $emergency = $conn->prepare("SELECT * FROM senior_tbl WHERE emergency_no=? OR cell_no=?");
        $emergency->bind_param("ii", $emergency_no, $emergency_no);
        $emergency->execute();
        $emergency_result = $emergency->get_result();
        $emergency_row = mysqli_num_rows($emergency_result);

        if($emergency_row > 0){
            echo "exists";
        }
        else{
            echo "available";
        }
    }

    elseif(isset($_GET['email']) && $_GET['email'] == 'true'){
        $email = $_POST['email'];
        $email_sql = $conn->prepare("SELECT * FROM senior_tbl WHERE senior_email=?");
        $email_sql->bind_param("s", $email);
        $email_sql->execute();
        $email_result = $email_sql->get_result();
        $email_row = mysqli_num_rows($email_result);

        if($email_row > 0){
            echo "exists";
        }
        else{
            echo "available";
        }
    }

?>