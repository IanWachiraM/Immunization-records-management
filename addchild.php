<?php
$servername = "localhost";
$username = "user";
$password = "wachira254" ;
$dbname = "logindetails";


$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed" .mysqli_connect_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $patient_ID = $_POST['patient_id'];

    $sql = "INSERT INTO child_details (first_name, middle_name, last_name, date_of_birth, gender, patient_id)
    VALUES ('$fname', '$mname', '$lname', '$dob', '$gender', '$patient_ID')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: parentstatus.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();

?>