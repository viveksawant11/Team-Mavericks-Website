<?php
    session_start();
    require 'home/apicalls/apicall.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['event_srno'])){
        $eventSrno = $_SESSION['event_srno'];
        $participant_name = $_POST['name'];
        $participant_department = $_POST['department'];
        $participant_college = $_POST['college'];
        $participant_email = $_SESSION['participant_email'];
        $participant_contact = $_POST['contact'];
        
        $dataArray = array("participant_name" => $participant_name, "participant_email"=>$participant_email, "participant_contact" => $participant_contact, "participant_department" => $participant_department, "participant_college" => $participant_college);
        $data = json_encode($dataArray);
        postApi('participants', $data);

        $response = getApi('participants');
        $data = json_decode($response, true);
        $participant_srno = end($data['participants'])['participant_srno'];
        
        $dataArray2 = array("participant_srno" => $participant_srno, "event_srno"=>$eventSrno);
        $data2 = json_encode($dataArray2);
        postApi('registrations', $data2);

        $response = getApi('registrations');
        $data = json_decode($response, true);
        $registration = end($data['registrations']);
        $part = $registration['participant_srno'];
        $eve = $registration['event_srno'];
        $reg = $registration['registration_srno'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $source = $_FILES['image']['tmp_name'];
        $destination = "home/assets/img/payment/proof".$part.$eve.$reg.".jpg"; // Specify the destination folder path
        move_uploaded_file($source, $destination);
        }
    
        $response = getApi('events/'.$_SESSION['event_srno']);
        $data = json_decode($response, true);
        foreach(array_reverse($data['events']) as $event){
            $eventname = $event['event_name'];
            $date = date_create($event['event_date']);
            $time = $event['event_time'];
            $event_date = date_format($date, "jS M Y");
            $event_time = date('h:i a', strtotime($time));
            $loc = $event['event_location'];
        }
        $subject="Registration Successfull";
        $message = "Dear $participant_name,\n\nYou have successfully registered for ".$eventname.". See you on ".$event_date." at ".$event_time." in ".$loc."\n\nBest regards,\nTeam Mavericks\nKITCOEK";
        $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>";
        mail($participant_email,$subject,$message, $header);
    }
    header('location:success.php');
?>