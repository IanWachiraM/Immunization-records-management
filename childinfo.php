<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Children</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>"
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        window.html2canvas = html2canvas;
        window.jsPDF = window.jspdf.jsPDF;
        function makePDF() {
            html2canvas(document.querySelector("#dataTable"), {
                allowTaint: true,
                useCORS: true,
                scale: 1
            }).then(canvas => {
                var img = canvas.toDataURL("image/png");
                var doc = new jsPDF();

                var a4Width = 210; // in mm
                var a4Height = 297; // in mm
                var aspectRatio = canvas.width / canvas.height;

                // Calculate width and height for the image to fit A4 size while maintaining aspect ratio
                var maxWidth = a4Width - 20; // Subtracting 20mm from width for margin
                var maxHeight = a4Height - 20; // Subtracting 20mm from height for margin

                var widthRatio = maxWidth / canvas.width;
                var heightRatio = maxHeight / canvas.height;

                var resizeRatio = Math.min(widthRatio, heightRatio);

                var newWidth = canvas.width * resizeRatio;
                var newHeight = canvas.height * resizeRatio;

                doc.setFont('Arial');
                doc.setFontSize(18); // Adjust font size as needed for readability

                doc.addImage(img, 'PNG', 10, 10, newWidth, newHeight); // Adjust position as needed
                doc.save("Registered Children.pdf");
            });
        }
        </script>
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
<select id="sort_by" name="sort_by" onchange="sortTable()">
    <option value="id">Patient ID</option>
    <option value="dob">Date of Birth</option>
    <option value="vaccine">Vaccine Name</option>
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
<button id="download" onclick="makePDF()">Export to PDF</button>
<script>
    function goToHomePage(){
        window.location.href = "dashboard.html";
    }
</script>
<script>


    function sortTable() {
        var sort_by = document.getElementById("sort_by").value;
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("dataTable");
        switching = true;

        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[getIndex(sort_by)];
                y = rows[i + 1].getElementsByTagName("td")[getIndex(sort_by)];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    function getIndex(value) {
        var index = 0;
        switch (value) {
            case "date_of_birth":
                index = 2; // Index of Date of Birth column
                break;
            case "patient_ID":
                index = 3; //Index of patient id column
            case "gender":
                index = 4; // Index of Gender column
                break;
            case "vaccine_name":
                index = 5; // Index of Vaccine Name column
                break;
            case "date_of_administration":
                index = 6; // Index of Date of Administration column
                break;
        }
        return index;
    }
</script>

</body>
</html>
