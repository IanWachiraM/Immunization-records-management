<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Children</title>
    <!--<script src="pdf.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
    <style>
        body{
            background-color: bisque;
        }
        table {
            background-color: seashell;
            border-collapse: collapse;
            width: 100%;
        }
        label{
            font-weight: bold;
            font-size: medium;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        button{
            padding: 10px;
            width: 15%;
            margin-top: 20px;
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
<body>

<h2>All Registered Children</h2>
<label for="sort" id="sort">Sort by:</label>
<select id="sort_by" name="sort_by">
    <option value="dob">Date of Birth</option>
    <option value="gender">Gender</option>
    <option value="vaccine">Vaccine Named</option>
    <option value="date">Date of administration</option>
</select><br>
<table id="dataTable">
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


        // Close connection
        $conn1->close();
        $conn2->close();
        
        ?>
    </tbody>
</table>
<button onclick="goToHomePage()">Back to Dashboard</button>
<button id="download" onclick="window.print()">Export to PDF</button>
<script>
    function goToHomePage(){
        window.location.href = "dashboard.html";
    }
</script>
<!--
<script>
  function generatePDF() {
    // Select the table element
    const table = document.querySelector('#dataTable');

    // Create a new jsPDF instance
    const pdf = new jsPDF('p', 'pt', 'letter');

    // Get the table's dimensions
    let tableWidth = 0;
    let tableHeight = 0;
    for (let i = 0; i < table.rows.length; i++) {
      const row = table.rows[i];
      tableWidth = Math.max(tableWidth, row.offsetWidth);
      if (row.offsetHeight > tableHeight) {
        tableHeight = row.offsetHeight;
      }
    }

    // Get the dimensions of the first row to calculate column widths
    const firstRow = table.rows[0];
    const columnWidths = [];
    for (let i = 0; i < firstRow.cells.length; i++) {
      const cell = firstRow.cells[i];
      columnWidths.push(cell.offsetWidth);
    }

    // Create a new autoTable instance with the desired options
   
    // Save the generated PDF file
    pdf.save('table.pdf');
  }

  // Ensure the DOM is fully loaded before calling the generatePDF function
  window.onload = generatePDF;
</script>
-->

</body>
</html>
