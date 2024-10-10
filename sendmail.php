<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $num=rand(1001, 9999);
        $code = strval($num);
        $_SESSION['OTP'] = $code;
        $message="Thank you for showing interest!\nYour Email Verification Code is\n".$code;
        $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>\n";
        $subject = "Email Verification Code";
        mail($email,$subject,$message, $header);
        $_SESSION['participant_email'] = $email;
        header('location:otp.php');
    }
?>