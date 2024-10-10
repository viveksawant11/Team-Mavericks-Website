<?php

namespace meetattendanceControl;
use meetattendances;

class meetattendanceController
{
    private $conn;
    private $requestMethod;
    private $meeting_srno;


    function __construct($db, $requestMethod, $meeting_srno)
    {
        $this->conn = $db;
        $this->meeting_srno = $meeting_srno;
        $this->requestMethod = $requestMethod;
        $this->meetattendances = new meetattendances($db);
    }

    public function processRequestForMeetAttendances()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->meetattendances->getMeetAttendance($this->meeting_srno);
                    $usrarr = array();
                    $usrarr['meetattendances'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('meet_srno' => $res['meet_srno'], 'user_srno' => $res['user_srno'], 'meeting_srno' => $res['meeting_srno']);
                        array_push($usrarr['meetattendances'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meetattendances->insertMeetAttendance($input);
                    http_response_code(201);
                    break;
                
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meetattendances->updateMeetAttendance($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->meetattendances->deleteMeetAttendance($this->login_srno);
                    break;
                    
            }
        }
}
?>