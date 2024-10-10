
<?php
    class users
    {
        private $conn;
        private $user_srno;
        private $name;
        private $contact;
        private $email;
        private $user_role; 
        private $user_dob;
        private $user_department;
        private $user_joining;
        private $user_designation;
        private $user_about;


        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getUser($user_srno)
        {
            if($user_srno == null)
            {
                $sql = "select * from users;";
            }
            else
            {
                $this->user_srno = $user_srno;
                $sql = "select * from users where user_srno = $this->user_srno;";
            }
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; 
        }

        public function insertUser($arr)
        {
            $this->name = $arr['name'];
            $this->email = $arr['email'];
            $this->user_role = $arr['user_role'];
            $sql = "INSERT INTO `users` (`user_srno`, `email`, `user_role`, `name`) VALUES (NULL, '$this->email', '$this->user_role', '$this->name');";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function updateUser($arr)
        {
            $this->user_srno = $arr['user_srno'];
            $this->name = $arr['name'];
            $this->contact = $arr['contact'];
            $this->email = $arr['email'];
            $this->user_role = $arr['user_role'];
            $this->user_dob = $arr['user_dob'];
            $this->user_department = $arr['user_department'];
            $this->user_joining = $arr['user_joining'];
            $this->user_designation = $arr['user_designation'];
            $this->user_about = $arr['user_about'];
            $sql = "update users set name = '$this->name', contact = '$this->contact', email = '$this->email', user_role = '$this->user_role', user_dob = '$this->user_dob', user_department = '$this->user_department', user_joining = '$this->user_joining', user_designation = '$this->user_designation', user_about = '$this->user_about' where user_srno = '$this->user_srno';";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            http_response_code(201);
        }
        
        public function deleteUser($user_srno)
        {
            $this->user_srno = $user_srno;
            $sql = "delete from users where user_srno = $this->user_srno;";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>