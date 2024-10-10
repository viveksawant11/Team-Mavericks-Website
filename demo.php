<?php
    session_start();
    require 'home/apicalls/apicall.php';
    

        $response = getApi('participants');
        $data = json_decode($response, true);
        echo end($data['participants'])['participant_srno'];
?>