<?php

namespace userControl;
use users;

class userController
{
    private $conn;
    private $requestMethod;
    private $user_srno;


    function __construct($db, $requestMethod, $user_srno)
    {
        $this->conn = $db;
        $this->user_srno = $user_srno;
        $this->requestMethod = $requestMethod;
        $this->users = new users($db);
    }

    public function processRequestForUsers()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->users->getUser($this->user_srno);
                    $usrarr = array();
                    $usrarr['users'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('user_srno' => $res['user_srno'], 'contact' => $res['contact'], 'email' => $res['email'], 'user_role' => $res['user_role'], 'user_dob' => $res['user_dob'], 'user_department' => $res['user_department'], 'user_joining' => $res['user_joining'], 'user_designation' => $res['user_designation'], 'user_about' => $res['user_about'], 'name' => $res['name']);
                        array_push($usrarr['users'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->users->insertUser($input);
                    http_response_code(201);
                    break;
                    
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->users->updateUser($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->users->deleteUser($this->user_srno);
                    http_response_code(200);
                    break;
                    
            }
        }
}
?>