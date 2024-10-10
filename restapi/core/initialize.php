<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'home'.DS.'u714635531'.DS.'domains'.DS.'teammavericks.org'.DS.'public_html'.DS.'developer'.DS.'restapi');
    defined('INC__PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

require_once(INC_PATH.DS.'config.php');
require_once(SITE_ROOT.DS.'services'.DS.'users.php');
require_once(SITE_ROOT.DS.'services'.DS.'logins.php');
require_once(SITE_ROOT.DS.'services'.DS.'meetings.php');
require_once(SITE_ROOT.DS.'services'.DS.'events.php');
require_once(SITE_ROOT.DS.'services'.DS.'tasks.php');
require_once(SITE_ROOT.DS.'services'.DS.'participants.php');
require_once(SITE_ROOT.DS.'services'.DS.'registrations.php');
require_once(SITE_ROOT.DS.'services'.DS.'meetattendances.php');
require_once(SITE_ROOT.DS.'services'.DS.'eventattendances.php');

?>
