<?php
session_start();

require('apicall.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dataArray = array('event_name' => $_POST['event_name'], 'event_date' => $_POST['event_date'], 'event_time' => $_POST['event_time'], 'event_location' => $_POST['event_location'],'event_fee' => $_POST['event_fee'], 'event_status' => 0, 'event_description' => $_POST['event_description'], 'event_approval' => 0);  
    $event = json_encode($dataArray);
    postApi('events', $event);
    
    $eventResponse =  getApi('events');
    $eventJson = json_decode($eventResponse, true);

    foreach(array_reverse($eventJson['events']) as $event){
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $source = $_FILES['image']['tmp_name'];
        $destination = "../assets/img/banners/event".$event['event_srno'].".webp"; // Specify the destination folder path
        move_uploaded_file($source, $destination);
    }

    if (isset($_FILES['qr']) && $_FILES['qr']['error'] === UPLOAD_ERR_OK) {
        $source = $_FILES['qr']['tmp_name'];
        $destination = "../assets/img/qr/qr".$event['event_srno'].".png"; // Specify the destination folder path
        move_uploaded_file($source, $destination);
    }

    if (isset($_FILES['brochure']) && $_FILES['brochure']['error'] === UPLOAD_ERR_OK) {
        $source = $_FILES['brochure']['tmp_name'];
        $destination = "../assets/documents/event".$event['event_srno'].".pdf"; // Specify the destination folder path
        move_uploaded_file($source, $destination);
    }

    break;
    }

    $subject="Event Approval Request";
    $message = "Dear Admin,\n\nYou have received an approval request for new event. Please do the needful at earliest.\n\nBest regards,\nTeam Mavericks\nKITCOEK";
    $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>";

    $UsersResponse = getApi('users');
    $usersJson = json_decode($response, true);
    foreach($UsersJson['users'] as $user){
        if($user['user_role'] == "a")
            mail($user['email'],$subject,$message, $header);
    }

    header('location:../events.php');
}
    
?>