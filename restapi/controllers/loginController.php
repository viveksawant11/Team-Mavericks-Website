<?php

namespace loginControl;
use logins;

class loginController
{
    private $conn;
    private $requestMethod;
    private $login_srno;


    function __construct($db, $requestMethod, $login_srno)
    {
        $this->conn = $db;
        $this->login_srno = $login_srno;
        $this->requestMethod = $requestMethod;
        $this->logins = new logins($db);
    }

    public function processRequestForLogins()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->logins->getLogin($this->login_srno);
                    $usrarr = array();
                    $usrarr['logins'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('login_srno' => $res['login_srno'], 'username' => $res['username'], 'password' => $res['password'], 'user_srno' => $res['user_srno']);
                        array_push($usrarr['logins'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->logins->insertLogin($input);
                    http_response_code(201);
                    break;
                
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->logins->updateLogin($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->logins->deleteLogin($this->login_srno);
                    break;
                    
            }
        }
}
?>