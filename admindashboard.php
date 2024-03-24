<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <style>
        body {
            font-family: "Jost", sans-serif;
            font-weight: bold;
            margin: 0;
            padding: 0;
            background-color:bisque;
            display: block;
            
        }
        header {
            background-color: #333;
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            color: #f1f1f1;
            padding: 20px;
            display: block;
            justify-content: space-between;
            align-items: center;
            width: 97%;
        }
        .container {
            max-width: 2200px;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        .side-menu {
            width: 200px;
            height: 100vh;
            background-color: #333;
            padding: 20px;
        }
        .side-menu a {
            display: block;
            padding: 10px;
            color: #ede6e6;
            text-decoration: none;
            border-bottom: 1px solid #ccc;
        }
        .side-menu a:hover {
            background-color: #848383;
        }
        .content-section {
            flex-grow: 1;
            padding: 20px;
            margin-left: 0px;
        }
        button:hover {
            background-color: #555;
        }
        table {
            background-color: seashell;
            position: absolute;
            display: block;
            border-collapse: collapse;
          
            margin-left: 280px;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px 20px;
            text-align: left;
        }
        button{
            background-color: #333; 
            color: white; 
            padding: 10px 20px; 
            font-family: Arial, Helvetica, sans-serif;
            font-size: large; 
            font-weight: bold;
            border: none; 
            cursor: pointer; 
            border-radius: 5px;
            display: flex;
            height: 50px;
            margin-top: 10%;
        }
        button:hover{
            background-color: #848383;
        }
        #logout{
            border: white;
            border-color: #ccc;
            border-radius: 5px;
        }

      
    </style>
</head>
<body>
    <header>
        <h1>Welcome to iChanjo.</h1>
        <h2>Admin Dashboard</h2>
    </header>
    <div class="container">
        <div class="side-menu">
            <a href="admindashboard.php">Registered Children</a> <!-- Restrict to admin.-->
            <!--<a href="vaccineinfo.html">Vaccine Information</a>-->
            <a href="notifications.php">Manage Notifications</a> <!-- Restrict to admin.-->
            <a href="fatherdetails.php">Registered Fathers</a>
            <a href="mothers.php">Registered Mothers</a>
            <a href="guardianstable.php">Registered Guardians</a>
            <a href="newuser.php">Grant User Acces</a>
         <!--<a href="appointment.html">Appointments</a> -->
            <button id ="logout" onclick="logOut()">Log Out</button>
        </div>
        

<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Patient ID</th>
            <th>Gender</th>
            <th>Vaccine Administered</th>
            <th>Date Administered</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        // Connection to the database
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
        $sql = "SELECT child_details.first_name, child_details.last_name, child_details.date_of_birth,child_details.gender, vaccine.patient_ID, vaccine.vaccine_name, vaccine.date_of_administration
        FROM logindetails.child_details
        JOIN vaccinetable.vaccine ON child_details.patient_id = vaccine.patient_id
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
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
    }
        $conn1->close();
        $conn2->close();
        ?>
    </tbody>
 <!--   <button onclick="window.print()">Export to PDF</button> -->
</table>
<script>
    function logOut(){
        var logoutconfirm = confirm("Are you sure you want to log out?");
        if (logoutconfirm){
            window.location.href = "index.html";
        }
        else{
            window.location.href = "admindashboard.php";
        }
        
    }
</script>
</body>
</html>
    
    