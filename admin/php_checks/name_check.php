<?php
    include "../../db_connect.php";
// Assuming you have already established a database connection

if (isset($_POST['fist_name'], $_POST['last_name'])) {
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $extension = $_POST["extension"];

    // Concatenate the name components
    $fullName = $firstName . ' ' . $middleName . ' ' . $lastName . ' ' . $extension;

    $query = "SELECT * FROM users WHERE full_name = '$fullName'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "taken";
        } else {
            echo "not_taken";
        }
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}
?>
