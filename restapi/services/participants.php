
<?php
    class participants
    {
        private $conn;
        private $participant_srno;
        private $participant_name;
        private $participant_contact;
        private $participant_email;
        private $participant_college;
        private $participant_department;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getParticipant($participant_srno)
        {
            if($participant_srno == null)
            {
                $sql = "select * from participants;";
            }
            else
            {
                $this->participant_srno = $participant_srno;
                $sql = "select * from participants where participant_srno = $this->participant_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertParticipant($arr)
        {
            $this->participant_name = $arr['participant_name'];
            $this->participant_contact = $arr['participant_contact'];
            $this->participant_email = $arr['participant_email'];
            $this->participant_department = $arr['participant_department'];
            $this->participant_college = $arr['participant_college'];
            $sql = "INSERT INTO `participants` (`participant_srno`, `participant_contact`, `participant_email`,`participant_name`, `participant_department`, `participant_college`) VALUES (NULL, '$this->participant_contact', '$this->participant_email', '$this->participant_name', '$this->participant_department', '$this->participant_college');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateParticipant($arr)
        {
            $this->participant_srno = $arr['participant_srno'];
            $this->participant_name = $arr['participant_name'];
            $this->participant_contact = $arr['participant_contact'];
            $this->participant_email = $arr['participant_email'];
            $this->participant_department = $arr['participant_department'];
            $this->participant_college = $arr['participant_college'];
            $sql = "update participants set participant_name = '$this->participant_name', participant_contact = '$this->participant_contact', participant_email = '$this->participant_email', participant_department = '$this->participant_department', participant_college = '$this->participant_college' where participant_srno = '$this->participant_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteParticipant($participant_srno)
        {
            $this->participant_srno = $participant_srno;
            $sql = "delete from participants where participant_srno = '$this->participant_srno';";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>