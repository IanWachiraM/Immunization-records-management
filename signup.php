<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <style>
      body {
        font-family: Arial, sans-serif;
        background-color: bisque;
        margin: 0;
      padding: 0;
        display: flex; 
      justify-content: center; 
      flex-direction: column;
      align-items: center; 
      min-height: 100vh; 
      }
      .container {
          background-color: seashell;
          width: 500px;
      padding: 20px;
      margin: 50px auto;
      padding: 50px;
      border: 1px solid #8a8989;
      border-radius: 5px;
      text-align: center;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .form-group {
        margin-bottom: 20px;
      }
      h2 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 40px;
    }

      label, input {
        display: block;
        width: 100%;
        font-weight: bold;
      }
      input[type="text"], input[type="password"] {
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #141313;
        border-radius: 5px;
        box-sizing: border-box;
      }
    input[type="submit"] {
        width: 50%;
        padding: 10px 10px;
        background-color: #0e0d0d;
        border:#0e0d0d;
        color: #fff;
        font-size: large;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
        align-items: center;
    }
    input[type="submit"]:hover {
        background-color: #828384;
    }
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }

  </style>
</head>
<body>
  <div class="container">
    <h2>Password Reset:</h2>
    <form id = "signup_form" action="signup.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <div style="position: relative;">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <span class="password-toggle" onclick="togglePassword()">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25186.png" alt="Toggle password visibility" width="20">
          </span>
          </div>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <div style="position: relative;">
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Password" required>
        <span class="password-toggle" onclick="confirmPassword()">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25186.png" alt="Toggle password visibility" width="20">
          </span>
        </div>
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $user_name = $_POST["username"];
            $pass_word = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            if ($pass_word != $confirm_password) {
                echo '<div id="error-msg" style="color: red; font-weight: bold; font-size: 11px;">Passwords do not match. Kindly try again.</div>';
                echo '<script>setTimeout(function() { document.getElementById("error-msg").style.display = "none"; }, 5000);</script>';
            } else {
              $server = "localhost";
              $username = "user1";
              $password = "wachira254";
              $dbname = "signup";
              
              $conn = new mysqli($server, $username, $password, $dbname) or die("Connect failed" . mysqli_connect_error());
              
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              
              $sql = "INSERT INTO signup_details (username, password_final) VALUES (?, ?)";
              $stmt = $conn->prepare($sql);
              
              $stmt->bind_param("ss", $user_name, $pass_word); // Assuming $pass_word contains the plain text password
              $stmt->execute();
              
              if ($stmt->affected_rows > 0) {
                  echo '<script>';
                  echo 'alert("Password reset successful!");';
                  echo '</script>';
                  header("Location: recordcheck.html"); 
                  exit();                 
              } else {
                  echo '<div id="error" style="color: red; font-weight: bold; font-size: 14px;">Error: ' . $conn->error . '</div>';
              }
              
              $stmt->close();
              $conn->close();
              
            }
        }
?>
      </div>
      <input type="submit" value="Reset">

    </form>
  </div>
  <script>
    function togglePassword() {
      var passwordInput = document.getElementById("password");
      var passwordIcon = document.querySelector(".password-toggle img");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordIcon.src = "https://static.thenounproject.com/png/22249-200.png";
      } else {
        passwordInput.type = "password";
        passwordIcon.src = "https://cdn-icons-png.flaticon.com/512/25/25186.png";
      }
    }
  </script>
  <script>
    function confirmPassword() {
      var passwordInput = document.getElementById("confirm_password");
      var passwordIcon = document.querySelector(".password-toggle img");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordIcon.src = "https://static.thenounproject.com/png/22249-200.png";
      } else {
        passwordInput.type = "password";
        passwordIcon.src = "https://cdn-icons-png.flaticon.com/512/25/25186.png";
      }
    }
  </script>
</body>
</html>










