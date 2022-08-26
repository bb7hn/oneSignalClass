# One Signal Push Notifications Class

## Description
This is a simple class for One Signal Server Side Usage. 
## How To Use?
- First include class file
```php
<?php
    require_once('oneSignal.class.php');
?>
```
- Then call the class
```php
<?php
    require_once('oneSignal.class.php');
    $oneSignal = new oneSignal("YOUR_APP_ID","YOUR_API_KEY");
?>
```
- Lastly call the sendMessage function
```php
<?php
    require_once('oneSignal.class.php');
    $oneSignal = new oneSignal("YOUR_APP_ID","YOUR_API_KEY");
    $response = $oneSignal->sendMessage('Message Title','Message content',['userOneSignalPlayerId1','userOneSignalPlayerId2']);
?>
```
You can browse oneSignalUsage.php for more
# Example Code Block
```php
<?php
    require_once("oneSignal.class.php");

    $APP_ID     = "YOUR_APP_ID";
    $API_KEY    = "YOUR_API_KEY";

    $oneSignal  = new oneSignal($APP_ID,$API_KEY);

    $title      = "Well done 🥳";
    $message    = "You sent your first notification successfully✌🏻";


    $userIdList = ['playerId1','playerId2','...'];

    $response = $oneSignal->sendMessage($title,$message,$userIdList);
    $response = json_decode($response);

    echo'<pre>';
    print_r($response); 
?>
```
# How Can I Create Custom Functions
Here is an example code block. Basically you can edit this function and insert it end of class file.
```php
    public function myFunction($myParam = 'Default Value For Parameter'){
        $service    = 'service';//this is service name. You can set it from url
        /*
            For Example If your url is :
            https://onesignal.com/api/v1/notifications
            service is notifications for you
            You can find all valid services by browsing official documentation
        */
        $method     ='get';//Method GET OR POST
        $fields = array(
            "parameter" => $myParam
        );
        //You can set fields by browsing official documentation of One Signal
        
        return json_decode($this->curl('players',$fields,'get'));
    }
    //Here is official documentation URL : https://documentation.onesignal.com/reference/create-notification
```