<?php
session_start();
$id=$_GET['id'];
$uid=$_SESSION['userid'];
include "../../dbconnect.php";
$sql="select * from student where student_id ='$uid'";
$result=mysqli_query($conn,$sql);
$student_name=mysqli_fetch_assoc($result)['student_name'];
$result=mysqli_query($conn,$sql);
$s_email=mysqli_fetch_assoc($result)['email'];
$sql1="select * from event_registration where reg_id='$id'";
$result1=mysqli_query($conn,$sql1);
$event_id=mysqli_fetch_assoc($result1)['event_id'];
$result1=mysqli_query($conn,$sql1);
$token=mysqli_fetch_assoc($result1)['token'];
$sql="select * from event where event_id = '$event_id'";
$result=mysqli_query($conn,$sql);
$event_name=mysqli_fetch_assoc($result)['event_name'];
$result=mysqli_query($conn,$sql);
$venue=mysqli_fetch_assoc($result)['venue'];
$result=mysqli_query($conn,$sql);
$date=mysqli_fetch_assoc($result)['date'];



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);
    // Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'collegeevents001@gmail.com';                     // SMTP username
    $mail->Password   = 'ubtyuxgzgxpzribe';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    // Recipients
    $mail->setFrom('collegeevents001@gmail.com');
    $mail->addAddress($s_email);     // Add a recipient
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Event Registration Successful';
    $mail->Body    = "Dear '$student_name',<br><p>Your registration for event '$event_name' is successful.</p><br>Venue:'$venue'<br>Date:'$date'<br>Registartion ID:'$token'<br><br><br> THANK YOU";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if($mail->send())
    {
        echo "<script>alert('Email Sent Successfully Thank you.')</script>";
    echo '<meta http-equiv="refresh" content="0;../index.php">';
    }

?>