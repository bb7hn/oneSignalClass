<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require_once("oneSignal.class.php");

    $APP_ID     = "YOUR_APP_ID";
    $API_KEY    = "YOUR_API_KEY";

    $oneSignal  = new oneSignal($APP_ID,$API_KEY);
    /* echo'<pre>';
    print_r($oneSignal->viewDevices()); */
    /* echo'<pre>';
    print_r($oneSignal->viewNotifications()); */

    $title      = "Well done 🥳";
    $message    = "You sent your first notification successfully✌🏻";


    $userIdList = ['playerId1','playerId2','...'];

    $response = $oneSignal->sendMessage($title,$message,$userIdList);
    $response = json_decode($response);

    echo'<pre>';
    print_r($response); 
?>