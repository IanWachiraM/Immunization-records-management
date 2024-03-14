<?php
 $server = "localhost";
 $username = "user";
 $password = "wachira254";
 $dbname = "signup";

 $conn = new mysqli($server, $username, $password, $dbname) or die("Connect failed" .mysqli_connect_error());

 if($conn->connect_error){
    die("Connection Failed" .$conn->connect_error);
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT password_final FROM signup_details WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password_final'];

        if ($password === $storedPassword) {
        
            header("Location: recordcheck.html"); //takes you to the page that checks if a patient is new or if  he is in the system
            exit;
        } else {
            echo '<div id="error-msg" style="color: red; font-weight: bold; font-size: 11px;">Invalid username or password. Please try again</div>';
        }
    } else{
        echo '<div id="error-msg" style="color: red; font-weight: bold; font-size: 11px;">Invalid username or password.Please try again.</div>';
    }



    // Close statement
    $conn->close();
 }


?>