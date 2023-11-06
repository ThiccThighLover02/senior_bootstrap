<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/phpmailer/phpMailer/src/Exception.php';
    require '../vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpMailer/src/SMTP.php';
    include "../db_connect.php";


    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){

        if(isset($_GET['request_id'])){
            $req_id = $_GET['request_id'];
            $sel_req = $conn->prepare("SELECT * FROM request_tbl WHERE request_id=?");
            $sel_req->bind_param("i", $req_id);
            $sel_req->execute();
            $sel_res = $sel_req->get_result();
            $row = mysqli_fetch_assoc($sel_res);

            $birth_original = "../user/requests/birth_certificates/" . $row['birth_certificate'];
            $id_original = "../user/requests/id_pics/" . $row['id_pic'];
            $bar_original = "../user/requests/barangay_certificates/" . $row['barangay_certificate'];

            if(file_exists($birth_original)){
                unlink($birth_original);
                if(file_exists($id_original)){
                    unlink($id_original);
                    if(file_exists($bar_original)){
                        unlink($bar_original);
                        if(file_exists()){
                            unlink($valid_original);
                        }
                    }
                }
            }
        $sql = $conn->prepare("SELECT * FROM request_tbl WHERE request_id=?");
        $sql->bind_param("i", $req_id);
        $sql->execute();
        $result = $sql->get_result();
        $row = mysqli_fetch_assoc($result);
        
        $subject = "Account Approval";
        $message = "Hello, " . $row['first_name'] . " " . $row['last_name'] . ", we are sorry to inform you but your request has been rejected, 
        this may be due to you not providing the requirements for verification, or false information has been given. Please try again and provide clear pictures for better verification.";
        $emailadd = $row['user_email'];

        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seniorcitizensystem@gmail.com';
        $mail->Password = 'qkjtmhbkbuqnixdj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('seniorcitizensystem@gmail.com');
        $mail->addAddress('magtalascarlson@gmail.com');
        $mail->isHTML(true);
        
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        $mail->send();

            


        $del_req = $conn->prepare("DELETE FROM request_tbl WHERE request_id=?");
        $del_req->bind_param("i", $req_id);
        $del_req->execute();
        }

        header("Location: admin_requests.php?deleted=true");
}

else{
    header("Location: admin_login.php");
}
?>