<?php
session_start();
$server1 = "localhost";
$username1= "administrator";
$password1 = "admin";
$dbname1 = "signup";

$server2 = "localhost";
$username2 = "administrator";
$password2 = "admin";
$dbname2 = "administrator";

$conn1 = new mysqli($server1, $username1, $password1, $dbname1) or die("Connect failed" .mysqli_connect_error());
$conn2 = new mysqli($server2,$username2, $password2, $dbname2) or die("Connect failed" .mysqli_connect_error());

if ($conn1->connect_error || $conn2->connect_error) {
    die("Connection failed: " . $conn1->connect_error || $conn2->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['user_type'];

    if($usertype == 'nurse'){
        $sql = "INSERT INTO signup_details (username, password_final) VALUES ('$username', '$password')";
    }
    elseif($usertype == 'administrator'){
        $sql = "INSERT INTO admin_approval (admin_name, admin_password) VALUES ('$username', '$password')";
    }
    
   
    $result1 = mysqli_query($conn1, $sql);
    $result2 = mysqli_query($conn2, $sql);

    echo '<script>';
    echo 'alert("User created successfully!");';
    echo '</script>';
    header("Location: admindashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New User</title>
    <style>
        body {
            background-color: bisque;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            align-items: center;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            background-color: seashell;
			width: 500px;
			padding: 20px;
			margin: 50px auto;
			padding: 50px;
			border: 1px solid #8a8989;
			border-radius: 5px;
			text-align: center;
        }
        label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
        input {
			width: 100%;
			padding: 8px;
			border-radius: 3px;
			border: 1px solid #333;
            margin-top: 5px;
            margin-bottom: 3px;
		}
        button {
			width: 50%;
			padding: 10px;
			background-color: #0e0d0d;
			border:#0e0d0d;
			color: #fff;
			font-size: medium;
			border: none;
			border-radius: 3px;
			cursor: pointer;
            margin-top: 20px;
		}

		button:hover {
			background-color: #828384;
		}

    </style>

</head>
<body>
    <header>
        <h1>Register New User</h1>
        <nav>
            <ul>
                <li><a href="admindashboard.php">Back to Admin Dashboard</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="usertype" id="usertype">User Type:</label>
            <select id="user_type" name="user_type">
                <option value="nurse">Nurse/Doctor</option>
                <option value="administrator">Administrator</option>
            </select><br>
            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
