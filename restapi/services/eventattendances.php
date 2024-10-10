
<?php
    class eventattendances
    {
        private $conn;
        private $attendance_srno;
        private $user_srno;
        private $attendance_date;
        private $attenadnce_time;
        private $event_srno; 


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getEventAttendance($event_srno)
        {
            if($event_srno == null)
            {
                $sql = "select * from eventattendances;";
            }
            else
            {
                $this->event_srno = $event_srno;
                $sql = "select * from eventattendances where event_srno = $this->event_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertEventAttendance($arr)
        {
         
            $this->user_srno = $arr['user_srno'];
            $this->attendance_date = $arr['attendance_date'];
            $this->attendance_time = $arr['attendance_time'];
            $this->event_srno = $arr['event_srno'];
            $sql = "INSERT INTO `eventattendances` (`attendance_srno`, `user_srno`, `attendance_date`, `attendance_time`, `event_srno`) VALUES (NULL, '$this->user_srno', '$this->attendance_date', '$this->attendance_time', '$this->event_srno');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateEventAttendance($arr)
        {
             $this->meet_srno = $arr['attendance_srno'];
            $this->user_srno = $arr['user_srno'];
            $this->attendance_date = $arr['attendance_date'];
            $this->attendance_time = $arr['attendance_time'];
            $this->event_srno = $arr['event_srno'];
            $sql = "update eventattendances set user_srno = '$this->user_srno', event_srno = '$this->event_srno', attendance_date = '$this->attendance_date', attendance_time = '$this->attendance_time' where attendance_srno = '$this->attendance_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteEventAttendance($event_srno)
        {
            $this->meet_srno = $meet_srno;
            $sql = "delete from eventattendances where attendance_srno = $this->event_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>