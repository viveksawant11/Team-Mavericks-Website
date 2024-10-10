
<?php
    class events
    {
        private $conn;	
        private $event_name;	
        private $event_date;	
        private $event_time;	
        private $event_location;	
        private $event_fee;	
        private $event_status;
        private $event_srno;
        private $event_approval;
        private $event_description;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getEvent($event_srno)
        {
            if($event_srno == null)
            {
                $sql = "select * from events;";
            }
            else
            {
                $this->event_srno = $event_srno;
                $sql = "select * from events where event_srno = $this->event_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertEvent($arr)
        {
            $this->event_name = $arr['event_name'];
            $this->event_date = $arr['event_date'];
            $this->event_time = $arr['event_time'];
            $this->event_location = $arr['event_location'];
            $this->event_fee = $arr['event_fee'];
            $this->event_status = $arr['event_status'];
            $this->event_description = $arr['event_description'];
            $this->event_approval = $arr['event_approval'];
            $sql = "INSERT INTO `events` (`event_srno`, `event_name`, `event_date`, `event_time`, `event_location`, `event_fee`, `event_status`, `event_description`, `event_approval`) VALUES (NULL, '$this->event_name', '$this->event_date', '$this->event_time', '$this->event_location', '$this->event_fee', '$this->event_status', '$this->event_description', '$this->event_approval');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateEvent($arr)
        {
            $this->event_srno = $arr['event_srno'];
            $this->event_name = $arr['event_name'];
            $this->event_date = $arr['event_date'];
            $this->event_time = $arr['event_time'];
            $this->event_location = $arr['event_location'];
            $this->event_fee = $arr['event_fee'];
            $this->event_status = $arr['event_status'];
            $this->event_description = $arr['event_description'];
            $this->event_approval = $arr['event_approval'];
            $sql = "update events set event_name = '$this->event_name', event_date = '$this->event_date', event_time = '$this->event_time', event_location = '$this->event_location', event_fee = '$this->event_fee', event_status = '$this->event_status', event_description = '$this->event_description',event_approval = '$this->event_approval' where event_srno = '$this->event_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteEvent($event_srno)
        {
            $this->event_srno = $event_srno;
            $sql = "delete from events where event_srno = $this->event_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>