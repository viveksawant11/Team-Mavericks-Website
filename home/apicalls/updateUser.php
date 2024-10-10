<?php
    require 'apicall.php' ;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usersResponse = getapi('users/'.$_POST['user_srno']);
        $usersJson = json_decode($usersResponse, 'true');
        foreach($usersJson['users'] as $user)
        {
            if(isset($_POST['contact']))
                $user['contact'] = $_POST['contact'];

            if(isset($_POST['email']))
                $user['email'] = $_POST['email'];

            if(isset($_POST['user_designation']))
                $user['user_designation'] = $_POST['user_designation'];

            if(isset($_POST['name']))
                $user['name'] = $_POST['name'];

            if(isset($_POST['user_about']))
                $user['user_about'] = $_POST['user_about'];

            if(isset($_POST['user_dob']))            
                $user['user_dob'] = $_POST['user_dob'];

            if(isset($_POST['user_department']))
                $user['user_department'] = $_POST['user_department'];

            if(isset($_POST['user_joining']))
                $user['user_joining'] = $_POST['user_joining'];

            $updatedJson = $user;
        }
        
        $userJson = json_encode($updatedJson);
        putApi('users', $userJson);

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $source = $_FILES['image']['tmp_name'];
            $destination = "../assets/img/profiles/user".$_POST['event_srno'].".png"; // Specify the destination folder path
            move_uploaded_file($source, $destination);
        }

        if(isset($_POST['email'])){
            $loginsResponse = getApi('logins/'.$_POST['user_srno']);
            $loginsJson = json_decode($loginsJson, true);
            foreach($loginsJson['logins'] as $logins){
                $logins['email'] = $_POST['email'];
                $updatedLogins = $logins;
            }
        }
        
        $newLogin = json_encode($updatedLogins);
        putApi('logins', $newLogin);
        
        header('location:../profile.php');
    }
?>