<?php
        include '../db_connect.php';
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            include "admin_links.php";
            include "nav_style.php";
        ?>
        <title>Senior Request</title>
    </head>
    <!-- Toast for age start -->
    <div class="toast bg-danger position-absolute text-white text-right top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
        <i class="fa-solid fa-circle-exclamation fa-2xl"></i>
        <h4>Ages 60 and below are not qualified to register as senior citizens</h4>
        </div>
    </div>
        <!-- Toast for age end -->
    <body class="" style="background-image: url('../munisipyobckgrnd.jpg'); background-size: cover;">
    <?php
        include "admin_navbar.php";
    ?>
        <nav class="nav offcanvas-lg offcanvas-end fs-4 d-flex gap-5 next-nav d-flex justify-content-end" id="nav-buttons">
        <a class="nav-link text-white active" aria-current="page" href="../index.php">Home</a>
        <a class="nav-link text-white" href="../about.php">About Us</a>
        <a class="nav-link text-white" href="../faq.php">FAQ</a>
        <a class="nav-link text-white" href="../contact.php" tabindex="-1">Contact Us</a>
        <a class="nav-link text-white" href="../login.php" tabindex="-1">Login</a>
        <a class="nav-link text-white" href="senior_create_acc.php" tabindex="-1">Sign up</a> 
    </nav>
        <!-- container for header and form -->
        <div class="container-sm bg-white mt-2 p-5 rounded-3 overflow-auto" style="">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <img src="../munisipyo.png" alt="" class="image-responsive" style="width: 10vw;">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12 mb-3">
                    <h1>Senior Citizen Registration</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form action="admin_add_senior.php?add_senior=true" method="post" id="submit" class="d-flex flex-column gap-2 needs-validation" style="height: 43vh;" enctype="multipart/form-data" novalidate>
                    <div class="form-group d-flex flex-column">
                        <!-- Full Name -->
                        <h4>Full Name:</h4>
                        <div class="col-12 mb-3">
                            <!-- First Name -->
                            <input type="text" class="form-control form-control-lg" id="first" name="first_name" placeholder="First Name" pattern=".{2,}" oninput="validateInput(this, 'text')" required>
                            <div class="invalid-feedback mb-1" id="firstFeedback"></div>
                        </div>

                        <div class="col-12 mb-3">
                            <!-- Middle Name -->
                            <input type="text" class="form-control form-control-lg" id="mid" name="middle_name" placeholder="Middle Name" pattern=".{2,}" oninput="validateInput(this, 'text')">
                            <div class="invalid-feedback mb-1" id="midFeedback"></div>
                        </div>

                        <div class="col-12 mb-3">
                            <!-- Last Name -->
                            <input type="text" class="form-control form-control-lg" id="last" name="last_name" placeholder="Last Name" pattern=".{2,}" oninput="validateInput(this, 'text')" required>
                            <div class="invalid-feedback mb-1" id="lastFeedback"></div>
                        </div>

                        <div class="col-12 mb-3">
                            <!-- Extension -->
                            <input type="text" class="form-control form-control-lg" id="extension" name="extension" placeholder="Extension" pattern=".{2,}">
                        </div>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <!-- Address -->
                        <h4>Permanent Address:</h4>
                        <div class="col-12 mb-3">
                            <!-- Purok -->
                            <select name="purok" id="" name="purok" class="form-select form-select-lg" required>
                                <option value="" hidden>Purok</option>
                            <?php
                                $purok = mysqli_query($conn, "SELECT * FROM purok_tbl");
                                while($row = mysqli_fetch_assoc($purok)){
                            ?>
                                <option value="<?= $row['purok_id'] ?>"> <?= $row['purok_no'] ?></option>
                            <?php
                                }
                            ?>
                            </select>
                            <div class="invalid-feedback mb-1">
                            Require
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Barangay -->
                            <select id="" name="barangay" class="form-select form-select-lg" required>
                                <option value="" hidden>Barangay</option>
                            <?php
                                $barangay = mysqli_query($conn, "SELECT * FROM barangay_tbl");
                                while($row = mysqli_fetch_assoc($barangay)){
                            ?>
                                <option value="<?= $row['barangay_id'] ?>"><?= $row['barangay_name'] ?></option>
                            <?php
                                }
                            ?>
                            </select>
                            <div class="invalid-feedback mb-1">
                            Require
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Municipality -->
                            <select name="municipality" id="" name="municipality" class="form-select form-select-lg">
                                <option value="1" hidden>San Isidro</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Province -->
                            <select name="province" id="" name="province" class="form-select form-select-lg">
                                <option value="1" hidden>Nueva Ecija</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <!-- Birth Information -->
                        <h4>Birth Information:</h4>
                        <div class="col-12 mb-3">
                            <!-- BithDate -->
                            <input type="date" name="birth_date" class="form-control form-control-lg birth_date" id="birth_date" placeholder="" oninput="validateInput(this, 'date')" required>
                            <label for="" class="invalid-feedback mb-1" id="birth_dateFeedback"></label>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- BirthPlace -->
                            <input type="text" name="birth_place" class="form-control form-control-lg" id="birth_place" placeholder="Birthplace" pattern=".{2,}" oninput="validateInput(this, 'text')" required>
                            <label for="" class="invalid-feedback mb-1" id="birth_placeFeedback"></label>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Citizenship -->
                            <input type="text" name="citizenship" class="form-control form-control-lg" id="citizenship" placeholder="Citizenship" oninput="validInput(this)" required>
                            <label for="" class="invalid-feedback mb-1" id="citizenshipFeedback"></label>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Gender -->
                            <select name="sex" id="" class="form-select form-select-lg" required>
                                <option value=""hidden>Sex(Kasarian)</option>
                                <option value="Male">Male(Lalaki)</option>
                                <option value="Female">Female(Babae)</option>
                            </select>
                            <label for="" class="invalid-feedback mb-1">Require</label>
                        </div>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <!-- Health related information -->
                        <h4>Health Related Information:</h4>
                        <div class="col-12 mb-3">
                            <!-- BloodType -->
                            <select name="blood_type" id="" class="form-select form-select-lg" required>
                                <option value="" hidden>Blood Type</option>
                            <?php
                                $blood_sql = mysqli_query($conn, "SELECT * FROM blood_tbl");
                                while($row = mysqli_fetch_assoc($blood_sql)){
                            ?>
                                <option value="<?= $row['blood_id'] ?>"><?= $row['blood_type'] ?></option>
                            <?php
                                }
                            ?>
                            </select>
                            <label for="" class="invalid-feedback mb-1">Require</label>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Health Conditions -->
                            <input type="text" class="form-control form-control-lg" name="physical_disability" placeholder="Physical Disability(leave blank if none)">
                            <label for="" class="invalid-feedback mb-1">Require</label>
                        </div>
                        <div class="col-12 mb-3">
                        <div class="form-check">
                            <h5>Please check if you have the following:</h5>
                            <input type="checkbox" class="form-check-input mb-3" value="Hypertension" name="health[]">
                            <label for="">Hypertension</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mb-3" value="Arthritis/Gout" name="health[]">
                            <label for="">Arthritis/Gout</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mb-3" value="Coronary heart disease" name="health[]">
                            <label for="">Coronary heart diesease</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mb-3" value="Diabetes" name="health[]">
                            <label for="">Diabetes</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mb-3" value="Chronic kidney disease" name="health[]">
                            <label for="">Chronic kidney diesease</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mb-3" value="Alzheimer/Dementia" name="health[]">
                            <label for="">Alzheimer's/Dementia</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mb-3" value="Chronic Obstructive Pulmonary diesease" name="health[]">
                            <label for="">Chronic Obstructive Pulmonary disease</label>
                        </div>
                        <input type="text" class="form-control form-control-lg mb-3" name="other_health" placeholder="Others(please specify leave blank if none)">
                        </div>
                            <label for="" class="invalid-feedback mb-1">Require</label>
                        </div>
                        
                        

                    <div class="form-group d-flex flex-column">
                        <!-- Highest Educational Attainment -->
                        <h4>Highest Educational Attainment</h4>
                        <div class="col-12 mb-3">
                            <select name="education" id="" class="form-select form-select-lg" required>
                                <option value="" hidden>Educational Attainment</option>
                            <?php
                                $educ_sql = mysqli_query($conn, "SELECT * FROM education_tbl");
                                while($row = mysqli_fetch_assoc($educ_sql)){
                            ?>
                                <option value="<?= $row['education_id'] ?>"><?= $row['education_attainment'] ?></option>
                            <?php
                                }
                            ?>
                            </select>
                            <label for="" class="invalid-feedback mb-1">Require</label>
                        </div>
                    </div>


                    <div class="form-group d-flex flex-column">
                        <!-- Contact Information -->
                        <h4>Contact Information:</h4>
                        <div class="col-12 mb-3">
                            <!-- Email Address -->
                            <input type="email" class="form-control form-control-lg is-" name="email" id="email" placeholder="Email Address" oninput="validateInput(this, 'email')" required>
                            <label for="" class="invalid-feedback mb-1" id="emailFeedback"></label>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Contact Number -->
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+63</span>
                                <input type="text" class="form-control form-control-lg" name="cell_no" id="cell" placeholder="Contact Number" oninput="validateInput(this, 'contact')" pattern="[0-9]{10, 11}" required>
                                <label for="" class="invalid-feedback mb-1" id="cellFeedback"></label>
                            </div>
                            
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Emergency Contact -->
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+63</span>
                                <input type="text" class="form-control form-control-lg" name="emergency_no" id="emergency" placeholder="Guardians's Contact Number" oninput="validateInput(this, 'contact')" pattern="[0-9]{10, 11}" required>
                                <label for="" class="invalid-feedback mb-1" id="emergencyFeedback"></label>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="form-group d-flex flex-column">
                        <!-- Other information -->
                        <h4>Other Information:</h4>
                        <!-- Religion -->
                        <select name="religion" id="" class="form-select form-select-lg mb-3">
                            <option value="" hidden>Religion</option>
                        
                        <?php
                            $religion_sql = mysqli_query($conn, "SELECT * FROM religion_tbl");
                            while($row = mysqli_fetch_assoc($religion_sql)){
                        ?>
                            <option value="<?= $row['religion_id'] ?>"><?= $row['religion_name'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                        
                        <!-- Civil Status -->
                        <select name="civil_status" id="" class="form-select form-select-lg mb-3">
                            <option value="" hidden>Civil Status</option>
                        
                        <?php
                            $civil_sql = mysqli_query($conn, "SELECT * FROM civil_tbl");
                            while($row = mysqli_fetch_assoc($civil_sql)){
                        ?>
                            <option value="<?= $row['civil_id'] ?>"><?= $row['civil_status'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <h4>ID and Certificates</h4>

                        <div class="col-12 mb-3">
                            <!-- 2x2 Picture -->
                            <div class="">
                                <label for="" class="form-label">2x2 Picture</label>
                                <input type="file" name="id_pic" id="twobytwo" class="form-control" accept="image/*" onchange="validateInput(this, 'image')" required>
                                <label for="" class="invalid-feedback mb-1" id="twobytwoFeedback"></label>
                            </div>
                            
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Birth Certificate -->
                            <div class="">
                                <label for="" class="form-label">Birth Certificate</label>
                                <input type="file" id="birth-certificate" class="form-control" name="birth_certificate" accept="image/*" onchange="validateInput(this, 'image')" required>
                                <label for="" class="invalid-feedback mb-1" id="birth-certificateFeedback"></label>
                            </div>
                            
                        </div>
                        <div class="col-12 mb-3">
                            <!-- Barangay Certificate -->
                            <div class="">
                                <label for="" class="form-label">Barangay Certificate</label>
                                <input type="file" id="barangay-certificate" class="form-control" name="bar_certificate" accept="image/*" onchange="validateInput(this, 'image')" required>
                                <label for="" class="invalid-feedback mb-1" id="barangay-certificateFeedback"></label>
                            </div>
                            
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block text-white fs-4" value="Submit Request">

                    </form>
                    

                </div>
            </div>
        </div>
    </body>
    
    <!-- <script>

        const twoBytwo = document.getElementbyId("twobytwo");
        const birth_certificate = document.getElementById("birth_certificate");
        const barangay_certificate = document.getElementById("barangay_certificate");
        const twoBytwo_extension = twoBytwo.files[0].name.split(".").pop();

        const form = document.getElementById("submit");
        form.addEventListener("submit", (e)=>{
            console.log("try to submit ha?");
            e.preventDefault();
        })
        
        // $(document).ready(function(){


        //     $("#submit").on("submit", function(e){
        //         $("#submit").removeClass("was-validated").addClass("needs-validation");
        //         e.preventDefault();
        //     });

        //     $(".birth_date").on("input", function(e){
        //         //first we have to get the date input to calculate the age
        //         const birth_input = document.getElementById("birth_date").value;
        //         const birth_val = new Date(birth_input);

        //         //well have to calculate the month difference first
        //         const month_diff = Date.now() - birth_val;

        //         // convert the calculated difference in date format
        //         const age_dt = new Date(month_diff);

        //         //extract year from date then calculate the age of the user
        //         const year = age_dt.getUTCFullYear();
        //         const age = Math.abs(year - 1970);
        //         console.log(age);
        //         if(age < 60){
        //             $(".toast").toast("show");
        //         }
        //     });
        // });

        
    </script> -->

    <script>
        $(document).ready(function(){
            $("#submit").on("submit", function(e){
            // Check the validity of each input element
            var isValid = true;

            $(this).find('input, select, textarea').each(function(){
                if (!this.checkValidity()) {
                    isValid = false;
                    return false; // Stop the loop if an invalid input is found
                }
            });

            // If any input is invalid, prevent form submission
            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Add the 'was-validated' class to show Bootstrap validation styles
            $(this).addClass('was-validated');
            });

        })

        function validateInput(input, type) {

            const feedbackElement = document.getElementById(`${input.id}Feedback`);
            input.setCustomValidity('');
            // //first we have to get the date input to calculate the age
            // const birth_input = document.getElementById("birth_date").value;
            // const birth_val = new Date(birth_input);

            // //well have to calculate the month difference first
            // const month_diff = Date.now() - birth_val;

            // // convert the calculated difference in date format
            // const age_dt = new Date(month_diff);

            // //extract year from date then calculate the age of the user
            // const year = age_dt.getUTCFullYear();
            // const age = Math.abs(year - 1970);
            // console.log(age);

            switch (type) {
                case 'date':
                    validateDateInput(input, feedbackElement);
                    break;
                case 'contact':
                    validateContactInput(input, feedbackElement);
                    break;
                case 'text':
                    validateTextInput(input, feedbackElement);
                    break;
                case 'image':
                    validateImage(input, feedbackElement);
                    break;
                case 'email':
                    validateEmail(input, feedbackElement);
                // Add more cases for other input types if needed
            }
        }

        //This function is used to validate the age of the registrant
        function validateDateInput(input, feedbackElement) {
            const birthdate = new Date(input.value);
            const today = new Date();
            const age = today.getFullYear() - birthdate.getFullYear();

            console.log(`Birthdate: ${birthdate}`);
            console.log(`Calculated Age: ${age}`);

            if (age < 60) {
                console.log('Entering age validation branch');
                input.setCustomValidity(`You must be at least 60 years old.`);
                feedbackElement.innerText = `You must be at least 60 years old.`;
            } else {
                console.log('Entering valid branch');
                feedbackElement.innerText = '';
            }
        }

        //this function is used to validate the contact numbers
        function validateContactInput(input, feedbackElement) {
            console.log(`Contact Number: ${input.value}`);

            if (!input.checkValidity()) {
                console.log('Entering invalid branch bruh');
                input.setCustomValidity('Please enter a valid 11-digit contact number.');
                feedbackElement.innerText = 'Please enter a valid 11-digit contact number.';
            } else {
                console.log('Entering valid branch');
                feedbackElement.innerText = '';
            }
        }

        //this function is used to validate the text inputs
        function validateTextInput(input, feedbackElement) {
            console.log(`Text Input: ${input.value}`);

            if (!input.checkValidity()) {
                console.log('Entering invalid branch');
                input.setCustomValidity('Please enter at least 2 characters.');
                feedbackElement.innerText = 'Please enter at least 2 characters.';
            } else {
                console.log('Entering valid branch');
                feedbackElement.innerText = '';
            }
        }

        //this function is used to validate the text inputs
        function validateEmail(input, feedbackElement) {
            console.log(`Text Input: ${input.value}`);

            if (!input.checkValidity()) {
                console.log('Entering invalid branch');
                input.setCustomValidity('Please enter a valid email address');
                feedbackElement.innerText = 'Please enter a valid email address';
            } else {
                console.log('Entering valid branch');
                feedbackElement.innerText = '';
            }
        }

        //this will validate if the uploaded file is an image file
        function validateImage(input, feedbackElement) {
            console.log('Validating image');
            const file = input.files[0];

            if (file) {
                const fileType = file.type;
                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (!validImageTypes.includes(fileType)) {
                    console.log('Entering invalid branch');
                    input.setCustomValidity('Please choose a valid image file (JPEG, PNG, GIF).');
                    feedbackElement.innerText = 'Please choose a valid image file (JPEG, PNG, GIF).';
                } else {
                    console.log('Entering valid branch');
                    feedbackElement.innerText = '';
                }
            }
        }

    </script>
    </html>