<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Fathers</title>
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
                doc.save("Registered Fathers.pdf");
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

<h2> Registered fathers</h2>

<table id="dataTable">
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
        FROM father_details";
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
<button id="download" onclick="makePDF()">Export to PDF</button>
<script>
    function goToHomePage(){
        window.location.href = "admindashboard.php";
    }
    
</script>
</body>
</html>
