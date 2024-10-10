<?php

namespace eventControl;
use events;

class eventController
{
    private $conn;
    private $requestMethod;
    private $event_srno;


    function __construct($db, $requestMethod, $event_srno)
    {
        $this->conn = $db;
        $this->event_srno = $event_srno;
        $this->requestMethod = $requestMethod;
        $this->events = new events($db);
    }

    public function processRequestForEvents()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->events->getEvent($this->event_srno);
                    $usrarr = array();
                    $usrarr['events'] = array();
                    foreach($response as $res)
                    {
                        $useritm = array('event_srno' => $res['event_srno'], 'event_name' => $res['event_name'], 'event_date' => $res['event_date'], 'event_time' => $res['event_time'], 'event_location' => $res['event_location'], 'event_fee' => $res['event_fee'], 'event_status' => $res['event_status'], 'event_description' => $res['event_description'], 'event_approval' => $res['event_approval']);
                        array_push($usrarr['events'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->events->insertEvent($input);
                    http_response_code(201);
                    break;
                
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->events->updateEvent($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->events->deleteEvent($this->event_srno);
                    break;
                    
            }
        }
}
?>