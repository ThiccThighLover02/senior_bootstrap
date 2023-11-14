<?php 

session_start(); //start the session so it will remember the delcared sessions below

include "db_connect.php";

if (isset($_POST['email']) && isset($_POST['password'])){

    function validate($data){ #this validates the data

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $username = validate($_POST['email']); #get the username using the post method

    $pass = validate($_POST['password']); #get the password using the post method

    #We will be using prepared statement for more security
    $senior = $conn->prepare("SELECT * FROM senior_tbl WHERE senior_email=? AND senior_password=?"); #select all from your table where the username is equal to $uname and password is equal to $pass
    $senior->bind_param("ss", $username, $pass);
    $senior->execute();
    $result = $senior->get_result();
    $row = $senior->num_rows();

    $admin = $conn->prepare("SELECT * FROM admin_tbl WHERE admin_username=? AND admin_password=?");
    $admin->bind_param("ss", $username, $pass);
    $admin->execute();
    $admin_result = $admin->get_result();
    $admin_row = mysqli_num_rows($admin_result);




    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        date_default_timezone_set("Asia/Manila");

        $senior_id = $row['senior_id'];
        $full_name = $row['full_name'];
        $log_date = date("Y-m-d");
        $log_time = date("H:i:s");
        $session_no = random_int(100000, 999999);

        /*
        $stmt = $conn->prepare("INSERT INTO `senior_log` (`login_name`, `login_date`, `login_time`, `senior_id`, `session_no`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $full_name, $log_date, $log_time, $senior_id, $session_no);
        $stmt->execute();
        */

        if ($row['senior_email'] === $username && $row['senior_password'] === $pass) { //if the username and password is correct this code will run

            $_SESSION['senior_status'] = "Active";

            $_SESSION['senior_email'] = $row['senior_email']; //create a username session

            $_SESSION['senior_id'] = $row['senior_id'];   //create a id session

            $_SESSION['senior_message'] = $row['message_id'];

            #a prepared statement to update the status of the senior citizen to "Active"
            $active = "Active"; #we declared this variable because apparently we need a reference for a prepared statement -_-
            $stmt = $conn->prepare("UPDATE senior_tbl SET status= ? WHERE senior_id= ?");
            $stmt->bind_param("si", $active, $row['senior_id']);
            $stmt->execute();

            header("Location:senior/senior_home.php");

            exit();

        }
        
        else{

            
            header("Location: login.php?error=true"); //if the password is incorrect this will run
            

            exit();

        }

    }
        
    elseif($admin_row === 1){

        $admin_row = mysqli_fetch_assoc($admin_result);

        date_default_timezone_set("Asia/Manila");

        $admin_id = $row['admin_id'];
        $full_name = $row['full_name'];
        $log_date = date("Y-m-d");
        $log_time = date("H:i:s");
        $session_no = random_int(100000, 999999);

        /*
        $stmt = $conn->prepare("INSERT INTO `senior_log` (`login_name`, `login_date`, `login_time`, `senior_id`, `session_no`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $full_name, $log_date, $log_time, $senior_id, $session_no);
        $stmt->execute();
        */

        if ($admin_row['admin_username'] === $username && $admin_row['admin_password'] === $pass) { //if the username and password is correct this code will run

            $_SESSION['admin_status'] = "Active";

            $_SESSION['admin_username'] = $admin_row['admin_username']; //create a username session

            $_SESSION['admin_id'] = $admin_row['admin_id'];   //create a id session

            $_SESSION['admin_message'] = $admin_row['message_id']; //session for chats

            #a prepared statement to update the status of the senior citizen to "Active"
            $active = "Active"; #we declared this variable because apparently we need a reference for a prepared statement -_-
            $stmt = $conn->prepare("UPDATE admin_tbl SET admin_status= ? WHERE admin_id= ?");
            $stmt->bind_param("si", $active, $admin_row['admin_id']);
            $stmt->execute();

            header("Location:admin/admin_home.php");

            exit();

        }
        
        else{

            
            header("Location: login.php?error=true"); //if the password is incorrect this will run
            

            exit();

        }

    }

    else {
        header("Location: login.php?error=true");
    }


}
?>