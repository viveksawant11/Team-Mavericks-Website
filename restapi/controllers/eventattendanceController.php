<?php

namespace eventattendanceControl;
use eventattendances;

class eventattendanceController
{
    private $conn;
    private $requestMethod;
    private $event_srno;

    function __construct($db, $requestMethod, $event_srno)
    {
        $this->conn = $db;
        $this->event_srno = $event_srno;
        $this->requestMethod = $requestMethod;
        $this->eventattendances = new eventattendances($db);
    }

    public function processRequestForEventAttendances()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->eventattendances->getEventAttendance($this->event_srno);
                    $usrarr = array();
                    $usrarr['eventattendances'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('attendance_srno' => $res['attendance_srno'], 'user_srno' => $res['user_srno'], 'event_srno' => $res['event_srno'], 'attendance_date' => $res['attendance_date'], 'attendance_time' => $res['attendance_time']);
                        array_push($usrarr['eventattendances'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->eventattendances->insertEventAttendance($input);
                    http_response_code(201);
                    break;
                
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->eventattendances->updateEventAttendance($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->eventattendances->deleteEventAttendance($this->login_srno);
                    break;
                    
            }
        }
}
?>