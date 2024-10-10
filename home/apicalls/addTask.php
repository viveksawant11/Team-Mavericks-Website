<?php
    session_start();
    require('apicall.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dataArray = array('task_name' => $_POST['task_name'], 'task_description' => $_POST['task_description'], 'assigned_to' => $_POST['assigned_to'], 'deadline' => $_POST['deadline'], 'task_status' => 0);  
        $data = json_encode($dataArray);
        postApi('tasks', $data);

        $response = getApi('users/'.$_POST['assigned_to']);
        $data = json_decode($response, true);
        foreach($data['users'] as $user){
            if($user['user_role'] != "p"){
                $subject="New Task Allocated !";
                $message = "Dear ".$user['name'].",\n\nHope this email finds you well. You have been assigned with the task of ".$_POST['task_name'].". Please review the details regarding the same in your account's dashboard.\nWe appreciate your hard work and look forward to a successful completion of this task before deadline. If you have any query, please reach out to Admin.\n\nThank You !\nTeam Mavericks.\nKITCOEK\n\nStay Updated, Stay Ahead !";
                $header = "FROM: Team Mavericks <mavericksbodhantra@gmail.com>";
                mail($user['email'],$subject,$message, $header);
            }
        }

        header('location:../tasks.php');
    }
?>