<?php

namespace registrationControl;
use registrations;

class registrationController
{
    private $conn;
    private $requestMethod;
    private $registration_srno;


    function __construct($db, $requestMethod, $registration_srno)
    {
        $this->conn = $db;
        $this->registration_srno = $registration_srno;
        $this->requestMethod = $requestMethod;
        $this->registrations = new registrations($db);
    }

    public function processRequestForRegistrations()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->registrations->getRegistration($this->registration_srno);
                    $usrarr = array();
                    $usrarr['registrations'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('registration_srno' => $res['registration_srno'], 'event_srno' => $res['event_srno'], 'participant_srno' => $res['participant_srno']);
                        array_push($usrarr['registrations'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->registrations->insertRegistration($input);
                    http_response_code(201);
                    break;
                
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->registrations->updateRegistration($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->registrations->deleteRegistration($this->registration_srno);
                    break;
                    
            }
        }
}
?>