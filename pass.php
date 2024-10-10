<?php
    session_start();
    
    require 'home/apicalls/apicall.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $_SESSION['event_srno'] = $_POST['event_srno'];
            
        $event = getApi('events/'.$_SESSION['event_srno']);
        $data = json_decode($event, true);

        foreach ($data['events'] as $event) {
            $_SESSION['event_name'] = $event['event_name'];
            break;
        }
        header('location:emailVerification.php');
    }
?>
