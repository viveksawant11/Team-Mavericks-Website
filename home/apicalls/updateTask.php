<?php
    session_start();
    require('apicall.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $response = getApi('tasks/'.$_POST['task_srno']);
        $data = json_decode($response, 'true');
        foreach($data['tasks'] as $task)
            $dataArray = array('task_srno'=>$task['task_srno'], 'task_name'=>'asdfghjkl', 'task_description'=>$task['task_description'], 'assigned_to'=>$task['assigned_to'], 'deadline'=>$task['deadline'], 'task_status'=> 1);
    
        $datas = json_encode($dataArray);
        putApi('tasks', $datas);
        
        header('location:../tasks.php');
    }
?>