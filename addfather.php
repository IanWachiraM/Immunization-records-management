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
    $number = $_POST['number'];
    $email = $_POST['address'];
    $id_number = $_POST['id_number'];
   

    $sql = "INSERT INTO father_details (first_name, middle_name, last_name, phone_number, email_address, id_number)
    VALUES ('$fname', '$mname', '$lname', '$number', '$email' , '$id_number')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: dashboard.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();

?>