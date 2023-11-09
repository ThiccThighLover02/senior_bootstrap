<?php
    include('../db_connect.php');
   #declare all of the variables that we will use

  date_default_timezone_set("Asia/Manila");

//    Full Name 
   $firstN = $_POST['first_name'];
   $midN = $_POST['middle_name'];
   $lastN = $_POST['last_name'];
   $extension = $_POST['extension'];
   $full_name = $firstN . " " . $midN . " " . $lastN;
//    Address
   $purok = $_POST['purok'];
   $barangay = $_POST['barangay'];
   $municipality = $_POST['municipality'];
   $province = $_POST['province'];
//    Birth Information
   $birth_date = $_POST['birth_date'];
   $birth_place = $_POST['birth_place'];
   $citizen = $_POST['citizenship'];
   $sex = $_POST['sex'];
//    Health Related Information
   $blood_type = $_POST['blood_type'];
   $physical_disability = $_POST['physical_disability'];
   $check_conditions = serialize($_POST['health']);
   $other_conditions = $_POST['other_health']; 
//    Highest Educational Attainment
   $education = $_POST['education'];
//    Contact Information
   $email = $_POST['email'];
   $cellno = $_POST['cell_no'];
   $emergency_no = $_POST['emergency_no'];

//    Other Information
   $civil_stat = $_POST['civil_status'];
   $religion = $_POST['religion'];
   
   $request_date = date("Y-m-d");
   $request_time = date("H:i:s");
   
  #this will compute the seniors age
  $birthday = $_POST['birth_date'];

  $birthday = new DateTime($birthday);
  $interval = $birthday->diff(new DateTime);
  $age = $interval->y;

   #this is for the birthcertificate
   $birth_cert = $_FILES['birth_certificate']['name'];
   $birth_size = $_FILES['birth_certificate']['size'];
   $birth_temp_name = $_FILES['birth_certificate']['tmp_name'];
   $birth_error = $_FILES['birth_certificate']['error'];
   if($birth_error === 0){
    if ($birth_size > 16777215){
     header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
    }

    else {
        $img_ex = pathinfo($birth_cert, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png");

        if(in_array($img_ex_lc, $allowed_exs)) {
          date_default_timezone_set("Asia/Manila");
          $new_birth_name =$firstN . "_" . $midN . "_" . $lastN . "birth_cert" . "." . $img_ex_lc;
          $img_upload_path = '../user/requests/birth_certificates/' . $new_birth_name;
          move_uploaded_file($birth_temp_name, $img_upload_path);
            
            
        }
        else{
            header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
        }
    }
}
   


   #this is for the with_id pic
   $id_name = $_FILES['id_pic']['name'];
   $id_size = $_FILES['id_pic']['size'];
   $id_tmp_name = $_FILES['id_pic']['tmp_name'];
   $id_error = $_FILES['id_pic']['error'];

   if($id_error === 0){
    # the file size is greater than that number
    if ($id_size > 16777215){
    header("Location: create_acc.php?img_size=false"); #this will execute if the file is too large
    }

    else {
        #we get the file and the file extension
        $img_ex = pathinfo($id_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png");
        #if the file is an image file
        if(in_array($img_ex_lc, $allowed_exs)) {
          date_default_timezone_set("Asia/Manila");
          #rename the image
          $new_id_name =$firstN . "_" . $midN . "_" . $lastN . "id_pic" . "." . $img_ex_lc;
          #this is where the image will be moved
          $img_upload_path = '../user/requests/id_pics/' . $new_id_name;
          #this is the function that moves the uploaded file
          move_uploaded_file($id_tmp_name, $img_upload_path);
            
            
        }
        #if not
        else{
         header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
        }
    }
  }

  #this is for the barangay certificate
  $bar_cert = $_FILES['bar_certificate']['name'];
  $bar_size = $_FILES['bar_certificate']['size'];
  $bar_temp_name = $_FILES['bar_certificate']['tmp_name'];
  $bar_error = $_FILES['bar_certificate']['error'];
  if($bar_error === 0){
   if ($bar_size > 16777215){
    header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
   }

   else {
       $img_ex = pathinfo($bar_cert, PATHINFO_EXTENSION);
       $img_ex_lc = strtolower($img_ex);

       $allowed_exs = array("jpg", "jpeg", "png");

       if(in_array($img_ex_lc, $allowed_exs)) {
         date_default_timezone_set("Asia/Manila");
         $new_bar_name =$firstN . "_" . $midN . "_" . $lastN . "bar_cert" . "." . $img_ex_lc;
         $img_upload_path = '../user/requests/barangay_certificates/' . $new_birth_name;
         move_uploaded_file($bar_temp_name, $img_upload_path);
           
           
       }
       else{
           header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
       }
   }
}
   

  if ($age < 60) {
    header("Location: create_acc.php?age=false");
  }

  elseif ($birth_size && $id_size > 16777215){
    header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
   }

  elseif (in_array($img_ex_lc, $allowed_exs) == false) {
    header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
  }

  else {
    $sql = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE full_name='$full_name'");

    if(mysqli_num_rows($sql) > 0){
      header("Location: create_acc.php?exist=true");
    }

    else {
    
      $stmt_request = $conn->prepare("INSERT INTO `request_tbl`(`full_name`, `first_name`, `middle_name`, `last_name`, `extension`, `purok_id`, `barangay_id`, `municipality_id`, `province_id`, `birth_date`, `age`, `place_birth`, `sex`, `citizenship`, `physical_disability`, `health`, `other_health`, `education`, `senior_email`, `cell_no`, `emergency_no`, `civil_status`, `religion`, `id_pic`, `birth_certificate`, `barangay_certificate`, `request_date`, `request_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt_request->bind_param("sssssiiiisissssssssiisssssss", $full_name, $firstN, $midN, $lastN, $extension, $purok, $barangay, $municipality, $province, $birth_date, $age, $birth_place, $sex, $citizen, $physical_disability, $check_conditions, $other_conditions, $education, $email, $cellno, $emergency_no, $civil_stat, $religion, $new_id_name, $new_birth_name, $new_bar_name, $request_date, $request_time);
      $stmt_request->execute();

      $em = "sent";
      header("Location: senior_login.php?request=$em");
  }
}