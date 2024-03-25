<?php
// Connect to your database (replace placeholders with actual values)
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get current date
$currentDate = date('Y-m-d');

// Query to fetch users with upcoming vaccination dates
$query = "SELECT email FROM users WHERE vaccination_date = DATE_ADD('$currentDate', INTERVAL 1 DAY)";

try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Send email reminders to users
    foreach ($users as $user) {
        $to = $user['email'];
        $subject = 'Vaccination Reminder';
        $message = 'Dear User, Your vaccination appointment is scheduled for tomorrow. Please make sure to attend.';
        // You can customize the message as needed

        // Send email (you may need to configure SMTP settings)
        mail($to, $subject, $message);
    }

    echo "Email reminders sent successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
