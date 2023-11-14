<?php
    session_start();
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
        include 'db_connect.php';
        #get the senior id
        $senior_id = $_GET['id'];

        #create a query where we will get the data in the database
        $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id WHERE senior_id=?");
        $sql->bind_param("i", $senior_id);
        $sql->execute();
        $result = $sql->get_result();
        $row = mysqli_fetch_assoc($result);
        $birth_format = new DateTime($row['date_birth']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="senior_document.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    
    <div class="senior-content">
        <div class="title">
            <h1>Senior Information</h1>
        </div>
        <div class="pic-contain">
            <img src="senior/senior_pics/id_pics/<?= $row['id_pic'] ?>" alt="">
        </div>
        <div class="full-name">
            <div class="first-name">
                <h3>First Name:</h3>
                <p><?= $row['first_name'] ?></p>
            </div>
            <div class="middle-name">
                <h3>Middle Name:</h3>
                <p><?= $row['mid_name'] ?></p>
            </div>
            <div class="last-name">
                <h3>Last Name:</h3>
                <p><?= $row['last_name'] ?></p>
            </div>
            <div class="extension">
                <h3>Extension:</h3>
                <?= $row['extension'] ?>
            </div>

            <div class="birth-date">
                <h3>Birth Date:</h3>
                <p><?= $birth_format->format("M d, Y") ?></p>
            </div>

            <div class="birth-place">
                <h3>Brith Place:</h3>
                <p><?= $row['birth_place'] ?></p>
            </div>

            <div class="sex">
                <h3>Sex:</h3>
                <p><?= $row['sex'] ?></p>
            </div>

            <div class="citizenship">
                <h3>Citizenship:</h3>
                <p><?= $row['citizenship'] ?></p>
            </div>

            <div class="civil-stat">
                <h3>Civil Status:</h3>
                <p><?= $row['civil_status'] ?></p>
            </div>

            <div class="religion">
                <h3>Religion:</h3>
                <p><?= $row['religion'] ?></p>
            </div>

            <div class="education">
                <h3>Educational Attainment:</h3>
                <p><?= $row['education'] ?></p>
            </div>
        </div>

        <div class="contact-info">
            <h3>Contact Information</h3>
        </div>

        <div class="contact-content">
            <div class="email">
                <h3>Email Address:</h3>
                <p><?= $row['senior_email'] ?></p>
            </div>
    
            <div class="cell-no">
                <h3>Contact Number:</h3>
                <p><?= str_pad($row['cell_no'], 13, "+63", STR_PAD_LEFT) ?></p>
            </div>

            <div class="emergency-no">
                <h3>Guardian Contact Number:</h3>
                <p><?= str_pad($row['emergency_no'], 13, "+63", STR_PAD_LEFT) ?></p>
            </div>
        </div>

        <div class="address">
            <h3>Permanent Address:</h3>
            <p>Purok <?= $row['purok_no'] ?>, <?= $row['barangay_name'] ?>, <?= $row['municipality_name'] ?>, <?= $row['province_name'] ?></p>
        </div>

        <div class="health-info">
            <h3>Health Information</h3>
        </div>

        <form action="" class="health-content">
            <div>
                <input type="checkbox" checked>
                <label for="">Hypertension</label>
            </div>
            <div>
                <input type="checkbox" checked>
                <label for="">Arthritis/Gout</label>
            </div>
            <div>
                <input type="checkbox">
                <label for="">Coronary Heart Disease</label>
            </div>
            <div>
                <input type="checkbox" checked>
                <label for="">Diabetes</label>
            </div>
            <div>
                <input type="checkbox">
                <label for="">Chronic Kidney Disease</label>
            </div>
            <div>
                <input type="checkbox">
                <label for="">Alzheimers/Dementia</label>
            </div>
            <div>
                <input type="checkbox">
                <label for="">Chronic Obstructive Pulmorary Disease</label>
            </div>

            <div class="blood-type">
                <h3>Blood Type:</h3>
                <p>A+</p>
            </div>

            <div class="physical">
                <h3>Physical Disabilities:</h3>
                <p>none</p>
            </div>
        </form>


    </div>
</body>
</html>

<?php
    }
?>
