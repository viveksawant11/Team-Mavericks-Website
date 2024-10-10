<?php
    class registrations
    {
        private $conn;
        private $registration_srno;
        private $participant_srno;
        private $event_srno;
        private $subevent_srno;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getRegistration($registration_srno)
        {
            if($registration_srno == null)
            {
                $sql = "select * from registrations;";
            }
            else
            {
                $this->registration_srno = $registration_srno;
                $sql = "select * from registrations where event_srno = $this->registration_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertRegistration($arr)
        {
            $this->event_srno = $arr['event_srno'];
            $this->subevent_srno = $arr['subevent_srno'];
            $this->participant_srno = $arr['participant_srno'];
            $sql = "INSERT INTO `registrations` (`registration_srno`, `event_srno`,`participant_srno`) VALUES (NULL, '$this->event_srno', '$this->participant_srno');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateRegistration($arr)
        {
            $this->registration_srno = $arr['registration_srno'];
            $this->event_srno = $arr['event_srno'];
            $this->subevent_srno = $arr['subevent_srno'];
            $this->participant_srno = $arr['participant_srno'];
            $sql = "update registrations set event_srno = '$this->event_srno', participant_srno = '$this->participant_srno' where registration_srno = '$this->registration_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteRegistration($participant_srno)
        {
            $this->participant_srno = $participant_srno;
            $sql = "delete from registrations where participant_srno = $this->participant_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>