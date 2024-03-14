<?php
$servername = "localhost";
$username = "user1";
$password = "wachira254";
$dbname = "appointments";

$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed" .mysqli_connect_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST[ 'name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];



    
    $sql = "INSERT INTO appointments (patient_name, email, phone_number, date_of_appointment, appointment_time)
    VALUES ('$name', '$email', '$phone_number', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    echo '<script>';
    echo 'alert("Appointment made successfully!");';
    echo '</script>';
    header("Location: appointment.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
$conn->close();

?>