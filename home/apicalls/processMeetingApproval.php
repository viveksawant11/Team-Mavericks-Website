<?php
    require('apicall.php');

    if(isset($_POST['approvedMeeting'])){
        $meetingsResponse = getapi('meetings/'.$_POST['approvedMeeting']);
        $meetingJson = json_decode($meetingsResponse, true);
        
        foreach($meetingJson['meetings'] as $meeting){
            $meeting['meeting_approval'] = 1;
            $updatedMeeting = json_encode($meeting, true);
            putApi('meetings', $updatedMeeting);

            $usersResponse = getApi('users/'.$meeting['meeting_caller']);
            $usersJson = json_decode($usersResponse, true);
            foreach($usersJson['users'] as $user)
                $calledBy = $user['name'];

            $usersResponse = getApi('users');
            $usersJson = json_decode($usersResponse, true);

            foreach($usersJson['users'] as $user){
                if($user['user_role'] != "p"){
                    $date = date_create($meeting['meeting_date']);
    				$time = $meeting['meeting_time'];
    				$meeting_date = date_format($date, "jS M Y");
    				$meeting_time = date('h:i a', strtotime($time));

                    $subject = "Team Meeting";
                    $message = "Dear ".$user['name'].",\n\nWe hope this email finds you all well. This is to inform you about an upcoming team meeting that has been scheduled by ".$calledBy." to discuss the following agenda. Please review the following details:\n\nDate: ".$meeting_date."\nTime: ".$meeting_time."\nLocation: ".$meeting['meeting_location']."\nAgenda: ".$meeting['meeting_agenda']."\n\nPlease make sure to come prepared for the meeting by reviewing the relevant materials.\nLooking forward to your active involvement in our upcoming team meeting.\n\nBest regards,\nTeam Mavericks\nKITCOEK\n\nStay Updated, Stay Ahead";
                    $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>";
                    mail($user['email'],$subject,$message, $header);
                }
            }
            break;
        }
        $_SESSION['modal'] = 1;
    }
    
    if(isset($_POST['declinedMeeting'])){
        deleteApi('meetings/'.$_POST['declinedMeeting']);
        $_SESSION['modal'] = 2;
    }
    
    header('location:../approvals.php');
?>