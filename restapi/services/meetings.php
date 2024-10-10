
<?php
    class meetings
    {
        private $conn;
        private $meeting_srno;
        private $meeting_location;
        private $meeting_date;
        private $meeting_time;
        private $meeting_agenda;
        private $meeting_status; 
        private $meeting_summary;
        private $meeting_caller;
        private $meeting_approval;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getMeeting($meeting_srno)
        {
            if($meeting_srno == null)
            {
                $sql = "select * from meetings;";
            }
            else
            {
                $this->meeting_srno = $meeting_srno;
                $sql = "select * from meetings where meeting_srno = $this->meeting_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertMeeting($arr)
        {
            $this->meeting_location = $arr['meeting_location'];
            $this->meeting_date = $arr['meeting_date'];
            $this->meeting_time = $arr['meeting_time'];
            $this->meeting_agenda = $arr['meeting_agenda'];
            $this->meeting_status = $arr['meeting_status'];
            $this->meeting_summary = $arr['meeting_summary'];
            $this->meeting_caller = $arr['meeting_caller'];
            $this->meeting_approval = $arr['meeting_approver'];
            $sql = "INSERT INTO `meetings` (`meeting_srno`, `meeting_location`, `meeting_date`, `meeting_time`, `meeting_agenda`, `meeting_status`, `meeting_summary`, `meeting_caller`, `meeting_approval`) VALUES (NULL, '$this->meeting_location', '$this->meeting_date', '$this->meeting_time', '$this->meeting_agenda', '$this->meeting_status', '$this->meeting_summary', '$this->meeting_caller', '$this->meeting_approval');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateMeeting($arr)
        {
            $this->meeting_srno = $arr['meeting_srno'];
            $this->meeting_location = $arr['meeting_location'];
            $this->meeting_date = $arr['meeting_date'];
            $this->meeting_time = $arr['meeting_time'];
            $this->meeting_agenda = $arr['meeting_agenda'];
            $this->meeting_status = $arr['meeting_status'];
            $this->meeting_summary = $arr['meeting_summary'];
            $this->meeting_caller = $arr['meeting_caller'];
            $this->meeting_approval = $arr['meeting_approval'];
            $sql = "update meetings set meeting_location = '$this->meeting_location', meeting_date = '$this->meeting_date', meeting_time = '$this->meeting_time', meeting_agenda = '$this->meeting_agenda', meeting_status = '$this->meeting_status', meeting_summary = '$this->meeting_summary', meeting_caller = '$this->meeting_caller', meeting_approval = '$this->meeting_approval' where meeting_srno = '$this->meeting_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteMeeting($meeting_srno)
        {
            $this->meeting_srno = $meeting_srno;
            $sql = "delete from meetings where meeting_srno = $this->meeting_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>