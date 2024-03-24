<?php
session_start();
$servername = "localhost";
$username = "user1";
$password = "wachira254";
$dbname = "vaccinetable";


$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed" .mysqli_connect_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST[ 'patient_id'];
        $patient_height = $_POST['height'];
        $patient_weight = $_POST['weight'];
        $vaccine_type = $_POST['vaccine_type'];
        $administration_date = $_POST['administration_date'];
        $next_administration = $_POST['next_administration'];
        $batch_number = $_POST['batch_number'];
        $healthcare_provider = $_POST['healthcare_provider'];


        
        $sql = "INSERT IGNORE INTO vaccine (patient_ID, patient_height, patient_weight, vaccine_name, date_of_administration, next_date, batch_number, health_care_provider)
        VALUES ('$patient_id', '$patient_height', '$patient_weight', '$vaccine_type', '$administration_date', '$next_administration', '$batch_number', '$healthcare_provider')";


if ($conn->query($sql) === TRUE) {
    echo '<script>';
    echo 'alert("Data entry successful!");';
    echo '</script>';
    header("Location: dashboard.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }
 

$conn->close();
?>