<?php
    session_start();
    date_default_timezone_set("Asia/Manila");

    include "../db_connect.php";

    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
            
            #we will declare all of the variables that we will receive using the post method
            $post_desc = $_POST['description'];
            $post_date = $_POST['act_date'];
            $time_start = $_POST['time_start'];
            $time_end = $_POST['time_end'];
            $post_loc = $_POST['event_location'];
            $event_type_id = $_POST['event_type'];
            $date_created = date("Y-m-d");
            $time_created = date("H:i:s");


            #this is for the with_id pic

            $post_name = $_FILES['post-pics']['name'];
            $post_size = $_FILES['post-pics']['size'];
            $post_tmp_name = $_FILES['post-pics']['tmp_name'];
            $post_error = $_FILES['post-pics']['error'];

            if($post_error === 0){
                 if ($post_size > 16777215){
                 header("Location: create_acc.php?img_size=false"); #this will execute if the file ist too large
                 }
             
                 else {
                     $img_ex = pathinfo($post_name, PATHINFO_EXTENSION);
                     $img_ex_lc = strtolower($img_ex);

                     $allowed_exs = array("jpg", "jpeg", "png");

                     if(in_array($img_ex_lc, $allowed_exs)) {
                       date_default_timezone_set("Asia/Manila");
                       $new_post_name ="post" . date("Y") . random_int(1000, 9999) . "." . $img_ex_lc;
                       $img_upload_path = '../user/posts/post_pics/' . $new_post_name;
                       move_uploaded_file($post_tmp_name, $img_upload_path); 
                     }
                 }
             }

             if(isset($_SESSION['admin_status'])){
                $post_stmt = $conn->prepare("INSERT INTO `senior_system`.`activity_tbl` (`admin_id`, `event_type_id`, `post_description`, `post_pic`, `post_date`, `post_time`, `date_created`, `time_created`, `post_loc`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $post_stmt->bind_param("issssssss", $_SESSION['admin_id'], $event_type_id, $post_desc, $new_post_name, $post_date, $post_time, $date_created, $time_created, $post_loc);
                $post_stmt->execute();
                header("Location: admin_home.php");

             }

else{
    header("Location: index.php");
}
}


?>