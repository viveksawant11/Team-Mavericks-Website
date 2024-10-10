
<?php
    class logins
    {
        private $conn;
        private $user_srno;
        private $username;
        private $password;
        private $login_srno; 


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getLogin($user_srno)
        {
            if($user_srno == null)
            {
                $sql = "select * from logins;";
            }
            else
            {
                $this->user_srno = $user_srno;
                $sql = "select * from logins where user_srno = $this->user_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertLogin($arr)
        {
            $this->username = $arr['username'];
            $this->password = $arr['password'];
            $this->user_srno = $arr['user_srno'];
            $sql = "INSERT INTO `logins` (`login_srno`, `username`, `password`, `user_srno`) VALUES (NULL, '$this->username', '$this->password', '$this->user_srno');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateLogin($arr)
        {
            $this->login_srno = $arr['login_srno'];
            $this->username = $arr['username'];
            $this->password = $arr['password'];
            $this->user_srno = $arr['user_srno'];
            $sql = "update `logins` set username = '$this->username', password = '$this->password', user_srno = '$this->user_srno' where login_srno = '$this->login_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteLogin($login_srno)
        {
            $this->login_srno = $login_srno;
            $sql = "delete from logins where login_srno = $this->login_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>