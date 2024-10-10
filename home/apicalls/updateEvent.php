<?php
    require('apicall.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!isset($_POST['event_status']) || $_POST['event_status'] == 0){
            $dataArray = array('event_srno'=> (int)$_POST['event_srno'], 'event_name'=> $_POST['event_name'], 'event_location' => $_POST['event_location'], 'event_date' => $_POST['event_date'], 'event_time' => $_POST['event_time'], 'event_fee' => $_POST['event_fee'], 'event_status' => 0, 'event_description' => $_POST['event_description'], 'event_approval'=> 0);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $source = $_FILES['image']['tmp_name'];
                $destination = "../assets/img/banners/event".$_POST['event_srno'].".png"; // Specify the destination folder path
                move_uploaded_file($source, $destination);
            }
        
            if (isset($_FILES['qr']) && $_FILES['qr']['error'] === UPLOAD_ERR_OK) {
                $source = $_FILES['qr']['tmp_name'];
                $destination = "../assets/img/qr/qr".$_POST['event_srno'].".png"; // Specify the destination folder path
                move_uploaded_file($source, $destination);
            }
        
            if (isset($_FILES['brochure']) && $_FILES['brochure']['error'] === UPLOAD_ERR_OK) {
                $source = $_FILES['brochure']['tmp_name'];
                $destination = "../assets/documents/event".$_POST['event_srno'].".pdf"; // Specify the destination folder path
                move_uploaded_file($source, $destination);
            }  
        }
        else
            $dataArray = array('event_srno'=> (int)$_POST['event_srno'], 'event_name'=> $_POST['event_name'], 'event_location' => $_POST['event_location'], 'event_date' => $_POST['event_date'], 'event_time' => $_POST['event_time'], 'event_fee' => $_POST['event_fee'], 'event_status' => 1, 'event_description' => $_POST['event_description']);    

        $data = json_encode($dataArray);
        putApi('events', $data);
        header('location:../events.php');
    } 
?>