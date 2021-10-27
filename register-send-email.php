<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';
require_once './db.php';

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    include "db.php";
    $receiver = $_POST['email'];
    $receiverName = $_POST['name'];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE email='" . $_POST['email'] . "'");
    $row= mysqli_num_rows($result);
    if($row < 1)
    {
        $token = md5($_POST['email']).rand(10,9999);
        mysqli_query($conn, "INSERT INTO users(name, email, email_verification_link ,password) VALUES('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . $token . "', '" . md5($_POST['password']) . "')");
        $link = "<a href='store.wachanindo.site/verify-email.php?key=".$_POST['email']."&token=".$token."'>Click and Verify Email</a>";
        $mail = new PHPMailer(true);
        $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;                  
        // GMAIL username
        $mail->Username = "solbadguyrockyougg@gmail.com";
        // GMAIL password
        $mail->Password = "frederick.666";
        $mail->SMTPSecure = "ssl";  
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From='solbadguyrockyougg@gmail.com';
        $mail->FromName='Kelompok C PW F';
        $mail->AddAddress(''.$receiver.'', ''.$receiverName.'');
        $mail->Subject  =  'Verify your email';
        $mail->IsHTML(true);
        $mail->Body    = 'Click On This Link to Verify Email '.$link.'';
        if($mail->Send())
        {
            echo "Check Your Email box and Click on the email verification link.";
        }
        else
        {
            echo "Mail Error - >".$mail->ErrorInfo;
        }
    }
    else
    {
      echo "You have already registered with us. Check Your email box and verify email.";
    }
   
}
?>