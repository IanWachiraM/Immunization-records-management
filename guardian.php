<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Taking the guardian's details.</title>
        <link rel="stylesheet" type="text/css" href = "newrecordstyle.css">
    </head>
    <body>
        <div class="card">
          <form action="guardian.php" method="post"  onsubmit="return validateForm(this)">
            <h1>Kindly fill in the guardian's details</h1>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name= "fname" placeholder="First Name" required>
                </div>
              </div>
          
              <div class="col">
                <div class="form-group">
                  <label>Middle Name</label>
                  <input type="text" name= "mname" placeholder="Middle Name" required>
                </div>
              </div>
          
              <div class="col">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" name= "lname" placeholder="Last Name" required>
                </div>
              </div>
          
              <div class="col">
                <div class="form-group">
                  <label>Telephone Number</label>
                  <input type="tel" name="number" placeholder="Mobile Phone Number"I required>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" name="address" placeholder="Email Address">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label>ID Number:</label>
                  <input type="number" name="id_number" placeholder="ID Number" required>
                </div>
              </div>

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
                  $fname = $_POST['fname'];
                  $mname = $_POST['mname'];
                  $lname = $_POST['lname'];
                  $number = $_POST['number'];
                  $email = $_POST['address'];
                  $id_number = $_POST['id_number'];
                

                  $sql = "INSERT INTO guardian (first_name, middle_name, last_name, phone_number, email_address, id_number)
                  VALUES ('$fname', '$mname', '$lname', '$number', '$email', '$id_number')";

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
          
              <div class="col">
                <input type="submit" value="Submit" onclick="openDashboardPage()">
              </div>
            </div>
          </form>
          </div>
          <script>
            function openDashboardPage(){
                window.location.href = "dashboard.html";
            }
          </script>
    </body>
</html>