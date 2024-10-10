<?php
session_start();
require 'apicall.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dataArray = array('email' => $_POST['email'], 'user_role' => $_POST['role'], 'name' => $_POST['name']);  

    $userJson = json_encode($dataArray);
    postApi('users', $userJson);

    $userResponse = getApi('users');
    $userJson = json_decode($userResponse, true);
    foreach(array_reverse($userJson['users']) as $users){
        $user_srno = $users['user_srno'];
        break;
    }

    $dataArray = array('username' => $_POST['email'], 'password'=>md5($_POST['password']), 'user_srno'=>$user_srno);  
    $loginJson = json_encode($dataArray);
    postApi('logins', $loginJson);

    header('location:../members.php');
}  
?>