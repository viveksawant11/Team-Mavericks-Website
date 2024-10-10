<?php

namespace taskControl;
use tasks;

class taskController
{
    private $conn;
    private $requestMethod;
    private $task_srno;


    function __construct($db, $requestMethod, $task_srno)
    {
        $this->conn = $db;
        $this->task_srno = $task_srno;
        $this->requestMethod = $requestMethod;
        $this->tasks = new tasks($db);
    }

    public function processRequestForTasks()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->tasks->getTask($this->task_srno);
                    $usrarr = array();
                    $usrarr['tasks'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('task_srno' => $res['task_srno'], 'task_name' => $res['task_name'], 'task_description' => $res['task_description'], 'assigned_to' => $res['assigned_to'], 'deadline' => $res['deadline'], 'task_status' => $res['task_status']);
                        array_push($usrarr['tasks'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->tasks->insertTask($input);
                    http_response_code(201);
                    break;
                    
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->tasks->updateTask($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->users->deleteTask($this->task_srno);
                    http_response_code(200);
                    break;
                    
            }
        }
}
?>