<?php
session_start();
use userControl\userController;
use loginControl\loginController;
use meetingControl\meetingController;
use eventControl\eventController;
use taskControl\taskController;
use participantControl\participantController;
use registrationControl\registrationController;
use meetattendanceControl\meetattendanceController;
use eventattendanceControl\eventattendanceController;

include_once('../restapi/core/initialize.php');

require_once(SITE_ROOT.DS.'services'.DS.'users.php');
require_once(SITE_ROOT.DS.'services'.DS.'logins.php');
require_once(SITE_ROOT.DS.'services'.DS.'meetings.php');
require_once(SITE_ROOT.DS.'services'.DS.'events.php');
require_once(SITE_ROOT.DS.'services'.DS.'tasks.php');
require_once(SITE_ROOT.DS.'services'.DS.'participants.php');
require_once(SITE_ROOT.DS.'services'.DS.'registrations.php');
require_once(SITE_ROOT.DS.'services'.DS.'meetattendances.php');
require_once(SITE_ROOT.DS.'services'.DS.'eventattendances.php');

require_once(SITE_ROOT.DS.'controllers'.DS.'userController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'loginController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'meetingController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'eventController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'taskController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'participantController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'registrationController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'meetattendanceController.php');
require_once(SITE_ROOT.DS.'controllers'.DS.'eventattendanceController.php');

$http_origin = $_SERVER['HTTP_ORIGIN'];

if ($http_origin == "https://dev.teammavericks.org" || $http_origin == "http://localhost:3000")
{  
    header("Access-Control-Allow-Origin: $http_origin");
}

//header("Access-Control-Allow-Origin: http://localhost:3000");
header("Vary: Origin");
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    // if($uri[3] != $_SESSION['code'])
    // {
        switch($uri[3])
        {
            case 'users': 
                $user_srno = null;
                if(isset($uri[4]))
                {
                    $user_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new userController($db, $requestMethod, $user_srno);
                $result = $controller->processRequestForUsers();
                echo $result;
                break;
                
            case 'tasks': 
                $task_srno = null;
                if(isset($uri[4]))
                {
                    $task_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new taskController($db, $requestMethod, $task_srno);
                $result = $controller->processRequestForTasks();
                echo $result;
                break;
                
            case 'logins':
                $login_srno = null;
                if(isset($uri[4]))
                {
                    $login_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new loginController($db, $requestMethod, $login_srno);
                $result = $controller->processRequestForLogins();
                echo $result;
                break;
    
            case 'meetings':
                $meeting_srno = null;
                if(isset($uri[4]))
                {
                    $meeting_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new meetingController($db, $requestMethod, $meeting_srno);
                $result = $controller->processRequestForMeetings();
                echo $result;
                break;
                
            case 'events':
                $event_srno = null;
                if(isset($uri[4]))
                {
                    $event_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new eventController($db, $requestMethod, $event_srno);
                $result = $controller->processRequestForEvents();
                echo $result;
                break;
    
            case 'registrations':
                $registration_srno = null;
                if(isset($uri[4]))
                {
                    $registration_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new registrationController($db, $requestMethod, $registration_srno);
                $result = $controller->processRequestForRegistrations();
                echo $result;
                break;
                
            case 'meetingattendances':
                $meeting_srno = null;
                if(isset($uri[4]))
                {
                    $meeting_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new meetattendanceController($db, $requestMethod, $meeting_srno);
                $result = $controller->processRequestForMeetAttendances();
                echo $result;
                break;
                
            case 'eventattendances':
                $event_srno = null;
                if(isset($uri[4]))
                {
                    $event_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new eventattendanceController($db, $requestMethod, $event_srno);
                $result = $controller->processRequestForEventAttendances();
                echo $result;
                break;
                
            case 'participants': 
                $participant_srno = null;
                if(isset($uri[4]))
                {
                    $participant_srno = (int) $uri[4];
                }
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $controller = new participantController($db, $requestMethod, $participant_srno);
                $result = $controller->processRequestForParticipants();
                echo $result;
                break;
                
            default:
                header("HTTP/1.1 404 Not Found");
                exit();
        }
    // }
    session_destroy();
?>