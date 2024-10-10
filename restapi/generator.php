<?php
    $session_start();
    $num=rand(10000000001, 99999999999);
    $code = strval($num);
    $_SESSION['code'] = $code;
?>