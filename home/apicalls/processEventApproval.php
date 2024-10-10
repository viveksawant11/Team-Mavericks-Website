<?php
    session_start();
    require 'apicall.php';

    if(isset($_POST['approvedEvent'])){
        $eventsResponse = getapi('events/'.$_POST['approvedEvent']);
        $eventsJson = json_decode($eventsResponse, true);

        foreach($eventsJson['events'] as $event){
            $event['event_approval'] = 1;
            $updatedEvent = json_encode($event, true);
            putApi('events', $updatedEvent);
            break;
        }
        $_SESSION['modal'] = 1;
    }

    if(isset($_POST['declinedEvent'])){
        deleteApi('events/'.$_POST['declinedEvent']);
        $_SESSION['modal'] = 2;
    }
    
    header('location:../approvals.php');
?>