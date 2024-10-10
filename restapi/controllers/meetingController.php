<?php

namespace meetingControl;
use meetings;

class meetingController
{
    private $conn;
    private $requestMethod;
    private $meeting_srno;


    function __construct($db, $requestMethod, $meeting_srno)
    {
        $this->conn = $db;
        $this->meeting_srno = $meeting_srno;
        $this->requestMethod = $requestMethod;
        $this->meetings = new meetings($db);
    }

    public function processRequestForMeetings()
        {
            switch($this->requestMethod)
            {
                case 'GET':
                    $response = $this->meetings->getMeeting($this->meeting_srno);
                    $usrarr = array();
                    $usrarr['meetings'] = array(); 
                    foreach($response as $res)
                    {
                        $useritm = array('meeting_srno' => $res['meeting_srno'], 'meeting_location' => $res['meeting_location'], 'meeting_date' => $res['meeting_date'], 'meeting_time' => $res['meeting_time'], 'meeting_agenda' => $res['meeting_agenda'], 'meeting_status' => $res['meeting_status'],  'meeting_summary' => $res['meeting_summary'], 'meeting_caller' => $res['meeting_caller'], 'meeting_approval' => $res['meeting_approval']);
                        array_push($usrarr['meetings'], $useritm);
                    }
                    http_response_code(200);
                    return json_encode($usrarr);
                    break;
                    
                case 'POST':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meetings->insertMeeting($input);
                    http_response_code(201);
                    break;
                
                case 'PUT':
                    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                    $this->meetings->updateMeeting($input);
                    http_response_code(201);
                    break;

                case 'DELETE':
                    $this->meetings->deleteMeeting($this->meeting_srno);
                    break;
                    
            }
        }
}
?>