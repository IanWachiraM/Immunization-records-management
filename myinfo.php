<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Information</title>
    
    <style>
        body{
            background-color: bisque;
            display: grid;
            grid-gap: 20%;
            font-family: Arial, Helvetica, sans-serif;
            
        }
        header {
            font-family: 'Times New Roman', Times, serif;
            font-size: larger;
            background-color: #333;
            color: #f1f1f1;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        label{
            font-weight: bold;
            font-size: large;
        }
        table {
            background-color: seashell;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        button{
            padding: 10px;
            width: 15%;
            font-weight: bold;
            background-color: #0e0d0d;
			border:#0e0d0d;
			color: #fff;
			font-size: medium;
			border: none;
			border-radius: 10px;
			cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
    </head>
    <header>
        <h1>My Information</h1>
    </header>
    <body>
        <form id="myInfo" action="myinfo.php" method="post">
        <label for="patient_ID">Enter your patient ID:</label><br>
        <input type="number" name="patient_id" id="patient_id" required>
        <button type="submit">Get Patient Info.</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Patient ID</th>
                    <th>Gender</th>
                    <th>Vaccine Administered</th>
                    <th>Date of Administration</th>
                    <th>Health Care Provider</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $server1 = "localhost";
                    $username1 = "user";
                    $password1 = "wachira254";
                    $database1 = "logindetails";

                    $server2 = "localhost";
                    $user2 = "user";
                    $password2 = "wachira254";
                    $database2 = "vaccinetable";



                    $conn1 = new mysqli($server1, $username1, $password1, $database1);
                    $conn2 = new mysqli($server2, $user2,$password2, $database2);

                    // Check connection
                    if ($conn1->connect_error || $conn2->connect_error) {
                        die("Connection failed: " . $conn1->connect_error . "or".$conn2->connect_error);
                    }
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $patientId = $_POST['patient_id'];
                    $patientId = mysqli_real_escape_string($conn1, $patientId);

                    $sql = "SELECT child_details.first_name, child_details.last_name, child_details.date_of_birth, child_details.gender,vaccinetable.patient_ID, vaccinetable.vaccine_name, vaccinetable.date_of_administration, vaccinetable.health_care_provider
                    FROM logindetails.child_details AS child_details
                    INNER JOIN vaccinetable.vaccine AS vaccinetable ON child_details.patient_id = vaccinetable.patient_ID
                    WHERE child_details.patient_id = '$patientId'
                    ";
                    $result = $conn1->query($sql);


                    if($result === false){
                        echo "Error executing query: " . $conn1->error;
                    }

                    else{
                        if($result -> num_rows > 0) {
                        
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["first_name"] . "</td>";                            
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["date_of_birth"] . "</td>";
                            echo "<td>" . $row["patient_ID"] . "</td>";
                            echo "<td>" . $row["gender"] . "</td>";
                            echo "<td>" . $row["vaccine_name"] . "</td>";
                            echo "<td>" . $row["date_of_administration"] . "</td>";
                            echo "<td>" . $row["health_care_provider"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Patient ID not found in Database";
                    }
                    }
                }


                    // Close connection
                    $conn1->close();
                    $conn2->close();
                    ?>
            </tbody>
        </table>
        <button onclick="window.location='dashboard.html'">Back to Dashboard</button>
        <button id="download" onclick="window.print()">Export to PDF</button>
    </body>
</html>
