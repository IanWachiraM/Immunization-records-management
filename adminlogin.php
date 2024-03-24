<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>


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
		header {
			background-color: #333;
			color: #fff;
			font-family: 'Times New Roman', Times, serif;
			font-weight: bold;
			font-size: medium;
			padding: 5px 10px;
			text-align: center;
			padding: 20px;
			
			max-height: 130px;
			width: 95%;
			top: 0;
        }

		.login-container {
			background-color: seashell;
			width: 500px;
			padding: 20px;
			margin: 50px auto;
			padding: 50px;
			border: 1px solid #8a8989;
			border-radius: 5px;
			text-align: center;
		}
	

		h2 {
			text-align: center;
			font-weight: bold;
			margin-bottom: 40px;
		}

		.input-group {
			margin-bottom: 15px;
		}

		.input-group label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}

		.input-group input {
			width: 100%;
			padding: 8px;
			border-radius: 3px;
			border: 1px solid #333;
		}

		button {
			width: 50%;
			padding: 10px;
			background-color: #0e0d0d;
			border:#0e0d0d;
			color: #fff;
			font-size: large;
			border: none;
			border-radius: 3px;
			cursor: pointer;
		}

		button:hover {
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
	<header>
        <h1>Welcome to iChanjo.</h1>
        <h2>Ensuring that all children are vaccinated, one child at a time.</h2>
    </header>
    <div class="login-container">
        <form id="login_form" action="adminlogin.php" method="post">
            <h2>Admin Login</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username"required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
				<div style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Password" required>
				<span class="password-toggle" onclick="togglePassword()">
					<img src="https://cdn-icons-png.flaticon.com/512/25/25186.png" alt="Toggle password visibility" width="20">
				  </span>
				</div>
            </div>
            <?php
            session_start();
            $server = "localhost";
            $username = "administrator";
            $password = "admin";
            $dbname = "administrator";

            $conn = new mysqli($server, $username, $password, $dbname) or die("Connect failed" .mysqli_connect_error());

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
                $username = $_POST["username"];
                $password = $_POST["password"];

                $query = "SELECT admin_password FROM admin_approval WHERE admin_name = '$username'";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $storedPassword = $row['admin_password'];

                    if ($password === $storedPassword) {
                    
                        header("Location: admindashboard.php");
                        exit;
                    } else {
                        echo '<div id="error-msg" style="color: red; font-weight: bold; font-size: 13px;">Invalid username or password. Please try again</div>';
                    }
                } else{
                    echo '<div id="error-msg" style="color: red; font-weight: bold; font-size: 13px;">Invalid username or password.Please try again.</div>';
                }
            }
            ?>
            <button type="submit">Login</button>
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
</body>
</html>
