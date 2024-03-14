<?php
            $servername = "localhost";
            $username = "user1";
            $password = "wachira254" ;
            $dbname = "logindetails";


            $conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed" .mysqli_connect_error());

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $father_fname = $_POST['father_fname'];
                $father_mname = $_POST['father_mname'];
                $father_lname = $_POST['father_lname'];
                $father_number = $_POST['father_number'];
                $father_email = $_POST['father_address'];
                $father_id_number = $_POST['father_id_number'];

                $mother_fname = $_POST['mother_fname'];
                $mother_mname = $_POST['mother_mname'];
                $mother_lname = $_POST['mother_lname'];
                $mother_number = $_POST['mother_number'];
                $mother_email = $_POST['mother_address'];
                $mother_id_number = $_POST['mother_id_number'];
            
            

                $sql = "INSERT INTO parent_details (father_fname, father_mname, father_lname, father_number, father_address, father_id_number , mother_fname, mother_mname, mother_lname, mother_number, mother_address, mother_id_number)
                VALUES ('$father_fname', '$father_mname', '$father_lname', '$father_number', '$father_email', '$father_id_number', '$mother_fname', '$mother_mname', '$mother_lname', '$mother_number', '$mother_email', '$mother_id_number' )";

            if ($conn->query($sql) === TRUE) {
                echo '<script>';
                echo 'alert("Data entry successful!");';
                echo '</script>';
                header("Location: dashboard.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            }
            $conn->close();

?>