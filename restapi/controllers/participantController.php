<?php

namespace participantControl;
use participants;

class participantController
{
    private $conn;
    private $requestMethod;
    private $participant_srno;


    function __construct($db, $requestMethod, $participant_srno)
    {
        $this->conn = $db;
        $this->participant_srno = $participant_srno;
        $this->requestMethod = $requestMethod;
        $this->participants = new participants($db);
    }

    public function processRequestForParticipants()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->participants->getParticipant($this->participant_srno);
                    $usrarr = array();
                    $usrarr['participants'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('participant_srno' => $res['participant_srno'], 'participant_contact' => $res['participant_contact'], 'participant_email' => $res['participant_email'], 'participant_college' => $res['participant_college'], 'participant_name' => $res['participant_name'], 'participant_department' => $res['participant_department']);
                        array_push($usrarr['participants'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->participants->insertParticipant($input);
                    http_response_code(201);
                    break;
                    
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->participants->updateParticipant($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->participants->deleteParticipant($this->participant_srno);
                    http_response_code(200);
                    break;
                    
            }
        }
}
?>