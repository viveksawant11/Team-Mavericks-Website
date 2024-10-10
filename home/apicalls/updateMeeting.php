<?php
    require 'apicall.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['meeting_summary']=="")
            $dataArray = array('meeting_srno'=> (int)$_POST['meeting_srno'], 'meeting_location' => $_POST['meeting_location'], 'meeting_date' => $_POST['meeting_date'], 'meeting_time' => $_POST['meeting_time'], 'meeting_agenda' => $_POST['meeting_agenda'], 'meeting_status' => 0, 'meeting_approval' => 0, 'meeting_summary' => $_POST['meeting_summary']);  

        else
            $dataArray = array('meeting_srno'=> (int)$_POST['meeting_srno'], 'meeting_location' => $_POST['meeting_location'], 'meeting_date' => $_POST['meeting_date'], 'meeting_time' => $_POST['meeting_time'], 'meeting_agenda' => $_POST['meeting_agenda'], 'meeting_status' => 1, 'meeting_approval' => 1,'meeting_summary' => $_POST['meeting_summary']);    
        
        $data = json_encode($dataArray);
        putApi('meetings', $data);
        
        header('location:../meetings.php');
    }  
?>  