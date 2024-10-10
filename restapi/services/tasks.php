
<?php
    class tasks
    {
        private $conn;
        private $task_srno;
        private $task_name;
        private $task_description;
        private $assigned_to;
        private $deadline;
        private $task_status;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getTask($task_srno)
        {
            if($task_srno == null)
            {
                $sql = "select * from tasks;";
            }
            else
            {
                $this->task_srno = $task_srno;
                $sql = "select * from tasks where task_srno = $this->task_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertTask($arr)
        {
            $this->task_name = $arr['task_name'];
            $this->task_description = $arr['task_description'];
            $this->assigned_to = $arr['assigned_to'];
            $this->deadline = $arr['deadline'];
            $this->task_status = $arr['task_status'];
            $sql = "INSERT INTO `tasks` (`task_srno`, `task_name`, `task_description`, `assigned_to`, `deadline`, `task_status`) VALUES (NULL, '$this->task_name', '$this->task_description', '$this->assigned_to', '$this->deadline', '$this->task_status');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateTask($arr)
        {
            $this->task_srno = $arr['task_srno'];
            $this->task_name = $arr['task_name'];
            $this->task_description = $arr['task_description'];
            $this->assigned_to = $arr['assigned_to'];
            $this->deadline = $arr['deadline'];
            $this->task_status = $arr['task_status'];
            $sql = "update `tasks` set task_name = '$this->task_name', task_description = '$this->task_description', assigned_to = '$this->assigned_to', deadline = '$this->deadline', task_status = '$this->task_status' where task_srno = '$this->task_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteTask($task_srno)
        {
            $this->task_srno = $task_srno;
            $sql = "delete from tasks where task_srno = $this->task_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>