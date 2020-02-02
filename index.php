<?php
require('env.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$valid = true;
$messages = [];

// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//     echo 'POST';
//     exit;
// }

//var_dump($_POST);

$caseDetails = $_POST['case-details-input'];
$name = $_POST['name-input'];
$phone = $_POST['phone-input'];
$email = $_POST['email-input'];
$town = $_POST['town-input'];
$state = $_POST['state-input'];


if ($phone == '') {
    $valid = false;
    $messages[] = 'phone number is required';
}


if (strlen ( $name )  < 3) {
    $valid = false;
    $messages[] = 'name must be longer';
}

if (!$valid) {
    die("invalid form " .join('', $messages));
}

$sql = "INSERT INTO intakeform (caseDetails, name, email, phone, town, state)
VALUES ('$caseDetails', '$name', '$email', '$phone', '$town', '$state')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);