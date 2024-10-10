<?php
session_start();
require('apicall.php');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $dataArray = array('meeting_location' => $_POST['meeting_location'], 'meeting_date' => $_POST['meeting_date'], 'meeting_time' => $_POST['meeting_time'], 'meeting_agenda' => $_POST['meeting_agenda'], 'meeting_status' => 0, 'meeting_summary' => '', 'meeting_caller' => $_SESSION['user_srno'], 'meeting_approval' => 0);  
    $data = json_encode($dataArray);
    
    postApi('meetings', $data);
    $response = getApi('users/'.$_SESSION['user_srno']);
    $data = json_decode($response, true);
    foreach($data['users'] as $users)
    {
        $user = $users;
    }
    $date = date_create($_POST['meeting_date']);
	$time = $_POST['meeting_time'];
	$meeting_date = date_format($date, "jS M Y");
	$meeting_time = date('h:i a', strtotime($time));
    $subject="Awating Approval";
    $message = "Dear ".$user['name'].",\n\nWe have received your request to schedule meeting. It is waiting for approval. We'll let you know as soon as it is approved. \n\nMeeting Details:\nDate: ".$meeting_date."\nTime: ".$meeting_time."\Location: ".$_POST['meeting_location']."\nAgenda: ".$_POST['meeting_agenda']."\n\nOnce approved, you can visit the meeting on Dashboard.\n\nBest regards,\nTeam Mavericks\nKITCOEK";
    $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>";
    mail($user['email'],$subject,$message, $header);
    
    $subject="Meeting Approval Request";
    $message = "Dear Admin,\n\nYou have received a approval request for a meeting. Please do the needful at earliest.\n\nBest regards,\nTeam Mavericks\nKITCOEK";
    $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>";
    $response = getApi('users');
    $data = json_decode($response, true);
    foreach($data['users'] as $users)
    {
        if($users['user_role'] == "a")
            mail($users['email'],$subject,$message, $header);
    }
    $_SESSION['addmeeting'] =1;
    header('location:../meetings.php');

}
    
?>