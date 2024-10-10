<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $teammail ="mavericksbodhantra@gmail.com";
        $msg="This is query raised by ".$name."\n\nSubject: ".$subject."\n\nMessage: ".$message."\n\nContact him at: ".$email;
        $header = "FROM: queries@webpost\r\n";
        $sub = "Query posted on Website";
        mail($teammail,$sub,$msg, $header);
        header('location:contact.html');
    }
?>