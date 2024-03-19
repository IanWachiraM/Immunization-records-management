<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Mothers</title>
    <style>
        body{
            background-color: bisque;
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
            margin-top: 20px;
            font-weight: bold;
            background-color: #333; 
            color: white; 
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium; 
            font-weight: bolder;
            border: none; 
            cursor: pointer; 
            padding: 10px 20px;
        }
        button:hover{
            background-color: #848383;
        }
    </style>
</head>
<body>

<h2> Registered mothers</h2>

<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>ID Number</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        // Connection to the database
        $server1 = "localhost";
        $username1 = "user";
        $password1 = "wachira254";
        $database1 = "logindetails";

        

        $conn1 = new mysqli($server1, $username1, $password1, $database1);

        // Check connection
        if ($conn1->connect_error) {
            die("Connection failed: " . $conn1->connect_error);
        }
        $sql = "SELECT *
        FROM mother_details";
        $result = $conn1->query($sql);


        if($result === false){
            echo "Error executing query: " . $conn1->error;
        }

         else{
            if($result -> num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["middle_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td>" . $row["email_address"] . "</td>";
                echo "<td>" . $row["id_number"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
    }


        // Close connection
        $conn1->close();
        ?>
    </tbody>
</table>
<button onclick="goToHomePage()">Back to Dashboard</button>
<script>
    function goToHomePage(){
        window.location.href = "admindashboard.php";
    }
    
</script>
</body>
</html>
