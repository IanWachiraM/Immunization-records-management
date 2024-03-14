<?php
session_start();
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'phpmailer/src/Exception.php';
 require 'phpmailer/src/PHPMailer.php';
 require 'phpmailer/src/SMTP.php';


 try {
    $server1 = "localhost";
    $username1 = "user1";
    $password1 = "wachira254";
    $dbname1 = "subscriptiondetails";

    $server2 = "localhost";
    $username2 = "user1";
    $password2 = "wachira254";
    $dbname2 = "vaccinetable";



    $conn1 = new mysqli($server1, $username1, $password1, $dbname1) or die("Connect failed" .mysqli_connect_error());
    $conn2 = new mysqli($server2, $username2, $password2, $dbname2) or die("Connect failed" .mysqli_connect_error());

    if($conn1->connect_error || $conn2->connect_error){
        die("Connection failed: " . $conn1->connect_error ."or". $conn2->connect_error);
    }
    //SQL Query for database that has the vaccination details
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $number = $_POST['phone'];
        $email = $_POST['email'];
        
        $sql1 = "INSERT INTO subscription_details (phone_number, email_address) VALUES ('$number', '$email')";
 
    }
    $p_id = $_POST['patient_id'];
    $vaccine = $_POST['vaccine_type'];
    $sql2 = "SELECT next_date, patient_id, vaccine_name FROM vaccine WHERE patient_id = $p_id";
    $result2 = $conn2->query($sql2);
    $result2 = mysqli_query($conn2, $sql2);
    if ($result2 === false) {
        
        echo "Error executing the query: " . mysqli_error($conn2);
    } else{

    
    if($result2->num_rows > 0){
        
        $mail = new PHPMailer(true);

        try{
            
        
            //Configuring SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'wachiramwangi39@gmail.com';
            $mail->Password   = 'douo fnwj yfer peqi';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
        
            $mail->setFrom('wachiramwangi39@gmail.com', 'iChanjo Team');
            $mail->addAddress($email);

            $mail->isHTML(true);

            $row = $result2->fetch_assoc();
        
            $subject = 'Child Vaccination Reminder';
            $body = "<p>Dear Parent,</p>";
            $body = "<p>We hope this email finds you well</p>";
            $body .= "<p>This is a reminder that your child is due for vaccination on {$row['next_date']}.</p>";
            $body .= "<p>Regards,\nYour Healthcare Provider<p>";


            $mail->Subject = $subject;
            $mail->Body    = $body;
            //Sending email
            $mail->send();


            echo '<script>';
            echo 'alert("Email sent successfully!");';
            echo '</script>';
            header("Location: notifications.php");

        
        }catch(Exception $e){
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

    
     }

    } 
    
    }catch (Exception $e){
        echo "Connection was not possible: " . $conn1->error ."or". $conn2->error;
    }


?>
