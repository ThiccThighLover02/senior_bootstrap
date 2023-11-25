<?php
    date_default_timezone_set("Asia/Manila");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'vendor/phpmailer/phpMailer/src/Exception.php';
    require 'vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpMailer/src/SMTP.php';
    include "db_connect.php";

    if(isset($_POST['email'])){
        #decalre the email
        $email = $_POST['email'];
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $sql = $conn->prepare("SELECT * FROM senior_tbl WHERE senior_email=?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        $row = mysqli_fetch_assoc($result);

        $insert = $conn->prepare("INSERT INTO `reset_tbl`(`senior_id`, `senior_email`, `token`, `token_expire`) VALUES (?, ?, ?, ?)");
        $insert->bind_param("isss", $row['senior_id'], $email, $token, $expiry);
        $insert->execute();

        $subject = "Password Reset";
        $message = "Hello " . $first_name . " " . $last_name . ", here is the link to reset your password. <br>

        <a> localhost/new_system/reset_pass.php?email=" . $email . "&token=" . $token . "</a> <br>";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seniorcitizensystem@gmail.com';
        $mail->Password = 'qkjtmhbkbuqnixdj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('seniorcitizensystem@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        header("Location: login.php?reset=true");
    }

    elseif(isset($_GET['reset']) && $_GET['reset'] == 'true'){
        $new_pass = $_POST['new_pass'];
        $pass_data = password_hash($new_pass, PASSWORD_DEFAULT);
        $email = $_GET['email'];

        $sql = $conn->prepare("UPDATE senior_tbl SET senior_password=? WHERE senior_email=?");
        $sql->bind_param("ss", $pass_data, $email);
        $sql->execute();

        header("Location: login.php?changed=true");
    }
    else{
        header("Location: index.php");
    }
?>