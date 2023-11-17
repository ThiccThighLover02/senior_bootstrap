<?php
    include 'db_connect.php';
    date_default_timezone_set("Asia/Manila");
    $back_file = date("Y-m-d-H-i-s");
    $file_path = 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/' . $back_file . ".csv";
    $enclose_by = '"';
    $terminate_by = '\n';

    if(!file_exists($file_path)){
        $sql = mysqli_query($conn, "SELECT `senior_id`, `status`, `full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `message_id`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `date_birth`, `birth_place`, `sex`, `citizenship`, `age`, `blood_id`, `physical_disability`, `health`, `other_health`, `education`, `cell_no`, `emergency_no`, `religion`, `civil_status`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `qr_contents`, `account_time`, `account_date` FROM `senior_tbl`
        UNION ALL
        SELECT * FROM senior_tbl INTO OUTFILE '$file_path' FIELDS TERMINATED BY ',' ENCLOSED BY '$enclose_by' LINES TERMINATED BY '$terminate_by'
        ");

    }

// Load the database configuration file 

 
// Fetch records from database 
$sql = mysqli_query($conn, "SELECT * FROM senior_tbl S INNER JOIN purok_tbl P
ON S.senior_purok_id = P.purok_id INNER JOIN barangay_tbl B 
ON S.senior_barangay_id = B.barangay_id INNER JOIN municipality_tbl M 
ON S.senior_municipality_id = M.municipality_id INNER JOIN province_tbl Pr 
ON S.senior_province_id = Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id");



if(mysqli_num_rows($sql) > 0) {
    $delimiter = ","; 
    $filename = "senior-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array("Senior No", "First Name", "Middle Name", "Last Name", "Extension", "Purok", "Barangay", "Municipality", "Province", "Birthdate", "Birthplace", "Sex", "Citizenship", "Age", "Blood Type", "Physical Disability", "Health Conditions", "Cellphone Number", "Guardian Cellphone Number", "Religion", "Civil Status", "Email"); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($sql)){ 
        $birthday = $row['date_birth'];
        $birthday = new DateTime($birthday);
        $interval = $birthday->diff(new DateTime);
        $age = $interval->y;

        $lineData = array($row['senior_id'], $row['first_name'], $row['mid_name'], $row['last_name'], $row['extension'], $row['purok_no'], $row['barangay_name'], $row['municipality_name'], $row['province_name'], $row['date_birth'], $row['birth_place'], $row['sex'], $row['citizenship'], $age, $row['blood_type'], $row['physical_disability'], $row['health'], $row['cell_no'], $row['emergency_no'], $row['religion'], $row['civil_status'], $row['senior_email']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f);
}
    exit;
 
?>

    

