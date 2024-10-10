<?php
require('apicall.php');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    deleteApi('participants/'.$_POST['participant_srno']);
    deleteApi('registrations/'.$_POST['participant_srno']);
    header('location:../participants.php');
}
    
?>